<?php

namespace possystem\modules\ReceiptLines\Model;

class ReceiptLine
{
    public string $table;
    public int $id;
    public int $receiptID;
    public int $productID;
    public int $amount;
    public float $totalAmount;
    public function __construct()
    {
        $this->table = 'receipt_lines';
    }

}