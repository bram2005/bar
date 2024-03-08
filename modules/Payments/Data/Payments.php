<?php

namespace possystem\modules\Payments\Data;

use possystem\classes\database\DB;
use possystem\modules\Payments\Model\Payment;

class Payments
{
    private DB $db;
    private Payment $tableObject;
    public function __construct()
    {
        $this->tableObject = new Payment();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param int   $receiptID
     * @param float $totalPaid
     * @param float $tip
     *
     * @return array
     * @author bmarinus (19-5-2022 - 11:37)
     */
    public function add(int $receiptID, float $totalPaid, float $tip): array
    {
        return $this->db->insert([
            'receipt_id' => $receiptID,
            'total_paid' => $totalPaid,
            'tip' => $tip
        ]);
    }

}