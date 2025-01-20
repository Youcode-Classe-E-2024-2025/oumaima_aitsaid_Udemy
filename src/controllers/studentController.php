<?php
class studentController{

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




}