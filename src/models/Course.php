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

    public function create() {
        $query = "INSERT INTO " . $this->table . " (title, description, teacher_id, category_id) 
                  VALUES (:title, :description, :teacher_id, :category_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':teacher_id', $this->teacher_id);
        $stmt->bindParam(':category_id', $this->category_id);
        return $stmt->execute();
    }
    public function getCourses($limit, $offset) {
        $query = "SELECT c.id, c.title, c.description, c.created_at, u.username AS teacher_name, cat.name AS category
                  FROM cours c
                  LEFT JOIN utilisateurs u ON c.teacher_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  ORDER BY c.created_at DESC
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCourses() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

}
