<?php
class CourseController {
    private $courseModel;
    private $categoryModel;
    private $tagModel;
    
    public function __construct($db) {
        $this->courseModel = new Course($db);
        $this->categoryModel = new Category($db);
        $this->tagModel = new Tag($db);
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
    $courses = $this->courseModel->getCourses($coursesPerPage, $offset);
    $totalCourses = $this->courseModel->countCourses();
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
}
