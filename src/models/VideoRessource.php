<?php 
class VideoRessource extends Ressource {
    public function save($db, $course_id) {
        $query = "INSERT INTO ressources_cours (course_id, type, title, file_path) VALUES (?, 'video', ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$course_id, $this->title, $this->file_path]);
    }
}


