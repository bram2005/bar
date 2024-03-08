<?php

namespace possystem\modules\Notifications\Logic;

use possystem\classes\singleton\Singleton;

class Notifications
{
    use Singleton;
    private \possystem\modules\Notifications\Data\Notifications $data;

    public function __construct()
    {
        $this->data = new \possystem\modules\Notifications\Data\Notifications();
    }

    public function add(string $title, string $message, int $priorityID): array
    {
        return $this->data->add($title, $message, $priorityID);
    }

    /**
     * @return array
     * @author bmarinus (10-5-2022 - 11:17)
     */
    public function getAll(): array
    {
        $notifications = $this->data->getAll();
        if ($notifications['complete'] === FALSE) {
            return $notifications;
        }
        foreach ($notifications['result'] as $notification) {
            switch($notification->priority_id) {
                case 1:
                    $notification->priority_code = "alert-warning";
                    break;
                case 2:
                    $notification->priority_code = "alert-danger";
                    break;
                default:
                    $notification->priority_code = "alert-primary";
                    break;
            }
        }
        return $notifications;
    }

    public function getAllByView(): array
    {
        $notifications = $this->data->getAllByView();
        if ($notifications['complete'] === FALSE) {
            return $notifications;
        }
        foreach ($notifications['result'] as $notification) {
            switch($notification->priority_id) {
                case 1:
                    $notification->priority_code = "alert-warning";
                    break;
                case 2:
                    $notification->priority_code = "alert-danger";
                    break;
                default:
                    $notification->priority_code = "alert-primary";
                    break;
            }
        }
        return $notifications;
    }

    public function getByID(int $id): array
    {
        return $this->data->getByID($id);
    }

    public function changeView(int $id) {
        $notification = $this->data->getByID($id);
        if($notification['result']->view) {
            return $this->data->changeView($id, 0);
        }
        return $this->data->changeView($id, 1);

    }

    public function change(int $notificationID, string $title, string $message, int $priorityID) {
        return $this->data->change($notificationID, $title, $message, $priorityID);
    }
}