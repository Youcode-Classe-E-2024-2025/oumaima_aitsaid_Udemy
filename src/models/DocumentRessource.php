<?php
class DocumentRessource extends Ressource {
    public function __construct($title, $file_path) {
        parent::__construct($title, $file_path);
    }
    public function save($db,$course_id) {
        $query = "INSERT INTO ressources_cours (course_id, type, title, file_path) VALUES (?, 'document', ?, ?)";
        $stmt = $db->prepare($query);
    
        if (!$stmt->execute([$course_id, $this->title, $this->file_path])) {
            var_dump($stmt->errorInfo());
            die("Error: Failed to save document resource to database");
        }
    }
}