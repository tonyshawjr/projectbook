<?php

namespace App\Models;

use App\Core\Database;

class Project
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function countActive($userId)
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count FROM projects WHERE user_id = ? AND status = 'active'",
            [$userId]
        );
        return $result['count'] ?? 0;
    }
    
    public function getRecent($userId, $limit = 4)
    {
        return $this->db->fetchAll(
            "SELECT p.*, c.company_name as client_name 
             FROM projects p 
             JOIN clients c ON p.client_id = c.id 
             WHERE p.user_id = ? 
             ORDER BY p.updated_at DESC 
             LIMIT ?",
            [$userId, $limit]
        );
    }
    
    public function getAll($userId, $status = null, $clientId = null)
    {
        $sql = "SELECT p.*, c.company_name as client_name 
                FROM projects p 
                JOIN clients c ON p.client_id = c.id 
                WHERE p.user_id = ?";
        $params = [$userId];
        
        if ($status) {
            $sql .= " AND p.status = ?";
            $params[] = $status;
        }
        
        if ($clientId) {
            $sql .= " AND p.client_id = ?";
            $params[] = $clientId;
        }
        
        $sql .= " ORDER BY p.created_at DESC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getById($id, $userId)
    {
        return $this->db->fetch(
            "SELECT p.*, c.company_name as client_name, c.contact_name, c.contact_email, c.contact_phone 
             FROM projects p 
             JOIN clients c ON p.client_id = c.id 
             WHERE p.id = ? AND p.user_id = ?",
            [$id, $userId]
        );
    }
    
    public function create($data)
    {
        $sql = "INSERT INTO projects (user_id, client_id, title, description, status, category, 
                start_date, end_date, budget, notes) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, [
            $data['user_id'],
            $data['client_id'],
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'active',
            $data['category'] ?? null,
            $data['start_date'] ?? null,
            $data['end_date'] ?? null,
            $data['budget'] ?? 0,
            $data['notes'] ?? null
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function update($id, $userId, $data)
    {
        $fields = [];
        $params = [];
        
        foreach ($data as $key => $value) {
            if (!in_array($key, ['id', 'user_id', 'created_at'])) {
                $fields[] = "$key = ?";
                $params[] = $value;
            }
        }
        
        $params[] = $id;
        $params[] = $userId;
        
        $sql = "UPDATE projects SET " . implode(', ', $fields) . 
               " WHERE id = ? AND user_id = ?";
        
        return $this->db->query($sql, $params);
    }
}