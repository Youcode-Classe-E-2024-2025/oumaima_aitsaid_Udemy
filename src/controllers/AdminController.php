<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../models/Admin.php';

class AdminController {
    private $admin;

    public function __construct($db) {
        $db = (new Database())->getConnection();
        $this->admin = new Admin($db);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<dashboard>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function dashboard() {
        session_start();

        $stats = $this->admin->getStatistics();
        include __DIR__ . '/../../Views/admin_dashboard.php';
    }

    
}
