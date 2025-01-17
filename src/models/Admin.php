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
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<ManageUser>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function manageUser($user_id, $action) {
        $query = match ($action) {
            'activate' => "UPDATE utilisateurs SET is_active = 1 WHERE id = :user_id",
            'suspend' => "UPDATE utilisateurs SET is_active = 0 WHERE id = :user_id",
            'delete' => "DELETE FROM utilisateurs WHERE id = :user_id",
            default => throw new Exception("Invalid action")
        };
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<deleteUser>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function deleteCourse($course_id) {
        $query = "DELETE FROM cours WHERE id = :course_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':course_id', $course_id);
        return $stmt->execute();
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<suspendUser>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function suspendUser($user_id) {
        $query = "UPDATE utilisateurs SET is_active = 0 WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<DeleteUser>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function deleteUser($user_id) {
        $query = "DELETE FROM utilisateurs WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

   
}
