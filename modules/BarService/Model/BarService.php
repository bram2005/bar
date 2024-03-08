<?php

namespace possystem\modules\BarService\Model;

/**
 * Class BarService
 *
 * @property string $table;
 * @property int $id;
 * @property int $userID;
 * @property string $startDatetime;
 * @property string $endDatetime;
 * @property float $totalRevenue;
 * @property string $comments;
 *
 * @package possystem\modules\BarService\Model
 * @author  bmarinus (20-5-2022 - 13:29)
 */
class BarService
{
    public string $table;
    public int $id;
    public int $userID;
    public string $startDatetime;
    public string $endDatetime;
    public float $totalRevenue;
    public string $comments;

    public function __construct()
    {
        $this->table = 'bar_services';
    }
}