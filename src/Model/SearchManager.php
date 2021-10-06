<?php

namespace App\Model;

class SearchManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'search';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $search
     * @return int
     */
    public function insert(array $search): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`firstname`) VALUES (:firstname)");
        $statement->bindValue('firstname', $search['firstname'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $search
     * @return bool
     */
    public function update(array $search): bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `firstname` = :firstname WHERE id=:id");
        $statement->bindValue('id', $search['id'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $search['firstname'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
