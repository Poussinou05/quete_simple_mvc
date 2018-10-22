<?php
namespace Model;


class ItemManager extends AbstractManager
{
    const TABLE = 'item';

    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    // récupération de tous les items
    public function selectAllItems(): array
    {
        $query = "SELECT * FROM item";
        $res = $this->pdo->query($query, Item::class);
        return $res->fetchAll();
    }
// récupération d'un seul item
    public function selectOneItem(int $id) : array
    {
        $query = "SELECT * FROM item WHERE id = :id";
        $statement = $this->pdo->prepare($query, Item::class);
        $statement->bindValue(':id',$id,\PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function insert($item): string
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (title) VALUES
         (:title)");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    public function update($item)
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET title = :title WHERE id = :id");
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $statement->execute([':id' => $id]);
        //$_SERVER['HTTP_REFERER'] = Sert à retourner sur la page précédente
        return header('Location: ' .  $_SERVER['HTTP_REFERER']);
    }

}
?>