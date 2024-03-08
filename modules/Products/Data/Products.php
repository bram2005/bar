<?php

namespace possystem\modules\Products\Data;

use possystem\classes\database\DB;
use possystem\modules\Products\Model\Product;

class Products
{
    private DB $db;
    private Product $tableObject;
    public function __construct()
    {
        $this->tableObject = new Product();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param string $name
     * @param float  $price
     * @param int    $categoryID
     * @param string $image
     *
     * @return array
     * @author bmarinus (16-5-2022 - 15:50)
     */
    public function add(string $name, float $price, int $categoryID, string $image): array
    {
        return $this->db->insert([
            'name' => $name,
            'price' => $price,
            'category_id' => $categoryID,
            'image' => $image
        ]);
    }

    /**
     * @param int $productID
     *
     * @return array
     * @author bmarinus (16-5-2022 - 15:49)
     */
    public function remove(int $productID): array
    {
        return $this->db->remove($productID);
    }

    public function getByID(int $productID): array
    {
        return $this->db->getByID($productID);
    }

    public function getAll(): array
    {
        return $this->db->selectAll();
    }

    public function change(int $productID, string $name, float $price, int $categoryID, string $image) {
        $table = "`{$this->tableObject->table}`";
        return $this->db->query("UPDATE {$table}  SET `name` = '$name', `price` = $price, `category_id` = $categoryID, `image` = '$image' WHERE `id` = $productID");
    }

    public function getAllByCategoryID(int $categoryID): array
    {
        return $this->db->selectAllByField("category_id", $categoryID);
    }
}