<?php
require_once 'config/Database.php';
require_once 'src/models/User.php';
require_once 'src/controllers/UserController.php';
require_once 'src/models/Course.php';
require_once 'src/controllers/CourseController.php';
require_once 'src/controllers/AdminController.php';
require_once 'src/controllers/categoryController.php';
require_once 'src/controllers/TagController.php';
require_once 'src/models/Category.php';
require_once 'src/models/Tag.php';

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);
$courseController = new CourseController($db);
$adminController = new AdminController($db);
$categoryController=new categoryController($db);
$tagsController=new TagsController($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
        case 'register':
            $userController->register();
            break;
        case 'login':
            $userController->login();
            break;
        case 'admin_dashboard':
            $adminController->dashboard();
            break;
        case 'validate_teacher':
            $adminController->validateTeacher();
            break;
        
        case 'manage_users':
            $adminController->manageUsers();
            break;
        
        case 'update_user_status':
            $adminController->updateUserStatus();
            break;
        case 'courses':
            $courseController->index();
            break;
        case 'delete_course':
            $courseController->deleteCourse();
            break;
                     
        case 'list_courses':
            $courseController->listCourses();
            break;
        case 'courses1':
            $courseController->listCourses();
            break;
        case 'categories':
            $categoryController->index();
            break;
        case 'create_category':
            $categoryController->createCategory();
            break;
        case 'edit_category':
            if (isset($_GET['id'])) {
            $categoryController->updateCategory((int)$_GET['id']);
             } else {
                 echo "Error: u need category ID.";
             }
             break;
        case 'delete_category':
                 if (isset($_GET['id'])) 
                 {
            $categoryController->deleteCategory((int)$_GET['id']);
                 } 
                 else 
                 {
                     echo "Error: u need category ID.";
                 } 
            break;
 default:
        echo "Welcome to my platforme !";
        break;
}