<?php

namespace Controller;
//src/Controller/ItemController.php;
//require __DIR__ . "/../Model/ItemManager.php";
use Model\ItemManager;
use Model\CategoryManager;


class ItemController
{

    public function index()
    {
        $itemsManager = new ItemManager();
        $items = $itemsManager->selectAllItems();
        require __DIR__ . '/../View/item.php';
    }

    public function show($id)
    {
        $itemsManager = new ItemManager();
        $item = $itemsManager->selectOneItem($id);
        require __DIR__. '/../View/showItem.php';
    }

}
?>