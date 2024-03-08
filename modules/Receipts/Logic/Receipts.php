<?php

namespace possystem\modules\Receipts\Logic;

use possystem\classes\singleton\Singleton;
use possystem\modules\Payments\Logic\Payments;
use possystem\modules\ReceiptLines\Logic\ReceiptLines;

class Receipts
{
    use Singleton;
    private \possystem\modules\Receipts\Data\Receipts $data;

    public function __construct()
    {
        $this->data =new \possystem\modules\Receipts\Data\Receipts();
    }
    public function add(string $name, int $creatorID, int $barServiceID): array
    {
        return $this->data->add($name, $creatorID, $barServiceID);

    }

    public function remove(int $receiptID): array
    {
        $receiptLines = new ReceiptLines();
        $receiptLine = $receiptLines->removeByReceiptID($receiptID);
        if ($receiptLine['complete'] === TRUE) {
            return $this->data->remove($receiptID);
        }
        return $receiptLine;
    }

    public function getByID(int $receiptID): array
    {
        return $this->data->getByID($receiptID);
    }

    public function getAll() :array
    {
        return $this->data->getAll();
    }

    public function getAllByBarService($barServiceID) :array
    {
        return $this->data->getAllByBarService($barServiceID);
    }

    /**
     * @param int   $receiptID
     * @param float $totalPaid
     * @param float $tip
     *
     * @return array
     * @author bmarinus (18-5-2022 - 13:03)
     */
    public function paid(int $receiptID, float $totalPaid, float  $tip = 0.00): array
    {
        $payments = new Payments();
        $payment = $payments->add($receiptID,$totalPaid,$tip);
        if ($payment["complete"] === FALSE) {
            return $payment;
        }

        $receipt = $this->data->getByID($receiptID);
        $totalPaid += $receipt['result']->total_paid;
        $tip += $receipt['result']->tip;
        return $this->data->paid($receiptID, $totalPaid, $tip);
    }

    public function changeName(int $receiptID, string $name): array
    {
        return $this->data->changeName($receiptID, $name);
    }

    public function checkIfOpenRecieptsByBarService(int $barServiceID) {
        $receipts = $this->getAllByBarService($barServiceID);

        foreach ($receipts['result'] as $receipt) {
            if($receipt->total_paid === NULL) {
                return FALSE;
            }
        }
        return TRUE;
    }
}