<?php

namespace Controller;
//src/Controller/ItemController.php;
//require __DIR__ . "/../Model/ItemManager.php";
use Model\ItemManager;


class ItemController
{

    public function index()
    {
        $itemsManager = new ItemManager();
        $items = $itemsManager->selectAllItems();
        require __DIR__ . '/../View/item.php';
    }


}
?>