<?php

namespace Controller;

use Model\ItemManager;
use Model\Item;


class ItemController extends AbstractController
{
    protected $twig;

    public function index()
    {
        $itemsManager = new ItemManager($this->pdo);
        $items = $itemsManager->selectAll();
        //require __DIR__ . '/../View/item.html.twig';

        return $this->twig->render('item.html.twig', ['items' => $items]);

    }

    public function show($id)
    {
        $itemsManager = new ItemManager($this->pdo);
        $items = $itemsManager->selectOneById($id);
        //require __DIR__ . '/../View/showItem.html.twig';

        return $this->twig->render('showItem.html.twig', ['items' => $items]);
    }

    public function add()
    {
        // TODO : validations des valeurs saisies dans le form
        $error = [];
        $title = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $item = $itemManager = new ItemManager($this->pdo);
            $item = new Item();
            if (empty($_POST['title'])) {
                $error['title'] = "Pourquoi enregistrer un Item sans nom?";
            }else{
                $title = $this->verif($_POST['title']);
            }
            // création d'un nouvel objet Item et hydratation avec les données du formulaire
            if(empty($error)){
                $item->setTitle($_POST['title']);
                // l'objet $item hydraté est simplement envoyé en paramètre de insert()
                $itemManager->insert($item);
                // si tout se passe bien, redirection
                return header('Location: /');
            }
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('addItem.html.twig', ['error' => $error]);
    }
    public function verif($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        $data = stripcslashes($data);
        return $data;
    }

    public function edit($id){
        $error = [];
        $title = "";
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);

        //vérification des champs
        if($_SERVER['REQUEST_METHOD'] === "POST"){
           if(empty($_POST['title'])){
               $error ['title'] = "Pourquoi enregistrer un Item sans nom?";
           }else{
               $title = $this->verif($_POST['title']);
           }
            if(empty($error)){
                $item->setTitle($_POST['title']);
                $itemManager->update($item);
                header('Location: /');
            }
        }
        return $this->twig->render('editItem.html.twig', ['error' => $error, 'item' => $item]);
    }

    public function delete($id)
    {
        $itemManager = new ItemManager($this->pdo);
        $deleteItem = $itemManager->delete($id);
    }

}
?>