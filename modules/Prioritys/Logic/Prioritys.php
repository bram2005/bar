<?php

namespace possystem\modules\Prioritys\Logic;

use possystem\classes\singleton\Singleton;

class Prioritys
{
    use Singleton;
    private \possystem\modules\Prioritys\Data\Prioritys $data;

    public function __construct()
    {
        $this->data =new \possystem\modules\Prioritys\Data\Prioritys();
    }

    public function add(int $id, string $name): array
    {
        return $this->data->add($id, $name);
    }

    public function getAll(): array
    {
        return $this->data->getAll();
    }

    public function getByID(int $id): array
    {
        return $this->data->getByID($id);
    }
    

}