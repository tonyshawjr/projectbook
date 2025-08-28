<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Client;
use App\Models\Project;

class ClientController
{
    private $auth;
    private $clientModel;
    private $projectModel;
    
    public function __construct()
    {
        $this->auth = new Auth();
        $this->clientModel = new Client();
        $this->projectModel = new Project();
    }
    
    public function index()
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $clients = $this->clientModel->getAll($userId);
        
        $pageTitle = 'Client Management - Projectbook';
        $currentPage = 'clients';
        
        ob_start();
        include APP_PATH . '/Views/clients/index.php';
        $content = ob_get_clean();
        
        include APP_PATH . '/Views/layouts/main.php';
    }
    
    public function show($id)
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $client = $this->clientModel->getById($id, $userId);
        
        if (!$client) {
            http_response_code(404);
            include APP_PATH . '/Views/errors/404.php';
            return;
        }
        
        // Get client projects and maintenance usage
        $projects = $this->projectModel->getAll($userId, null, $id);
        $maintenanceUsage = $this->getMaintenanceUsage($id);
        
        $pageTitle = $client['company_name'] . ' - Clients - Projectbook';
        $currentPage = 'clients';
        
        ob_start();
        include APP_PATH . '/Views/clients/show.php';
        $content = ob_get_clean();
        
        include APP_PATH . '/Views/layouts/main.php';
    }
    
    private function getMaintenanceUsage($clientId)
    {
        // Mock maintenance usage data
        return [
            [
                'task' => 'Blog post update',
                'hours' => 1,
                'date' => '2024-07-24'
            ],
            [
                'task' => 'Header image change', 
                'hours' => 0.5,
                'date' => '2024-07-11'
            ],
            [
                'task' => 'Security updates',
                'hours' => 2,
                'date' => '2024-07-19'
            ]
        ];
    }
}