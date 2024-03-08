<?php

namespace possystem\modules\PermissionGroups\Data;

use possystem\classes\database\DB;
use possystem\modules\PermissionGroups\Model\Permissiongroup;

class Permissiongroups
{
    private DB $db;
    private Permissiongroup $tableObject;

    public function __construct()
    {
        $this->tableObject = new Permissiongroup();
        $this->db = new DB($this->tableObject->table);
    }

    public function add(int $id, string $name): array
    {
        return $this->db->insert([
            'name' => $name
        ]);
    }

    public function getAll(): array
    {
        return $this->db->selectAll();
    }
}