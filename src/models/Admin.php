<?php
require_once 'User.php';
class Admin extends User {
    public function __construct($db) {
        parent::__construct($db);
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<validateCompte Teacher>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function validateTeacher($teacher_id) {
        $query = "UPDATE utilisateurs SET validated= 1 WHERE id = :teacher_id AND role = 'teacher'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id);
        return $stmt->execute();
    }
 




   
}
