<?php
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
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<toggleUserStatus>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function toggleUserStatus($user_id) {
        $query = "UPDATE utilisateurs SET is_active = NOT is_active WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getStatistics>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//   
    public function getStatistics() {
        $stats = [];

        //<<<<<<<<<<TotaleUser>>>>>>>>>>>>>//
        $query = "SELECT COUNT(*) as total_users FROM utilisateurs";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

        //<<<<<<<<<<TotaleCourse>>>>>>>>>>>>>//
        $query = "SELECT COUNT(*) as total_courses FROM cours";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_courses'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_courses'];

        //<<<<<<<<<<TcourseByCategories>>>>>>>>>>>>>//
        $query = "SELECT c.name, COUNT(co.id) as count 
                  FROM categories c 
                  LEFT JOIN cours co ON c.id = co.category_id 
                  GROUP BY c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['courses_by_category'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //<<<<<<<<<<populaireCourse>>>>>>>>>>>>>//
        $query = "SELECT c.title, COUNT(i.id) as student_count 
                  FROM cours c 
                  LEFT JOIN inscriptions i ON c.id = i.course_id 
                  GROUP BY c.id 
                  ORDER BY student_count DESC 
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['most_popular_course'] = $stmt->fetch(PDO::FETCH_ASSOC);

        //<<<<<<<<<<Top3teacher>>>>>>>>>>>>>//
        $query = "SELECT u.username, COUNT(DISTINCT c.id) as course_count, COUNT(i.id) as student_count 
                  FROM utilisateurs u 
                  LEFT JOIN cours c ON u.id = c.teacher_id 
                  LEFT JOIN inscriptions i ON c.id = i.course_id 
                  WHERE u.role = 'teacher' 
                  GROUP BY u.id 
                  ORDER BY student_count DESC 
                  LIMIT 3";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['top_teachers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }
}
