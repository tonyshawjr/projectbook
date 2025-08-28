<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Auth;
use App\Models\Project;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Notification;

class DashboardController
{
    private $db;
    private $auth;
    private $projectModel;
    private $clientModel;
    private $ticketModel;
    private $notificationModel;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->auth = new Auth();
        $this->projectModel = new Project();
        $this->clientModel = new Client();
        $this->ticketModel = new Ticket();
        $this->notificationModel = new Notification();
    }
    
    public function index()
    {
        $this->auth->requireAuth();
        $user = $this->auth->getUser();
        
        // Get dashboard statistics
        $stats = [
            'active_projects' => $this->projectModel->countActive($user['id']),
            'open_tickets' => $this->ticketModel->countOpen($user['id']),
            'overdue_invoices' => 2400.00, // Placeholder for Phase 2
            'upcoming_consultations' => 3, // Placeholder
            'total_revenue' => 24500.00, // Placeholder
            'pending_invoices' => 8200.00 // Placeholder
        ];
        
        // Get recent projects
        $recentProjects = $this->projectModel->getRecent($user['id'], 4);
        
        // Get recent notifications
        $notifications = $this->notificationModel->getRecent($user['id'], 5);
        
        // Determine greeting based on time
        $hour = date('H');
        if ($hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }
        
        $data = [
            'user' => $user,
            'greeting' => $greeting,
            'stats' => $stats,
            'recentProjects' => $recentProjects,
            'notifications' => $notifications,
            'lastUpdated' => date('F j')
        ];
        
        include APP_PATH . '/Views/dashboard/index.php';
    }
}