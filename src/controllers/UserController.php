<?php

class UserController {
    private $user;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
            $username = trim($username);
            $username = stripslashes($username);
            $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $role = filter_input(INPUT_POST, 'role', FILTER_UNSAFE_RAW);
            $role = trim($role);
            $role = stripslashes($role);
            $role = htmlspecialchars($role, ENT_QUOTES, 'UTF-8');

            if (!$username || !$email || !$password || !$role) {
                return "remplir tous les champs.";
            }

            $this->user->setUsername($username);
            $this->user->setEmail($email);
            $this->user->setPassword($password);
            $this->user->setRole($role);

            if ($this->user->create()) {
                header("Location: index.php?action=login&registered=1");
                exit();
            } else {
                return "Registration failed. Please try again.";
            }
        }
        
        include 'views/register.php';
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (!$email || !$password) {
                return "Email and password are obligatoire.";
            }

            $this->user->setEmail($email);
            if ($this->user->login() && password_verify($password, $this->user->getPassword())) {
                session_start();
                $_SESSION['user_id'] = $this->user->getId();
                $_SESSION['username'] = $this->user->getUsername();
                $_SESSION['role'] = $this->user->getRole();

                switch ($this->user->getRole()) {
                    case 'admin':
                        header("Location: admin_dashboard.php");
                        break;
                    case 'teacher':
                        header("Location: teacher_dashboard.php");
                        break;
                    default:
                        header("Location: student_dashboard.php");
                        break;
                }
                exit();
            } else {
                return " Please try again.";
            }
        }
        
        include 'views/login.php';
    }
}

