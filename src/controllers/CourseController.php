<?php
class CourseController {
    private $courseModel;

    public function __construct($db) {
        $this->courseModel = new Course($db);
    }

    public function listCourses() {
        return $this->courseModel->getAll();
    }
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

   

  
   
}
