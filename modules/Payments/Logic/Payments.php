<?php

namespace possystem\modules\Payments\Logic;

use possystem\classes\singleton\Singleton;

class Payments
{
    use Singleton;
    private \possystem\modules\Payments\Data\Payments $data;

    public function __construct()
    {
        $this->data = new \possystem\modules\Payments\Data\Payments();
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
        return $this->data->add($receiptID, $totalPaid, $tip);
    }

}