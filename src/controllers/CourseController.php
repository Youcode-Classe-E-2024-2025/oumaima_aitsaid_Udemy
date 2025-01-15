<?php
class CourseController {
    private $courseModel;

    public function __construct($db) {
        $this->courseModel = new Course($db);
    }

    public function listCourses() {
        return $this->courseModel->getAll();
    }


   

  
   
}
