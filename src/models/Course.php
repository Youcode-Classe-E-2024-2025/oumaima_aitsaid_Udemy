<?php
class Course {
    private $conn;
    private $table = 'cours';
    private $id;
    private $title;
    private $description;
    private $teacher_id;
    private $category_id;
    private $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }
   

   
}
