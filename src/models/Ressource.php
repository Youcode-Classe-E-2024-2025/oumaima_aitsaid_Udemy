<?php
abstract class Ressource {
    protected $title;
    protected $file_path;

    public function __construct($title, $file_path) {
        $this->title = $title;
        $this->file_path = $file_path;
    }
    abstract public function save($db, $course_id);
}
