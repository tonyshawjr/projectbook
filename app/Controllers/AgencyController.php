<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Agency;
use App\Models\Client;

class AgencyController
{
    private $auth;
    private $agencyModel;
    private $clientModel;
    
    public function __construct()
    {
        $this->auth = new Auth();
        $this->agencyModel = new Agency();
        $this->clientModel = new Client();
    }
    
    public function index()
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $agencies = $this->agencyModel->getAll($userId);
        
        // Get client counts and billing info for each agency
        foreach ($agencies as &$agency) {
            $agency['active_clients'] = $this->clientModel->countByAgency($agency['id']);
            $agency['billed_this_month'] = $this->calculateMonthlyBilling($agency['id']);
            $agency['unpaid_amount'] = $this->calculateUnpaidAmount($agency['id']);
        }
        
        $pageTitle = 'Agency Partners - Projectbook';
        $currentPage = 'agencies';
        
        ob_start();
        include APP_PATH . '/Views/agencies/index.php';
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
        $agency = $this->agencyModel->getById($id, $userId);
        
        if (!$agency) {
            http_response_code(404);
            include APP_PATH . '/Views/errors/404.php';
            return;
        }
        
        // Get agency clients and metrics
        $clients = $this->clientModel->getByAgency($id);
        $metrics = $this->getAgencyMetrics($id);
        
        $pageTitle = $agency['name'] . ' - Agencies - Projectbook';
        $currentPage = 'agencies';
        
        ob_start();
        include APP_PATH . '/Views/agencies/show.php';
        $content = ob_get_clean();
        
        include APP_PATH . '/Views/layouts/main.php';
    }
    
    private function calculateMonthlyBilling($agencyId)
    {
        // Mock calculation - would query actual billing data
        $amounts = [0, 850, 1750];
        return $amounts[array_rand($amounts)];
    }
    
    private function calculateUnpaidAmount($agencyId)
    {
        // Mock calculation - would query actual invoice data
        $amounts = [0, 800, 1200];
        return $amounts[array_rand($amounts)];
    }
    
    private function getAgencyMetrics($agencyId)
    {
        return [
            'total_revenue' => rand(5000, 25000),
            'active_projects' => rand(1, 5),
            'completion_rate' => rand(85, 98)
        ];
    }
}