<?php
require __DIR__ . '/../vendor/autoload.php';

use Controller\ItemController;

//$itemManager=new Model\ItemManager();
//echo $itemManager->selectAllItems();

$itemController=new ItemController();
echo $itemController->index();
?>