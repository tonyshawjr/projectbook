<?php

namespace App\Models;

use App\Core\Database;

class Client
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function getAll($userId, $type = null)
    {
        $sql = "SELECT c.*, a.name as agency_name 
                FROM clients c 
                LEFT JOIN agencies a ON c.agency_id = a.id 
                WHERE c.user_id = ?";
        $params = [$userId];
        
        if ($type) {
            $sql .= " AND c.client_type = ?";
            $params[] = $type;
        }
        
        $sql .= " ORDER BY c.company_name ASC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getById($id, $userId)
    {
        return $this->db->fetch(
            "SELECT c.*, a.name as agency_name 
             FROM clients c 
             LEFT JOIN agencies a ON c.agency_id = a.id 
             WHERE c.id = ? AND c.user_id = ?",
            [$id, $userId]
        );
    }
    
    public function getWithMaintenanceUsage($id, $userId)
    {
        $client = $this->getById($id, $userId);
        
        if ($client && $client['maintenance_plan_type'] !== 'none') {
            $usage = $this->db->fetch(
                "SELECT SUM(hours_used) as total_used 
                 FROM maintenance_usage 
                 WHERE client_id = ? 
                 AND MONTH(date) = MONTH(CURRENT_DATE()) 
                 AND YEAR(date) = YEAR(CURRENT_DATE())",
                [$id]
            );
            
            $client['hours_used'] = $usage['total_used'] ?? 0;
        }
        
        return $client;
    }
    
    public function create($data)
    {
        $sql = "INSERT INTO clients (user_id, agency_id, company_name, contact_name, contact_email, 
                contact_phone, address, client_type, maintenance_plan_type, maintenance_rate, 
                maintenance_hours, maintenance_renewal_date, tags, notes) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, [
            $data['user_id'],
            $data['agency_id'] ?? null,
            $data['company_name'],
            $data['contact_name'] ?? null,
            $data['contact_email'] ?? null,
            $data['contact_phone'] ?? null,
            $data['address'] ?? null,
            $data['client_type'] ?? 'direct',
            $data['maintenance_plan_type'] ?? 'none',
            $data['maintenance_rate'] ?? 0,
            $data['maintenance_hours'] ?? 0,
            $data['maintenance_renewal_date'] ?? null,
            $data['tags'] ?? null,
            $data['notes'] ?? null
        ]);
        
        return $this->db->lastInsertId();
    }
    
    public function countByAgency($agencyId)
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count FROM clients WHERE agency_id = ? AND is_active = TRUE",
            [$agencyId]
        );
        return $result['count'] ?? 0;
    }
    
    public function getByAgency($agencyId)
    {
        return $this->db->fetchAll(
            "SELECT * FROM clients WHERE agency_id = ? AND is_active = TRUE ORDER BY company_name ASC",
            [$agencyId]
        );
    }
}