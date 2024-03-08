<?php

namespace possystem\modules\Categories\Data;


use possystem\classes\database\DB;
use possystem\modules\Categories\Model\Categorie;

class Categories
{
    private DB $db;
    private Categorie $tableObject;
    public function __construct()
    {
        $this->tableObject = new Categorie();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param $name     string Name of the category
     * @param $description string Description of category
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:18)
     */
    public function add(string $name, string $description): array
    {
        return $this->db->insert([
            'name' => $name,
            'description' => $description
        ]);
    }

    /**
     * @param int $categoryID ID of the category
     *
     * @return array
     * @author bmarinus (10-5-2022 - 13:58)
     */
    public function remove(int $categoryID): array
    {
        return $this->db->remove($categoryID);
    }

    /**
     * @param int $categoryID ID of the category
     *
     * @return array
     * @author bmarinus (10-5-2022 - 14:12)
     */
    public function getByID(int $categoryID): array
    {
        return $this->db->getByID($categoryID);
    }

    public function getAll(): array
    {
        return $this->db->selectAll();
    }

    /**
     * @param $categoryID  int ID of the category
     * @param $name        string The name of the category
     * @param $description string The description of the category
     *
     * @return array|false|\PDOStatement
     * @author bmarinus (10-5-2022 - 14:58)
     */
    public function change(int $categoryID, string $name, string $description) {
        $table = "`{$this->tableObject->table}`";
        return $this->db->query("UPDATE {$table}  SET `name` = '$name', `description` = '$description' WHERE `id` = $categoryID");
    }
}