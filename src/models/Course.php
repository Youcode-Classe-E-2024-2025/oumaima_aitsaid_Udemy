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
    //<<<<<<<<<<<<<<<<<<<updetteee<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<createCourse>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function createCourse($data) {
        $query = "INSERT INTO cours (title, description, teacher_id, category_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['title'], $data['description'], $data['teacher_id'], $data['category_id']]);

        $course_id = $this->conn->lastInsertId();

        if (!empty($data['tags'])) {
            $this->addCourseTags($course_id, $data['tags']);
        }

        if (!empty($data['resources'])) {
            foreach ($data['resources'] as $resource) {
                $resource->save($this->conn, $course_id);
            }
        }

        return $course_id;
    }


    //////////////////
    public function updateCourse($data) {
        $query = "UPDATE cours SET title = ?, description = ?, category_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['category_id'],
            $data['course_id']
        ]);
    }
    
   //new 
   public function deleteResource($resourceId) {
    $query = "SELECT * FROM resources_cours WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$resourceId]);
    $resource = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resource) {
        if (file_exists($resource['file_path'])) {
            unlink($resource['file_path']);
        }
        $query = "DELETE FROM resources_cours WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$resourceId]);
    }
    return false;
}
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<deleteCourse>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function deleteCourse($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getAllCourses>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getAllCourseswith Categorie and teacher>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function getAllCourses() {
        $query = "SELECT c.id, c.title, c.description, u.username AS teacher, cat.name AS category, c.created_at
                  FROM cours c
                  LEFT JOIN utilisateurs u ON c.teacher_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getIdCourses>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
   
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<assign tags to course>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function assignTags($course_id, $tags) {
        $query = "DELETE FROM cours_tags WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $query = "INSERT INTO cours_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
        $stmt = $this->conn->prepare($query);
    
        foreach ($tags as $tag_id) {
            $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
            $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getlastIdCourses>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getAllCourses avec pagination>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function getCourses($limit, $offset, $search = null) {
        $query = "SELECT c.id, c.title, c.description, c.created_at, u.username AS teacher_name, cat.name AS category
                  FROM cours c
                  LEFT JOIN utilisateurs u ON c.teacher_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id";
            if ($search) {
            $query .= " WHERE c.title LIKE :search OR c.description LIKE :search";
        }
            $query .= " ORDER BY c.created_at DESC LIMIT :limit OFFSET :offset";
    
        $stmt = $this->conn->prepare($query);
            if ($search) {
            $searchTerm = '%' . $search . '%';
            $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        }
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Nombres de courses>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function countCourses($search = null) {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        if ($search) {
            $query .= " WHERE title LIKE :search OR description LIKE :search";
        }
        $stmt = $this->conn->prepare($query);
    
        if ($search) {
            $searchTerm = '%' . $search . '%';
            $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    
    
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getCourseByTeacherId>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function getCoursesByTeacherId($teacher_id) {
        $query = "SELECT c.*, cat.name as category_name, u.username as teacher_name 
                  FROM cours c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  LEFT JOIN utilisateurs u ON c.teacher_id = u.id
                  WHERE c.teacher_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $teacher_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<AddCourseTag>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    private function addCourseTags($course_id, $tags) {
        $query = "INSERT INTO cours_tags (course_id, tag_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $tagsArray = is_string($tags) ? json_decode($tags, true) : $tags;
        foreach ($tagsArray as $tagData) {
            $tag_id = isset($tagData['id']) ? $tagData['id'] : $tagData['value'];
            $stmt->execute([$course_id, $tag_id]);
        }
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getCourseEnrollments>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function getCourseEnrollments($course_id) {
        $query = "SELECT i.*, u.username, u.email
                  FROM inscriptions i
                  JOIN utilisateurs u ON i.student_id = u.id
                  WHERE i.course_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $course_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getCourseStatistics>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function getCourseStatistics($teacher_id = null) {
        try {
            $stats = [];
            
            $total_query = "SELECT COUNT(*) as total FROM " . $this->table;
            if ($teacher_id) {
                $total_query .= " WHERE teacher_id = ?";
            }
            
            $stmt = $this->conn->prepare($total_query);
            if ($teacher_id) {
                $stmt->execute([$teacher_id]);
            } else {
                $stmt->execute();
            }
            $stats['total_courses'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            $category_query = "SELECT c.name as category, COUNT(co.id) as count
                             FROM categories c
                             LEFT JOIN " . $this->table . " co ON c.id = co.category_id";
            if ($teacher_id) {
                $category_query .= " WHERE co.teacher_id = ?";
            }
            $category_query .= " GROUP BY c.id ORDER BY count DESC";
            
            $stmt = $this->conn->prepare($category_query);
            if ($teacher_id) {
                $stmt->execute([$teacher_id]);
            } else {
                $stmt->execute();
            }
            $stats['category_distribution'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $popular_query = "SELECT c.title, COUNT(i.id) as student_count
                            FROM " . $this->table . " c
                            LEFT JOIN inscriptions i ON c.id = i.course_id";
            if ($teacher_id) {
                $popular_query .= " WHERE c.teacher_id = ?";
            }
            $popular_query .= " GROUP BY c.id ORDER BY student_count DESC LIMIT 1";
            
            $stmt = $this->conn->prepare($popular_query);
            if ($teacher_id) {
                $stmt->execute([$teacher_id]);
            } else {
                $stmt->execute();
            }
            $stats['most_popular_course'] = $stmt->fetch(PDO::FETCH_ASSOC);
            $teachers_query = "SELECT u.username, COUNT(DISTINCT c.id) as course_count, 
                                    COUNT(i.id) as student_count
                             FROM utilisateurs u
                             LEFT JOIN " . $this->table . " c ON u.id = c.teacher_id
                             LEFT JOIN inscriptions i ON c.id = i.course_id
                             WHERE u.role = 'teacher'
                             GROUP BY u.id
                             ORDER BY student_count DESC
                             LIMIT 3";
            
            $stmt = $this->conn->prepare($teachers_query);
            $stmt->execute();
            $stats['top_teachers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Total students
            $students_query = "SELECT COUNT(DISTINCT student_id) as total FROM inscriptions";
            if ($teacher_id) {
                $students_query = "SELECT COUNT(DISTINCT i.student_id) as total 
                                 FROM inscriptions i 
                                 JOIN " . $this->table . " c ON i.course_id = c.id 
                                 WHERE c.teacher_id = ?";
            }
            
            $stmt = $this->conn->prepare($students_query);
            if ($teacher_id) {
                $stmt->execute([$teacher_id]);
            } else {
                $stmt->execute();
            }
            $stats['total_students'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            $avg_query = "SELECT AVG(course_count) as average
                         FROM (
                             SELECT student_id, COUNT(DISTINCT course_id) as course_count
                             FROM inscriptions";
            if ($teacher_id) {
                $avg_query .= " JOIN " . $this->table . " c ON inscriptions.course_id = c.id 
                               WHERE c.teacher_id = ?";
            }
            $avg_query .= " GROUP BY student_id) as student_courses";
            
            $stmt = $this->conn->prepare($avg_query);
            if ($teacher_id) {
                $stmt->execute([$teacher_id]);
            } else {
                $stmt->execute();
            }
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stats['avg_courses_per_student'] = $result['average'] ?? 0;

            return $stats;

        } catch (PDOException $e) {
            error_log("Error in getCourseStatistics: " . $e->getMessage());
            return [
                'total_courses' => 0,
                'category_distribution' => [],
                'most_popular_course' => null,
                'top_teachers' => [],
                'total_students' => 0,
                'avg_courses_per_student' => 0
            ];
        }
    }
    public function getCourseTags($courseId) {
        $query = "SELECT tags.* FROM tags
                  JOIN cours_tags ON cours_tags.tag_id = tags.id
                  WHERE cours_tags.course_id = :courseId";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<displayCourse>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function displayCourse($course_id) {
        $course = $this->getCourseById($course_id);
        if (!$course) {
            return null;
        }

        $course['tags'] = $this->getCourseTags($course_id);
        $course['resources'] = $this->getCourseResources($course_id);

        return $course;
    }
    public function updateCourseTags($courseId, $tags) {
        $query = "DELETE FROM cours_tags WHERE course_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$courseId]);
    
        if (!empty($tags)) {
            $query = "INSERT INTO cours_tags (course_id, tag_id) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            foreach ($tags as $tagId) {
                $stmt->execute([$courseId, $tagId]);
            }
        }
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<getCourseById>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function getCourseById($course_id) {
        $query = "SELECT c.*, cat.name as category_name, u.username as teacher_name 
                  FROM cours c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  LEFT JOIN utilisateurs u ON c.teacher_id = u.id
                  WHERE c.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $course_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<ggetCourseResources>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        public function getCourseResources($courseId) {
            $query = "SELECT * FROM ressources_cours WHERE course_id = :courseId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Corrected to fetch all rows
        }
        
      
}
