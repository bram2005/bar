<?php

namespace possystem\modules\Notifications\Data;

use possystem\classes\database\DB;
use possystem\modules\Notifications\Model\Notification;

class Notifications
{
    private DB $db;
    private Notification $tableObject;
    public function __construct()
    {
        $this->tableObject = new Notification();
        $this->db = new DB($this->tableObject->table);
    }

    public function add(string $title, string $message, int $priorityID): array
    {
        return $this->db->insert([
            'title' => $title,
            'message' => $message,
            'priority_id' => $priorityID,
            'view' => 0
        ]);
    }

    /**
     * @return array
     * @author bmarinus (10-5-2022 - 11:17)
     */
    public function getAll(): array
    {
        return $this->db->selectAll("priority_id DESC");
    }

    public function getAllByView(): array
    {
        return $this->db->query("SELECT * FROM `{$this->tableObject->table}` WHERE `view` = 1", "SELECTALL");
    }

    public function getByID(int $id): array
    {
        return $this->db->getByID($id);
    }

    public function changeView(int $id, bool $view): array
    {
        return $this->db->updateField($id, "view", $view);
    }

    public function change(int $notificationID, string $title, string $message, int $piorityID) {
        $table = "`{$this->tableObject->table}`";
        return $this->db->query("UPDATE {$table}  SET `title` = '$title', `message` = '$message', `priority_id` = '$piorityID' WHERE `id` = $notificationID");
    }
}