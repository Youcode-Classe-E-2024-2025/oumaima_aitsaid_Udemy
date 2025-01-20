<?php
class studentController{

    private $db;
    private $user;
    private $course;

    public function __construct($db) {
    $this->db = $db;
    $this->user = new User($db);
    $this->course = new Course($db);
    $this->categorie =new Category($db);
    $this->Tags =new Tag($db);
    }



public function displayCourse($id) {
    session_start();
    if (!isset($_SESSION['user_id']) || !$this->user->isStudent($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $course = $this->course->displayCourse($id);

    if (!$course) {
        header("Location: index.php?action=dashboard&error=course_not_found");
        exit();
    }
        $resources = $this->course->getCourseResources($id);
    $course['resources'] = $resources ?: []; 

    include __DIR__ . '/../../views/course/display_courseStudent.php';
}
}