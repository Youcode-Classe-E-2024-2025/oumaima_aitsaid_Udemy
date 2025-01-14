<?php
require_once 'config/Database.php';
require_once 'src/models/User.php';
require_once 'src/controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'register':
        $userController->register();
        break;
    case 'login':
        $userController->login();
        break;
    default:
        echo "Welcome to Youdemy!";
        break;
}