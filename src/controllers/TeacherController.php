<?php

class TeacherController {
    private $db;
    private $user;
    private $course;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
        $this->course = new Course($db);
        $this->categorie =new Category($db);
        $this->Tags =new Tag($db);
    }

    public function dashboard() {
        session_start();
        if(!isset($_SESSION['user_id']) || !$this->user->isTeacher($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        
        $teacher_id = $_SESSION['user_id'];
        $courses = $this->course->getCoursesByTeacherId($teacher_id);
        
        // Get other necessary data for the dashboard
        $total_students = $this->getTotalStudents($teacher_id);
        $recent_activities = $this->getRecentActivities($teacher_id);
        
        include __DIR__.'/../../views/teacher_dashboard.php';
    }
    
    public function addCourse() {
        $categories = $this->categorie->getAll();
        $tags = $this->Tags->getAll();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'teacher_id' => $_SESSION['user_id'],
                'category_id' => $_POST['category_id'],
                'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
                'resources' => [],
            ];
    
            if ($_POST['resource_type'] === 'video' && isset($_FILES['resource']) && $_FILES['resource']['error'] === 0) {
                $upload_dir = 'uploads/';
                $file_name = basename($_FILES['resource']['name']);
                $file_path = $upload_dir . $file_name;
    
                if (move_uploaded_file($_FILES['resource']['tmp_name'], $file_path)) {
                    $resource = new VideoRessource($_POST['resource_title'], $file_path);
                    $course_data['resources'][] = $resource;
                        $resource->save($course_id);  
                }
            }
    
            if ($_POST['resource_type'] === 'document' && !empty($_POST['content_text'])) {
                $upload_dir = 'uploads/';
                $file_name = uniqid() . '.md';
                $file_path = $upload_dir . $file_name;
    
                file_put_contents($file_path, $_POST['content_text']);
                $resource = new DocumentRessource($_POST['resource_title'], $file_path);
                $course_data['resources'][] = $resource;
                $resource->save($course_id); 
            }
            $course_id = $this->course->createCourse($course_data);
    
            if ($course_id) {
                header("Location: index.php?action=display_course&id=$course_id&success=course_created");
                exit();
            } else {
                $error = "Failed to create course. Please try again.";
            }
        }
    
        include __DIR__ . '/../../views/add_course.php';
    }


    public function deleteCourse($id) {
        session_start();
        if(!isset($_SESSION['user_id']) || !$this->user->isTeacher($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $teacher_id = $_SESSION['user_id'];

        if ($this->course->deleteCourse($id, $teacher_id)) {
            header("Location: index.php?action=dashboard&success=course_deleted");
            exit();
        } else {
            header("Location: index.php?action=dashboard&error=delete_failed");
            exit();
        }
    }


    
    private function getTotalStudents($teacher_id) {
        $query = "SELECT COUNT(DISTINCT i.student_id) AS num_students 
                  FROM inscriptions i
                  JOIN cours c ON i.course_id = c.id
                  WHERE c.teacher_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$teacher_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['num_students'];
    }

   
    private function getRecentActivities($teacher_id) {
        $query = "SELECT 'enrollment' as type, i.enrolled_at as date, c.title as course_title, u.username, u.email
                  FROM inscriptions i
                  JOIN cours c ON i.course_id = c.id
                  JOIN utilisateurs u ON i.student_id = u.id
                  WHERE c.teacher_id = ?
                  UNION ALL
                  SELECT 'course_creation' as type, c.created_at as date, c.title as course_title, NULL as username, NULL as email
                  FROM cours c
                  WHERE c.teacher_id = ?
                  ORDER BY date DESC
                  LIMIT 10";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$teacher_id, $teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function viewEnrollments($course_id) {
        session_start();
        if (!isset($_SESSION['user_id']) || !$this->user->isTeacher($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
            $enrollments = $this->course->getCourseEnrollments($course_id);
        
        $course = $this->course->getCourseById($course_id);
    
        include __DIR__ . '/../../views/course_enrollments.php';
    }
    
    public function viewStatistics() {
        try {
            session_start();
            
            if(!isset($_SESSION['user_id']) || !$this->user->isTeacher($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }

            $teacher_id = $_SESSION['user_id'];
            
            $statistics = $this->course->getCourseStatistics($teacher_id);
            $user = $this->user->getUserById($teacher_id);
            
            include __DIR__ . '/../../views/course_statistics.php';
                } catch (Exception $e) {
            error_log("Error in viewStatistics: " . $e->getMessage());
             header("Location: index.php?action=dashboard&error=statistics_error");
            exit();
        }
    }


    public function displayCourse($id) {
        session_start();
        if (!isset($_SESSION['user_id']) || !$this->user->isTeacher($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
    
        $course = $this->course->displayCourse($id);
    
        if (!$course) {
            header("Location: index.php?action=dashboard&error=course_not_found");
            exit();
        }
            $resources = $this->course->getCourseResources($id);
        $course['resources'] = $resources ?: []; 
    
        include __DIR__ . '/../../views/display_course.php';
    }
    



}