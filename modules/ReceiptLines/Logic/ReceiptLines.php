<?php

namespace possystem\modules\ReceiptLines\Logic;

use possystem\classes\singleton\Singleton;
use possystem\modules\Products\Logic\Products;

class ReceiptLines
{
    use Singleton;
    private \possystem\modules\ReceiptLines\Data\ReceiptLines $data;

    public function __construct()
    {
        $this->data = new \possystem\modules\ReceiptLines\Data\ReceiptLines();
    }

    /**
     * @param int   $receiptID
     * @param int   $productID
     * @param int   $amount
     *
     * @return array
     * @author bmarinus (20-5-2022 - 09:38)
     */
    public function add(int $receiptID, int $productID, int $amount, $type = "+") : array
    {
        $products = new Products();
        $product = $products->getByID($productID);
        if ($product['complete'] === false) {
            return $product;
        }
        if ($type === "-") {
            $totalAmount = -$product['result']->price * $amount;
            $amount = -$amount;
        } else {
            $totalAmount = $product['result']->price * $amount;
        }
        return $this->data->add($receiptID, $productID, $amount, $totalAmount);
    }

    public function remove(int $receiptLineID): array
    {
        return $this->data->remove($receiptLineID);
    }

    public function removeByReceiptID(string $value): array
    {
        return $this->data->removeByReceiptID($value);
    }

    public function getAllByReceiptID(int $receiptID) : array
    {
        return $this->data->getAllByReceiptID($receiptID);
    }

    public function getAllByReceiptIDMerged(int $receiptID) : array
    {
        $receiptLinesResult = $this->data->getAllByReceiptIDMerged($receiptID);
        $receiptLines = [];
        foreach($receiptLinesResult['result'] as $receiptLine) {
            if ($receiptLine->amount <= 0) {
                continue;
            }
            array_push($receiptLines, $receiptLine);
        }
        $receiptLinesResult['result'] = $receiptLines;
        return $receiptLinesResult;

    }

}