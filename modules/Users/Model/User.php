<?php

namespace possystem\modules\Users\Model;

/**
 * Class User
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property int $permissionGroupID
 * @property float $percentage
 *
 * @package possystem\modules\Users\Model
 * @author  bmarinus (10-5-2022 - 10:21)
 */
class User
{
    public string $table;
    public int $id;
    public string $name;
    public string $username;
    public string $password;
    public int $permissionGroupID;
    public float $percentage;

    public function __construct()
    {
        $this->table = 'users';
    }
}