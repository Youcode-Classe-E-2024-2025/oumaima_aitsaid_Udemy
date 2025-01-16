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
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<validateTeacher>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function validateTeacher() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $teacher_id = filter_input(INPUT_POST, 'teacher_id', FILTER_SANITIZE_NUMBER_INT);
            if ($teacher_id && $this->admin->validateTeacher($teacher_id)) {
                header("Location: index.php?action=admin_dashboard&message=validated");
                exit();
            } else {
                header("Location: index.php?action=admin_dashboard&message=error");
                exit();
            }
        }
    }

    
}
