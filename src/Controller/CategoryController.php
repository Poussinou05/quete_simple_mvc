<?php

namespace Controller;

use Model\CategoryManager;

class CategoryController
{
    public function showCategory($id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneCategory($id);
        require __DIR__. '/../View/showCategory.php';
    }
    public function indexCategories()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        require __DIR__ . '/../View/categories.php';
    }
}