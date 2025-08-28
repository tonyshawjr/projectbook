<?php

namespace App\Models;

use App\Core\Database;

class Agency
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function getAll($userId)
    {
        $agencies = $this->db->fetchAll(
            "SELECT * FROM agencies WHERE user_id = ? AND is_active = 1 ORDER BY name ASC",
            [$userId]
        );
        
        // Get client counts and billing info for each agency
        foreach ($agencies as &$agency) {
            $clientCount = $this->db->fetch(
                "SELECT COUNT(*) as count FROM clients WHERE agency_id = ? AND is_active = 1",
                [$agency['id']]
            );
            $agency['active_clients'] = $clientCount['count'] ?? 0;
            
            // Calculate unpaid amount (placeholder for Phase 2)
            $agency['unpaid_amount'] = 0;
        }
        
        return $agencies;
    }
    
    public function getById($id, $userId)
    {
        $agency = $this->db->fetch(
            "SELECT * FROM agencies WHERE id = ? AND user_id = ?",
            [$id, $userId]
        );
        
        if ($agency) {
            // Get associated clients
            $agency['clients'] = $this->db->fetchAll(
                "SELECT * FROM clients WHERE agency_id = ? ORDER BY company_name ASC",
                [$id]
            );
        }
        
        return $agency;
    }
    
    public function create($data)
    {
        $sql = "INSERT INTO agencies (user_id, name, contact_name, contact_email, contact_phone, 
                address, monthly_billing, commission_rate, notes) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, [
            $data['user_id'],
            $data['name'],
            $data['contact_name'] ?? null,
            $data['contact_email'] ?? null,
            $data['contact_phone'] ?? null,
            $data['address'] ?? null,
            $data['monthly_billing'] ?? 0,
            $data['commission_rate'] ?? 0,
            $data['notes'] ?? null
        ]);
        
        return $this->db->lastInsertId();
    }
}