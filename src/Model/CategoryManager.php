<?php
namespace Model;

require __DIR__ . '/../../app/db.php';

class CategoryManager
{
    // récupération de toutes les categories
    public function selectAllCategories(): array
    {
        $pdo = new \PDO(DSN, USER, PASS);
        $query = "SELECT * FROM category";
        $res = $pdo->query($query);
        return $res->fetchAll();
    }

    // récupération d'une seule category
    public function selectOneCategory(int $id) : array
    {
        $pdo = new\PDO(DSN,USER,PASS);
        $query = "SELECT * FROM category WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id',$id,\PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

}