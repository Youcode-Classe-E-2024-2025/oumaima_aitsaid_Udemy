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
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<updateTags>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function updateTag($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']); 
            if (!empty($name)) {
                $this->tagsModel->update($id, $name); 
                header("Location: index.php?action=Tags&message=updated");
                exit();
            } else {
                $error_message = "Tag name is required.";
            }
        }
    
        $tag = $this->tagsModel->getById($id);
        if (!$tag) {
            header("Location: index.php?action=Tags&message=not_found");
            exit();
        }
        include 'Views/list_tags.php'; 
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<deleteTags>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function deleteTag($id) {
        $this->tagsModel->delete($id);
        header("Location: index.php?action=Tags&message=deleted");
        exit();
    }
    


}