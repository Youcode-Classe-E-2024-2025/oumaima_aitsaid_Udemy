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
require_once 'src/models/Admin.php';
require_once 'src/controllers/TeacherController.php';
require_once 'src/models/Ressource.php';
require_once 'src/models/VideoRessource.php';
require_once 'src/models/DocumentRessource.php';
require_once 'src/controllers/studentController.php';
require_once 'src/models/EnrollmentModel.php';

$database = new Database();
$db = $database->getConnection();
$controller = new TeacherController($db);
$controllerStudent = new studentController($db);
$userController = new UserController($db);
$courseController = new CourseController($db);
$adminController = new AdminController($db);
$categoryController=new categoryController($db);
$tagsController=new TagsController($db);
$enrollmentModel = new EnrollmentModel($db);
$controllerr = new CourseController($db);

$action = isset($_GET['action']) ? $_GET['action'] : 'courses';

switch($action) {
    case 'enroll':
        $controllerr->enroll();
        break;
    case 'my_courses':
        $controllerr->myCourses();
        break;
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
            $course_id = isset($_GET['id']) ? (int)$_GET['id'] : null; 
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
            break;  case 'displaycoursestudent':
             $course_id = isset($_GET['id']) ? $_GET['id'] : null;
             if ($course_id) {
             $controllerStudent->displayCourse($course_id);
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
            case 'delete_resource':
                $teacherController->deleteResource();
                break;
            case 'edit_course':
                $controller->editCourse();
                break;
            case 'dashboardd': 
                $courseController->indexx();
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