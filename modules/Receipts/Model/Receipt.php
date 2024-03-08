<?php

namespace possystem\modules\Receipts\Model;

/**
 * Class Receipt
 *
 * @property string $table;
 * @property string $create_datetime;
 * @property string $pay_datetime;
 * @property string $name;
 * @property int $user_id;
 * @property float $total_paid;
 * @property float $tip;
 *
 * @package possystem\modules\Receipts\Model
 * @author  bmarinus (17-5-2022 - 15:02)
 */
class Receipt
{
    public string $table;
    public string $create_datetime;
    public string $pay_datetime;
    public string $name;
    public int $user_id;
    public float $total_paid;
    public float $tip;
    public function __construct()
    {
        $this->table = 'receipts';
    }

}