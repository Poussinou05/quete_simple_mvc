<?php

namespace Controller;

use Model\ItemManager;
use Twig_Loader_Filesystem;
use Twig_Environment;


class ItemController
{
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
        $this->twig = new Twig_Environment($loader);
    }

    public function index()
    {
        $itemsManager = new ItemManager();
        $items = $itemsManager->selectAllItems();
        //require __DIR__ . '/../View/item.html.twig';

        return $this->twig->render('item.html.twig', ['items' => $items]);

    }

    public function show($id)
    {
        $itemsManager = new ItemManager();
        $items = $itemsManager->selectOneItem($id);
        //require __DIR__ . '/../View/showItem.html.twig';

        return $this->twig->render('showItem.html.twig', ['items' => $items]);
    }

}
?>