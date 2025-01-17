<?php 
class TagsController {
    private $tagsModel;

    public function __construct($db){
        $this->tagsModel =new Tag($db);
    }


   

  




}