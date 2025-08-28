<?php

namespace App\Models;

use App\Core\Database;

class Notification
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function getRecent($userId, $limit = 5)
    {
        return $this->db->fetchAll(
            "SELECT * FROM notifications 
             WHERE user_id = ? 
             ORDER BY created_at DESC 
             LIMIT ?",
            [$userId, $limit]
        );
    }
    
    public function getUnreadCount($userId)
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count FROM notifications WHERE user_id = ? AND is_read = 0",
            [$userId]
        );
        return $result['count'] ?? 0;
    }
    
    public function markAsRead($id, $userId)
    {
        return $this->db->query(
            "UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?",
            [$id, $userId]
        );
    }
    
    public function create($userId, $type, $title, $message, $entityType = null, $entityId = null)
    {
        $sql = "INSERT INTO notifications (user_id, type, title, message, entity_type, entity_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, [
            $userId,
            $type,
            $title,
            $message,
            $entityType,
            $entityId
        ]);
        
        return $this->db->lastInsertId();
    }
}