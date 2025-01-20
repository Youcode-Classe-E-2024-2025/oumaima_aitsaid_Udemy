<?php

class UserController {
    private $user;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<register>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

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
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<login>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function login() {
        $message = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
    
            if (!$email || !$password) {
                $message = "required";
            } else {
                $this->user->setEmail($email);
                
                if ($this->user->login() && password_verify($password, $this->user->getPassword())) {
                    $isValidated = $this->user->getIsValidate();
                    $isActive = $this->user->getIsActive();
                    $role = $this->user->getRole();
    
                    if ($isActive == 0) {
                        $message = "suspended";
                    } elseif ($role === 'teacher' && $isValidated == 0) {
                        $message = "pending";
                    } else {
                        session_start();
                        $_SESSION['user_id'] = $this->user->getId();
                        $_SESSION['username'] = $this->user->getUsername();
                        $_SESSION['role'] = $role;
    
                        switch ($role) {
                            case 'admin':
                                header("Location: index.php?action=admin_dashboard");
                                break;
                            case 'teacher':
                                header("Location: index.php?action=dashboard");
                                break;
                            default:
                                header("Location: index.php?action=dashboardd");
                                break;
                        }
                        exit();
                    }
                } else {
                    $message = "invalid";
                }
            }
        }
        
        include 'views/login.php';
        
        if ($message) {
            $this->displayAlert($message);
        }
    }
    
    private function displayAlert($type) {
        $alerts = [
            'required' => [
                'icon' => 'warning',
                'title' => 'Required Fields',
                'text' => 'Email and password are required.'
            ],
            'suspended' => [
                'icon' => 'error',
                'title' => 'Account Suspended',
                'text' => 'Your account is suspended. Please contact the administrator.'
            ],
            'pending' => [
                'icon' => 'info',
                'title' => 'Pending Validation',
                'text' => 'Please wait for admin validation of your teacher account.'
            ],
            'invalid' => [
                'icon' => 'error',
                'title' => 'Login Failed',
                'text' => 'Invalid credentials. Please try again.'
            ]
        ];
    
        if (isset($alerts[$type])) {
            $alert = $alerts[$type];
            echo "<script>
                Swal.fire({
                    icon: '{$alert['icon']}',
                    title: '{$alert['title']}',
                    text: '{$alert['text']}'
                });
            </script>";
        }
    }
    
    
    
    
}

