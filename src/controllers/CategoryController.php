<?php

class categoryController {
    private $categoryModel;

    public function __construct($db) {
        $this->categoryModel = new Category($db);
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<indexCategory>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function index() {
        $categories = $this->categoryModel->getAll();
        include 'views/category_list.php';
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<createCategory>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->categoryModel->create($name);
                header("Location: index.php?action=categories&message=created");
                exit();
            } else {
                $error_message = "Category name is required.";
            }
        }
        $categories = $this->categoryModel->getAll(); 
        include 'views/category_list.php';
    }
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<updateCategory>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//

    public function updateCategory($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $this->categoryModel->update($id, $name);
                header("Location: index.php?action=categories&message=updated");
                exit();
            } else {
                $error_message = "Category name is required.";
            }
        }
        $category = $this->categoryModel->getById($id);
        $categories = $this->categoryModel->getAll(); 
        include 'views/category_list.php';
    }
}
