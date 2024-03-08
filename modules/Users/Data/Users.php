<?php

namespace possystem\modules\Users\Data;

use possystem\modules\Users\Model\User;
use possystem\classes\database\DB;

class Users
{
    private DB $db;
    private User $tableObject;
    public function __construct()
    {
        $this->tableObject = new User();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param $name     string Name of the user
     * @param $userName string Username for the user
     * @param $password string Password for the user HASHED
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:18)
     */
    public function add(string $name, string $userName, string $password, int $permissionGroupID): array
    {
        return $this->db->insert([
            'name' => $name,
            'username' => $userName,
            'password' => $password,
            'permission_group_id' => $permissionGroupID
        ]);
    }

    /**
     * @param $userID int UserID of the user
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:20)
     */
    public function remove(int $userID): array
    {
        return $this->db->remove($userID);
    }

    /**
     * @param $userID int UserID of the user
     * @param $key    string Key of the field in the DataBase
     * @param $value  string Value of the field
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:20)
     */
    public function changeField(int $userID, string $key, string $value): array
    {
        return $this->db->updateField($userID, $key, $value);

    }

    /**
     * @param int $userID
     *
     * @return array
     * @author bmarinus (10-5-2022 - 11:05)
     */
    public function getByID(int $userID): array
    {
        return $this->db->getByID($userID);
    }

    /**
     * @return array
     * @author bmarinus (10-5-2022 - 11:17)
     */
    public function getAll(): array
    {
        return $this->db->selectAll();
    }

    /**
     * @param string $username Username of User
     * @param string $password Hashed password of User
     *
     * @return array
     * @author bmarinus (17-5-2022 - 09:16)
     */
    public function login(string $username, string $password): array
    {
        $table = "`{$this->tableObject->table}`";
        return $this->db->query("SELECT * FROM $table WHERE `username` = '$username' AND `password` = '$password'", "SELECT");
    }
}