<?php

namespace App\Model;

class AccountManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'users';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $account
     * @return int
     */
    public function insert(array $account): int
    {
        

        // prepared request
        $sql = "INSERT INTO " . self::TABLE .
            "(`firstname`, `lastname`, `email`, `username`, `password`, `role`, `birthday`, `address`, `city`, `postal_code`, `phone`)
        VALUES
        (:firstname, :lastname, :email, :username, :password, :role, :birthday, :address, :city, :postal_code, :phone)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':firstname', $account['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $account['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $account['email'], \PDO::PARAM_STR);
        $statement->bindValue(':username', $account['username'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $account['password'], \PDO::PARAM_STR);
        $statement->bindValue(':role', $account['role'], \PDO::PARAM_STR);
        $statement->bindValue(':birthday', $account['birthday'], \PDO::PARAM_STR);
        $statement->bindValue(':address', $account['address'], \PDO::PARAM_STR);
        $statement->bindValue(':city', $account['city'], \PDO::PARAM_STR);
        $statement->bindValue(':postal_code', $account['postal_code'], \PDO::PARAM_STR);
        $statement->bindValue(':phone', $account['phone'], \PDO::PARAM_STR);
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
     * @param array $account
     * @return bool
     */
    public function update(array $account): bool
    {
        // prepared request
        $sql = "UPDATE " 
        . self::TABLE .
        " SET 
        `firstname` = :firstname,
        `lastname` = :lastname,
        `username` = :username,
        `password` = :password,
        `email` = :email,
        `role` = :role,
        `birthday` = :birthday,
        `address` = :address,
        `city` = :city,
        `postal_code` = :postal_code,
        `phone` = :phone
        WHERE id=:id";

        // prepared request
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('id', $account['id'], \PDO::PARAM_INT);
        $statement->bindValue(':firstname', $account['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $account['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':username', $account['username'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $account['password'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $account['email'], \PDO::PARAM_STR);
        $statement->bindValue(':role', $account['role'], \PDO::PARAM_STR);
        $statement->bindValue(':birthday', $account['birthday'], \PDO::PARAM_STR);
        $statement->bindValue(':address', $account['address'], \PDO::PARAM_STR);
        $statement->bindValue(':city', $account['city'], \PDO::PARAM_STR);
        $statement->bindValue(':postal_code', $account['postal_code'], \PDO::PARAM_INT);
        $statement->bindValue(':phone', $account['phone'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }

        return $statement->execute();
    }

    /**
     * Get one row from database by EMAIL.
     *
     * @param  string $email
     *
     * @return array
     */
    public function selectOneByEmail(string $email)
    {
        // prepared request
        $sql = "SELECT * FROM `$this->table` WHERE `email`=:email";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
