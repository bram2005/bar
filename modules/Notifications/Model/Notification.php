<?php

namespace possystem\modules\Notifications\Model;

class Notification
{
    public string $table;
    public int $id;
    public string $datetime;
    public string $title;
    public string $message;
    public int $priorityID;
    public bool $view;

    public function __construct()
    {
        $this->table = 'notifications';
    }
}