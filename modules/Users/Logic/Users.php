<?php

namespace possystem\modules\Users\Logic;

use possystem\classes\singleton\Singleton;

class Users
{
    use Singleton;
    private \possystem\modules\Users\Data\Users $data;

    public function __construct()
    {
        $this->data = new \possystem\modules\Users\Data\Users();
    }

    /**
     * @param $name     string Name of the user
     * @param $userName string Username for the user
     * @param $password string Password for the user UNHASHED
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:32)
     */
    public function add(string $name, string $userName, string $password, int $permissionGroupID): array
    {
        $password = hash('sha512', $password);
        return $this->data->add($name, $userName, $password, $permissionGroupID);
    }

    /**
     * @param $userID int ID of the user
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:31)
     */
    public function remove(int $userID): array
    {
        return $this->data->remove($userID);
    }

    /**
     * @param $userID   int ID of the user
     * @param $password string new Password for the user
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:30)
     */
    public function changePassword(int $userID, string $password): array
    {
        printr($password);
        $password = hash('sha512', $password);
        printr($password);
        return $this->data->changeField($userID, 'Password', $password);
    }

    /**
     * @param $userID int ID of the user
     * @param $name   string New name for the user
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:30)
     */
    public function changeName(int $userID, string $name): array
    {
        return $this->data->changeField($userID, 'Name', $name);
    }

    public function changeUsername(int $userID, string $username): array
    {
        return $this->data->changeField($userID, 'Username', $username);
    }

    public function changePermissionGroup(int $userID, int $permissiongroup): array
    {
        return $this->data->changeField($userID, 'permission_group_id', $permissiongroup);
    }

    /**
     * @param $userID int UserID of the user
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:28)
     */
    public function getByID(int $userID): array
    {
        return $this->data->getByID($userID);
    }

    /**
     * @return array
     * @author bmarinus (10-5-2022 - 11:17)
     */
    public function getAll(): array
    {
        return $this->data->getAll();
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return array
     * @author bmarinus (17-5-2022 - 09:20)
     */
    public function login(string $username, string $password): array
    {
        $password = hash('sha512', $password);
        $user = $this->data->login($username, $password);
        if ($user['complete'] === FALSE) {
            global $_SESSION;
            $_SESSION['IsLoggedInOnPosSystem'] = FALSE;
            return $user;
        }
        $_SESSION['IsLoggedInOnPosSystem'] = TRUE;
        $_SESSION['User'] = $user['result'];
        return $user;
    }

    public function checkPermissionLevel($userID, $permissionLevel) : bool
    {
        $user = $this->getByID($userID);
        if ($user['complete'] === FALSE) {
            return FALSE;
        }
        return $user['result']->permission_group_id >= $permissionLevel;
    }

}