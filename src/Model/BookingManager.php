<?php

namespace App\Model;

class BookingManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'contract';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $booking
     * @return int
     */
    public function insert(array $booking): int
    {
        // prepared request
        $sql = "INSERT INTO " . self::TABLE .
            "(`user_id`, `renter_id`, `announce_id`, `duration`, `price`)
        VALUES
        (:user_id, :renter_id, :announce_id, :duration, :price)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':user_id', $booking['user_id'], \PDO::PARAM_INT);
        $statement->bindValue(':renter_id', $booking['renter_id'], \PDO::PARAM_INT);
        $statement->bindValue(':announce_id', $booking['announce_id'], \PDO::PARAM_INT);
        $statement->bindValue(':duration', $booking['duration'], \PDO::PARAM_INT);
        $statement->bindValue(':price', $booking['price'], \PDO::PARAM_INT);
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
     * @param array $booking
     * @return bool
     */
    public function update(array $booking): bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $booking['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $booking['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }


    public function selectOneByUserId(int $user_id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE user_id=:user_id");
        $statement->bindValue('user_id', $user_id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
