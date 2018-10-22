<?php
namespace Model;


class CategoryManager extends AbstractManager
{
        const TABLE = 'category';

        public function __construct(\PDO $pdo)
        {
            parent::__construct(self::TABLE, $pdo);
        }

    // récupération de toutes les categories
    public function selectAllCategories(): array
    {
        $query = "SELECT * FROM category";
        $res = $this->pdo->query($query, Category::class);
        return $res->fetchAll();
    }
    // récupération d'une seule category
    public function selectOneCategory(int $id) : array
    {
        $query = "SELECT * FROM category WHERE id = :id";
        $statement = $this ->pdo->prepare($query, Category::class);
        $statement->bindValue(':id',$id,\PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function insert(Category $category): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (name) VALUES (:name)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $statement->execute([':id' => $id]);
        //$_SERVER['HTTP_REFERER'] = Sert à retourner sur la page précédente
        return header('Location: ' .  $_SERVER['HTTP_REFERER']);
    }

    public function update($category)
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET name = :name WHERE id = :id");
        $statement->bindValue('id', $category->getId(), \PDO::PARAM_INT);
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->execute();
    }
}