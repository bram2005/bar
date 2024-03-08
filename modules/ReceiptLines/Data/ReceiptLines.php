<?php

namespace possystem\modules\ReceiptLines\Data;

use possystem\classes\database\DB;
use possystem\modules\ReceiptLines\Model\ReceiptLine;

class ReceiptLines
{
    private DB $db;
    private ReceiptLine $tableObject;
    public function __construct()
    {
        $this->tableObject = new ReceiptLine();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param int   $receiptID
     * @param int   $productID
     * @param int   $amount
     * @param float $totalAmount
     *
     * @return array
     * @author bmarinus (20-5-2022 - 09:38)
     */
    public function add(int $receiptID, int $productID, int $amount, float $totalAmount) : array
    {
        return $this->db->insert([
            "receipt_id" => $receiptID,
            "product_id" => $productID,
            "amount" => $amount,
            "total_amount" => $totalAmount
        ]);
    }

    public function remove(int $receiptLineID): array
    {
        return $this->db->remove($receiptLineID);
    }

    public function removeByReceiptID(string $value): array
    {
        return $this->db->removeByField('receipt_id', $value);
    }

    public function getAllByReceiptID(int $receiptID) : array
    {
        return $this->db->selectAllByField('receipt_id', $receiptID);
    }

    public function getAllByReceiptIDMerged(int $receiptID) : array
    {
        $sql = "SELECT rl.receipt_id, p.name, rl.product_id, SUM(rl.amount) as 'amount', SUM(rl.total_amount) as 'total_amount' FROM {$this->tableObject->table} rl JOIN products p ON rl.product_id = p.id WHERE `receipt_id` = {$receiptID} GROUP BY `product_id`";
//        printr($sql);
        return $this->db->query($sql, "SELECTALL");
//        return $this->db->selectAllByField('receipt_id', $receiptID);
    }
}