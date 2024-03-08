<?php

namespace possystem\modules\PermissionGroups\Model;

/**
 * Class Permissiongroup
 *
 * @property string $table;
 * @property int $id;
 * @property string $groupName;
 *
 * @package possystem\modules\PermissionGroups\Model
 * @author  bmarinus (6-7-2022 - 14:27)
 */
class Permissiongroup
{
    public string $table;
    public int $id;
    public string $groupName;

    public function __construct()
    {
        $this->table = 'permission_groups';
    }
}