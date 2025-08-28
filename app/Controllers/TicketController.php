<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Ticket;
use App\Models\Client;

class TicketController
{
    private $auth;
    private $ticketModel;
    private $clientModel;
    
    public function __construct()
    {
        $this->auth = new Auth();
        $this->ticketModel = new Ticket();
        $this->clientModel = new Client();
    }
    
    public function index()
    {
        if (!$this->auth->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $tickets = $this->ticketModel->getAll($userId);
        
        // Get priority inbox tickets
        $priorityTickets = $this->ticketModel->getPriorityInbox($userId);
        
        $pageTitle = 'Support Tickets - Projectbook';
        $currentPage = 'tickets';
        
        ob_start();
        include APP_PATH . '/Views/tickets/index.php';
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
        $ticket = $this->ticketModel->getById($id, $userId);
        
        if (!$ticket) {
            http_response_code(404);
            include APP_PATH . '/Views/errors/404.php';
            return;
        }
        
        // Get ticket comments and related data
        $comments = $this->ticketModel->getComments($id);
        $relatedTickets = $this->ticketModel->getRelated($ticket['client_id'], $id);
        
        $pageTitle = $ticket['title'] . ' - Tickets - Projectbook';
        $currentPage = 'tickets';
        
        ob_start();
        include APP_PATH . '/Views/tickets/show.php';
        $content = ob_get_clean();
        
        include APP_PATH . '/Views/layouts/main.php';
    }
}