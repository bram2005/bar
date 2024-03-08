<?php

namespace possystem\modules\Payments\Model;

class Payment
{
    public string $table;
    public string $receipt_id;
    public string $pay_datetime;
    public float $total_paid;
    public float $tip;
    public function __construct()
    {
        $this->table = 'payments';
    }

}