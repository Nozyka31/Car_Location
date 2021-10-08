<?php

namespace App\Model;

class SearchManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'announce';-

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectAllAnnouncesById(int $id)
    {
        // prepared request
        $sql = "SELECT * FROM announce ORDER BY id DESC";
        $sql = 'SELECT city FROM announce WHERE city LIKE "%'.recherche.'%" ORDER BY id DESC';

        return $this->pdo->query($sql)->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function search(int $recherche)
    {
        // prepared request
        $sql = 'SELECT city FROM announce WHERE city LIKE "%'.$recherche.'%" ORDER BY id DESC';

        return $this->pdo->query($sql)->fetchAll();
    }
}
