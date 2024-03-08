<?php

namespace possystem\modules\Categories\Model;

/**
 * Class Categorie
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @package possystem\modules\Categories\Model
 * @author  bmarinus (10-5-2022 - 12:00)
 */
class Categorie
{
    public string $table;
    public int $id;
    public string $name;
    public string $description;

    public function __construct()
    {
        $this->table = 'categories';
    }
}