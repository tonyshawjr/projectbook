<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Auth;
use App\Models\Project;
use App\Models\Client;

class ProjectController
{
    private $auth;
    private $projectModel;
    private $clientModel;
    
    public function __construct()
    {
        $this->auth = new Auth();
        $this->projectModel = new Project();
        $this->clientModel = new Client();
    }
    
    public function index()
    {
        $this->auth->requireAuth();
        $user = $this->auth->getUser();
        
        $status = $_GET['status'] ?? null;
        $projects = $this->projectModel->getAll($user['id'], $status);
        
        $data = [
            'user' => $user,
            'projects' => $projects,
            'currentFilter' => $status ?? 'all'
        ];
        
        include APP_PATH . '/Views/projects/index.php';
    }
    
    public function show($id)
    {
        $this->auth->requireAuth();
        $user = $this->auth->getUser();
        
        $project = $this->projectModel->getById($id, $user['id']);
        
        if (!$project) {
            header('Location: /projects');
            exit;
        }
        
        $data = [
            'user' => $user,
            'project' => $project
        ];
        
        include APP_PATH . '/Views/projects/show.php';
    }
}