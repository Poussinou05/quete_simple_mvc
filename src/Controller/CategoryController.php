<?php

namespace Controller;

use Model\Category;
use Model\CategoryManager;
use Twig_Loader_Filesystem;
use Twig_Environment;

class CategoryController extends AbstractController
{
    protected $twig;

    public function showCategory($id)
    {
        $categoryManager = new CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);
        //require __DIR__. '/../View/showCategory.html.twig';

        return $this->twig->render('showCategory.html.twig', ['categories' => $category]);
    }
    public function indexCategories()
    {
        $categoryManager = new CategoryManager($this->pdo);
        $categories = $categoryManager->selectAll();
        //require __DIR__ . '/../View/categories.html.twig';

        return $this->twig->render('categories.html.twig', ['categories' => $categories]);
    }

    public function addCategory()
    {
        $error = [];
        $name = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $categoryManager = new CategoryManager($this->pdo);
            $category = new Category();
            if (empty($_POST['name'])) {
                // TODO : validations des valeurs saisies dans le form
                $error ['name'] = "A category without name? It's possible?";
            }else{
                $name = $this->verif($_POST['name']);
            }
            //si pas d'erreur
             if(empty($error)){
                 $category->setName($_POST['name']);
                 $categoryManager->insert($category);
                 header('Location: /categories');
                 exit();
             }
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('addCategory.html.twig', ['error' => $error]);
    }

    public function verif($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        $data = strip_tags($data);
        return $data;
    }

    public function delete($id)
    {
        $catgoryManager = new CategoryManager($this->pdo);
        $catgoryManager->delete($id);
    }

    public function edit($id)
    {
        $name = "";
        $categoryManager = new CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $category->setName($_POST['name']);
            $categoryManager->update($category);
            header('Location: /categories');
        }
        return $this->twig->render('editCategory.html.twig', ['category' => $category]);

    }
}