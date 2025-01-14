<?php
// src/controllers/CategoryController.php

class CategoryController {
    private $categoryModel;

    public function __construct($db) {
        $this->categoryModel = new Category($db);
    }

    public function listCategories() {
        return $this->categoryModel->getAll();
    }

    public function addCategory($name) {
        $this->categoryModel->name = $name;
        return $this->categoryModel->create();
    }
}
