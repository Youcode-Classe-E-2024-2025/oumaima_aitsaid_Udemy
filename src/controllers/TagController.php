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

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<CreateTags>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function createTag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $names = trim($_POST['name']); 
            if (!empty($names)) {
                $tags = array_map('trim', explode(',', $names));
                $tags = array_filter($tags);
                if (!empty($tags)) {
                    $this->tagsModel->createBulk($tags); 
                    header("Location: index.php?action=Tags&message=created");
                }
            }
            $error_message = "At least one tag is required.";
        }
        $tags = $this->tagsModel->getAll();
        include 'Views/list_tags.php';
    }




}