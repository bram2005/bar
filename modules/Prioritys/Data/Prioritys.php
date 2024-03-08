<?php

namespace possystem\modules\Prioritys\Data;

use possystem\classes\database\DB;
use possystem\modules\Prioritys\Model\Priority;

class Prioritys
{
    private DB $db;
    private Priority $tableObject;

    public function __construct()
    {
        $this->tableObject = new Priority();
        $this->db = new DB($this->tableObject->table);
    }

    public function add(int $id, string $name): array {
        return $this->db->insert([
            'id' => $id,
            'name' => $name
        ]);
    }

    public function getAll(): array
    {
        return $this->db->selectAll();
    }

    public function getByID(int $id): array
    {
        return $this->db->getByID($id);
    }
}