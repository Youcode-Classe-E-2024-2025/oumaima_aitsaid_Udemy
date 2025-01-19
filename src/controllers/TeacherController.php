<?php

class TeacherController {
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

    public function dashboard() {
        session_start();
        if(!isset($_SESSION['user_id']) || !$this->user->isTeacher($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        
        $teacher_id = $_SESSION['user_id'];
        $courses = $this->course->getCoursesByTeacherId($teacher_id);
        $total_students = $this->getTotalStudents($teacher_id);
        $recent_activities = $this->getRecentActivities($teacher_id);
        
        include __DIR__.'/../../views/teacher_dashboard.php';
    }
    
   

  


    
    

   
    
  

   

 
   
    
    

    

    
    



}