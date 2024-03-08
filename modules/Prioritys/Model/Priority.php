<?php

namespace possystem\modules\Prioritys\Model;

/**
 * Class Priority
 *
 * @property string $table;
 * @property int $id;
 * @property string $name;
 *
 * @package possystem\modules\Prioritys\Model
 * @author  bmarinus (11-7-2022 - 14:53)
 */
class Priority
{
    public string $table;
    public int $id;
    public string $name;

    public function __construct()
    {
        $this->table = 'prioritys';
    }

}