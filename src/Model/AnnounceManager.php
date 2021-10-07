<?php

namespace App\Model;

class AnnounceManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'announce';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $announce
     * @return int
     */
    public function insert(array $announce): int
    {
        // prepared request
        $sql = "INSERT INTO " . self::TABLE .
            "(`user_ID`, `title`, `registration_number`, `brand`, `model`, `color`, `power`, `km`, `daily_price`, `picture`, `year`)
        VALUES
        (:user_ID, :title, :registration_number, :brand, :model, :color, :power, :km, :daily_price, :picture, :year)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':user_ID', 1, \PDO::PARAM_INT);
        $statement->bindValue(':title', $announce['title'], \PDO::PARAM_STR);
        $statement->bindValue(':registration_number', $announce['registration_number'], \PDO::PARAM_STR);
        $statement->bindValue(':brand', $announce['brand'], \PDO::PARAM_STR);
        $statement->bindValue(':model', $announce['model'], \PDO::PARAM_STR);
        $statement->bindValue(':color', $announce['color'], \PDO::PARAM_STR);
        $statement->bindValue(':power', $announce['power'], \PDO::PARAM_INT);
        $statement->bindValue(':km', $announce['km'], \PDO::PARAM_INT);
        $statement->bindValue(':daily_price', $announce['daily_price'], \PDO::PARAM_INT);
        $statement->bindValue(':picture', $announce['picture'], \PDO::PARAM_STR);
        $statement->bindValue(':year', $announce['year'], \PDO::PARAM_INT);
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
     * @param array $announce
     * @return bool
     */
    public function update(array $announce): bool
    {
        // prepared request
        $sql = "UPDATE " 
        . self::TABLE .
        " SET 
        `title` = :title,
        `registration_number` = :registration_number,
        `brand` = :brand,
        `model` = :model,
        `color` = :color,
        `power` = :power,
        `km` = :km,
        `daily_price` = :daily_price,
        `picture` = :picture,
        `year` = :year
        WHERE id=:id";

        // prepared request
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('id', $announce['id'], \PDO::PARAM_INT);
        $statement->bindValue(':title', $announce['title'], \PDO::PARAM_STR);
        $statement->bindValue(':registration_number', $announce['registration_number'], \PDO::PARAM_STR);
        $statement->bindValue(':brand', $announce['brand'], \PDO::PARAM_STR);
        $statement->bindValue(':model', $announce['model'], \PDO::PARAM_STR);
        $statement->bindValue(':color', $announce['color'], \PDO::PARAM_STR);
        $statement->bindValue(':power', $announce['power'], \PDO::PARAM_STR);
        $statement->bindValue(':km', $announce['km'], \PDO::PARAM_STR);
        $statement->bindValue(':daily_price', $announce['daily_price'], \PDO::PARAM_STR);
        $statement->bindValue(':picture', $announce['picture'], \PDO::PARAM_STR);
        $statement->bindValue(':year', $announce['year'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }

        return $statement->execute();
    }
}
