<?php

namespace App\Models;

use App\Core\Database;

class Ticket
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function countOpen($userId)
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count FROM support_tickets WHERE user_id = ? AND status IN ('open', 'in_progress')",
            [$userId]
        );
        return $result['count'] ?? 0;
    }
    
    public function getAll($userId, $filters = [])
    {
        $sql = "SELECT t.*, c.company_name as client_name, p.title as project_title 
                FROM support_tickets t 
                JOIN clients c ON t.client_id = c.id 
                LEFT JOIN projects p ON t.project_id = p.id 
                WHERE t.user_id = ?";
        $params = [$userId];
        
        if (!empty($filters['status'])) {
            $sql .= " AND t.status = ?";
            $params[] = $filters['status'];
        }
        
        if (!empty($filters['priority'])) {
            $sql .= " AND t.priority = ?";
            $params[] = $filters['priority'];
        }
        
        if (!empty($filters['inbox']) && $filters['inbox'] === 'priority') {
            $sql .= " AND t.is_priority_inbox = 1";
        }
        
        $sql .= " ORDER BY 
                  CASE t.priority 
                    WHEN 'premium' THEN 1 
                    WHEN 'high' THEN 2 
                    WHEN 'medium' THEN 3 
                    WHEN 'low' THEN 4 
                  END, 
                  t.created_at DESC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getById($id, $userId)
    {
        return $this->db->fetch(
            "SELECT t.*, c.company_name as client_name, p.title as project_title 
             FROM support_tickets t 
             JOIN clients c ON t.client_id = c.id 
             LEFT JOIN projects p ON t.project_id = p.id 
             WHERE t.id = ? AND t.user_id = ?",
            [$id, $userId]
        );
    }
    
    public function create($data)
    {
        // Check if client has maintenance plan for priority inbox
        $client = $this->db->fetch(
            "SELECT maintenance_plan_type FROM clients WHERE id = ?",
            [$data['client_id']]
        );
        
        $isPriorityInbox = $client && $client['maintenance_plan_type'] !== 'none';
        
        $sql = "INSERT INTO support_tickets (user_id, client_id, project_id, title, description, 
                status, priority, is_priority_inbox) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, [
            $data['user_id'],
            $data['client_id'],
            $data['project_id'] ?? null,
            $data['title'],
            $data['description'],
            'open',
            $data['priority'] ?? 'medium',
            $isPriorityInbox ? 1 : 0
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function updateStatus($id, $userId, $status)
    {
        $sql = "UPDATE support_tickets SET status = ?";
        $params = [$status];
        
        if ($status === 'closed') {
            $sql .= ", closed_at = NOW()";
        }
        
        $sql .= " WHERE id = ? AND user_id = ?";
        $params[] = $id;
        $params[] = $userId;
        
        return $this->db->query($sql, $params);
    }
    
    public function getPriorityInbox($userId)
    {
        return $this->db->fetchAll(
            "SELECT t.*, c.company_name as client_name, p.title as project_title 
             FROM support_tickets t 
             JOIN clients c ON t.client_id = c.id 
             LEFT JOIN projects p ON t.project_id = p.id 
             WHERE t.user_id = ? AND t.is_priority_inbox = 1 AND t.status NOT IN ('closed')
             ORDER BY t.priority ASC, t.created_at DESC",
            [$userId]
        );
    }
    
    public function getComments($ticketId)
    {
        return $this->db->fetchAll(
            "SELECT tc.*, u.first_name, u.last_name 
             FROM ticket_comments tc 
             JOIN users u ON tc.user_id = u.id 
             WHERE tc.ticket_id = ? 
             ORDER BY tc.created_at ASC",
            [$ticketId]
        );
    }
    
    public function getRelated($clientId, $excludeTicketId)
    {
        return $this->db->fetchAll(
            "SELECT * FROM support_tickets 
             WHERE client_id = ? AND id != ? AND status NOT IN ('closed') 
             ORDER BY created_at DESC 
             LIMIT 5",
            [$clientId, $excludeTicketId]
        );
    }
}