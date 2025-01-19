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
require_once 'src/controllers/TeacherController.php';
require_once 'src/models/Ressource.php';
require_once 'src/models/VideoRessource.php';
require_once 'src/models/DocumentRessource.php';


$database = new Database();
$db = $database->getConnection();
$controller = new TeacherController($db);
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
        case '1_course':
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
        case 'Tags':
            $tagsController->index();
            break;     
        case 'create_tag':
            $tagsController->createTag();
        case 'update_tag':
            $tagsController->updateTag($_GET['id']);
            break;
        case 'delete_tag':
            $tagsController->deleteTag($_GET['id']);
            break;
            case 'add_course':
                $controller->addCourse();
                break;
                case 'view_enrollments':
                    $course_id = isset($_GET['id']) ? (int)$_GET['id'] : null; // Ensure it's cast to integer
                    if ($course_id) {
                        $controller->viewEnrollments($course_id);
                    } else {
                        header("Location: index.php?action=dashboard&error=invalid_course");
                    }
                    break;
                               
            case 'view_statistics':
                $controller->viewStatistics();
                break;
                case 'update_course':
                    $course_id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($course_id) {
                        $controller->updateCourse($course_id);
                    } else {
                        header("Location: index.php?action=dashboard&error=invalid_course");
                    }
                    break;
                case 'display_course':
                    $course_id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($course_id) {
                        $controller->displayCourse($course_id);
                    } else {
                        header("Location: index.php?action=dashboard&error=invalid_course");
                    }
                    break;
                    case 'dashboard':
                        $controller->dashboard();
                        break;
                        case 'delete_course':
                            $course_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
                        
                            if ($course_id) {
                                $controller->deleteCourse($course_id);
                            } else {
                                header("Location: index.php?action=dashboard&error=invalid_course");
                                exit();
                            }
                            break;
        case 'logout' :
            session_start();
            session_destroy();
            session_unset();
            header("Location:index.php?action=login"); 
            break;
 default:
        echo "Welcome to my platforme !";
        break;
}