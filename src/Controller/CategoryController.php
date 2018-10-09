<?php

namespace Controller;

use Model\CategoryManager;
use Twig_Loader_Filesystem;
use Twig_Environment;

class CategoryController
{
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
        $this->twig = new Twig_Environment($loader);
    }

    public function showCategory($id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneCategory($id);
        //require __DIR__. '/../View/showCategory.html.twig';

        return $this->twig->render('showCategory.html.twig', ['categories' => $category]);
    }
    public function indexCategories()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        //require __DIR__ . '/../View/categories.html.twig';

        return $this->twig->render('categories.html.twig', ['categories' => $categories]);
    }
}