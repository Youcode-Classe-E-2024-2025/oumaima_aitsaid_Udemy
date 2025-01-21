<?php


class AdminController {
    private $admin;
    private $user;  

    public function __construct($db) {
        $db = (new Database())->getConnection();
        $this->admin = new Admin($db);
        $this->user = new User($db); 
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<dashboard>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    private function checkAdminAuth(){
        session_start();
        if(!isset($_SESSION['user_id']) || $this->user->isAdmin($_SESSION['user_id']))
        {
            header("Location: index.php?action=login");
            exit();
        }
    }
    public function dashboard() {
        $this->checkAdminAuth();

        $stats = $this->admin->getStatistics();
        include __DIR__ . '/../../Views/admin_dashboard.php';
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<validateTeacher>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function validateTeacher() {
        $this->checkAdminAuth();
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
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<manageUser>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function manageUsers() {
        $this->checkAdminAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            $user_id = $_POST['user_id'];
    
            switch ($action) {
                case 'validate':
                    $this->admin->validateTeacher($user_id);
                    break;
                case 'suspend':
                    $this->admin->toggleUserStatus($user_id);
                    break;
                case 'delete':
                    $this->admin->deleteUser($user_id);
                    header("Location: index.php?action=manage_users&message=deleted");
    exit();
                    break;
            }
    
            header("Location: index.php?action=manage_users");
            exit();
        }
    
        $conn = $this->admin->getConnection();
        $stmt = $conn->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        include __DIR__ . '/../../views/admin_manage_users.php';
    }
    
     //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<updateUserStatus>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function updateUserStatus() {
        $this->checkAdminAuth();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

            $query = "UPDATE utilisateurs SET is_active = :status WHERE id = :user_id";
            $stmt = $this->admin->getConnection()->prepare($query);
            $stmt->bindValue(':status', $status === 'activate' ? 1 : 0, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: index.php?action=manage_users&message=updated");
                exit();
            } else {
                header("Location: index.php?action=manage_users&message=error");
                exit();
            }
        }
    }
}
