<?php

namespace possystem\modules\PermissionGroups\Logic;

use possystem\classes\singleton\Singleton;

class Permissiongroups
{
    use Singleton;
    private \possystem\modules\PermissionGroups\Data\Permissiongroups $data;

    public function __construct()
    {
        $this->data = new \possystem\modules\PermissionGroups\Data\Permissiongroups();
    }

    public function add(int $id, string $name): array
    {
        return $this->data->add($id, $name);
    }

    public function getAll(): array
    {
        return $this->data->getAll();
    }
}