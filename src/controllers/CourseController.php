<?php
class CourseController {
    private $courseModel;
    private $categoryModel;
    private $enrollmentModel; 
    private $tagModel;
    
    public function __construct($db) {
        $this->courseModel = new Course($db);
        $this->categoryModel = new Category($db);
        $this->tagModel = new Tag($db);
        $this->user = new User($db);
        $this->enrollmentModel = new EnrollmentModel($db); 
    }
    private function checkStudentAuth(){
        session_start();
        
        if (!isset($_SESSION['user_id']) || !$this->user->isStudent($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
    }
    
    public function enroll() {
        session_start();
            if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login"); 
            exit();
        }
            $userId = $_SESSION['user_id'];
        $courseId = $_GET['course_id'] ?? null;
    
        if (!$courseId) {
            die("Course ID is required.");
        }
            if ($this->enrollmentModel->isEnrolled($userId, $courseId)) {
            header("Location: index.php?action=my_courses&alert=already_enrolled");            exit();
        }
            $this->enrollmentModel->enroll($userId, $courseId);
            header("Location: index.php?action=my_courses");
        exit();
    }
    public function myCourses() {
        session_start();
    
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
    
        $userId = $_SESSION['user_id'];
        $courses=$this->enrollmentModel->getUserCourses($userId);
        include('views/my_courses.php');
    }
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<listCourses>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function listCourses() {
        $courses=$this->courseModel->getAllCourses();
        include ('views/course_list.php');
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<index>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
    public function index() {
    $coursesPerPage = 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max($currentPage, 1);
    $offset = ($currentPage - 1) * $coursesPerPage;
    $search = isset($_GET['search']) ? trim($_GET['search']) : null;
    $courses = $this->courseModel->getCourses($coursesPerPage, $offset, $search);
    $totalCourses = $this->courseModel->countCourses($search);
    $totalPages = ceil($totalCourses / $coursesPerPage);
    include('views/courseListView.php');

    
    }
   //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Delete a course>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

public function deleteCourse() {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $course_id = $_GET['id'];
        $this->courseModel->delete($course_id); 
        header("Location: index.php?action=courses1"); 
        exit();
    } else {
        header("Location: index.php?action=courses&message=error");
        exit();
    }
}   



//-----------------------------------------index--------------------------------------//
public function indexx() {
    $this->checkStudentAuth();
    $coursesPerPage = 10;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max($currentPage, 1);
    $offset = ($currentPage - 1) * $coursesPerPage;
    $search = isset($_GET['search']) ? trim($_GET['search']) : null;
    $courses = $this->courseModel->getCourses($coursesPerPage, $offset, $search);
    $totalCourses = $this->courseModel->countCourses($search);
    $totalPages = ceil($totalCourses / $coursesPerPage);
    include('views/student_dashboard.php');
}


//----------------------displayCourses----------------------------------------------//

}