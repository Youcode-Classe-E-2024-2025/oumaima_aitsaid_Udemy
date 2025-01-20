<?php

class EnrollmentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function isEnrolled($userId, $courseId) {
        $query = $this->db->prepare("SELECT * FROM inscriptions WHERE student_id = ? AND course_id = ?");
        $query->execute([$userId, $courseId]);
        return $query->rowCount() > 0;
    }
    
    public function enroll($userId, $courseId) {
        $query = $this->db->prepare("INSERT INTO inscriptions (student_id, course_id) VALUES (?, ?)");
        $query->execute([$userId, $courseId]);
    }
   
}
