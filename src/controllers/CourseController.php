<?php
// src/controllers/CourseController.php

class CourseController {
    private $courseModel;

    public function __construct($db) {
        $this->courseModel = new Course($db);
    }

    public function listCourses() {
        return $this->courseModel->getAll();
    }

    public function addCourse($data) {
        $this->courseModel->title = $data['title'];
        $this->courseModel->description = $data['description'];
        $this->courseModel->teacher_id = $data['teacher_id'];
        $this->courseModel->category_id = $data['category_id'];

        return $this->courseModel->create();
    }

    public function assignTag($course_id, $tag_id) {
        return $this->courseModel->addTag($course_id, $tag_id);
    }

    public function getCourseTags($course_id) {
        return $this->courseModel->getTags($course_id);
    }
}
