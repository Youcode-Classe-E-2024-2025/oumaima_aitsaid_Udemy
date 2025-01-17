<?php 
class TagsController {
    private $tagsModel;

    public function __construct($db){
        $this->tagsModel =new Tag($db);
    }


    //newwwwwwww//
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<indexTags>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
   
    public function index(){
        $tags=$this->tagsModel->getAll();
        include 'Views/list_tags.php';
    }

  




}