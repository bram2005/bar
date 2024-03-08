<?php

namespace possystem\modules\Categories\Logic;

use possystem\classes\singleton\Singleton;
use possystem\modules\Categories\Model\Categorie;

class Categories
{
    use Singleton;
    private \possystem\modules\Categories\Data\Categories $data;

    public function __construct()
    {
        $this->data = new \possystem\modules\Categories\Data\Categories();
    }

    /**
     * @param string $name Name of the category
     * @param string $description Description of the category
     *
     * @return array
     * @author bmarinus (10-5-2022 - 14:08)
     */
    public function add(string $name, string $description): array
    {
        return $this->data->add($name, $description);
    }

    /**
     * @param int $categoryID The ID of the category
     *
     * @return array
     * @author bmarinus (10-5-2022 - 14:08)
     */
    public function remove(int $categoryID): array
    {
        return $this->data->remove($categoryID);
    }

    /**
     * @param int $categoryID The ID of the category
     *
     * @return array
     * @author bmarinus (10-5-2022 - 14:13)
     */
    public function getByID(int $categoryID): array
    {
        return $this->data->getByID($categoryID);
    }

    public function getAll(): array
    {
        return $this->data->getAll();
    }

    /**
     * @param $categoryID  int ID of the category
     * @param $name        string The name of the category
     * @param $description string The description of the category
     *
     * @return array|false|\PDOStatement
     * @author bmarinus (10-5-2022 - 15:00)
     */
    public function change(int $categoryID, string $name, string $description) {
        return $this->data->change($categoryID, $name, $description);
    }
}