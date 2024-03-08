<?php

namespace possystem\modules\BarService\Logic;

use possystem\classes\singleton\Singleton;
use possystem\modules\Receipts\Logic\Receipts;

class BarServices
{
    use Singleton;
    private \possystem\modules\BarService\Data\BarServices $data;

    public function __construct()
    {
        $this->data =new \possystem\modules\BarService\Data\BarServices();
    }

    /**
     * @param int $userID
     *
     * @return array
     * @author bmarinus (20-5-2022 - 13:37)
     */
    public function add(int $userID) :array
    {
        return $this->data->add($userID);
    }

    public function remove(int $barServiceID) :array
    {
        return $this->data->remove($barServiceID);
    }

    public function addComment(int $barServiceID, string $newComment) :array {
        $barService = $this->getByID($barServiceID);
        $comment = $barService['result']->comments;
        $comment .= "{$newComment}<br/>";
        return $this->data->addComment($barServiceID,$comment);
    }

    public function getByID(int $barServiceID) :array
    {
        return $this->data->getByID($barServiceID);
    }

    public function getAll() :array
    {
        return $this->data->getAll();
    }

    public function end(int $barServiceID) : array {
        $receipts = Receipts::getInstance()->getAllByBarService($barServiceID);
        $totalRevenue = 0;
        $totalTips = 0;
        foreach($receipts['result'] as $receipt) {
            $totalRevenue += $receipt->total_paid;
            $totalTips += $receipt->tip;
        }
        if($totalRevenue === 0) {
            return $this->data->remove($barServiceID);
        }
        return $this->data->end($barServiceID, $totalRevenue, $totalTips);
    }
    public function checkIfBarServiceIsClosed(int $barServiceID) {
        $barService = $this->getByID($barServiceID);
        if(empty($barService['result']->end_datetime)) {
            return FALSE;
        }
        return TRUE;
    }

    public function getOpenBarServiceOnUser(int $userID) {
        $barService = $this->data->getOpenBarServiceOnUser($userID);
        if ($barService['complete']) {
            $_SESSION['BarService'] = $barService['result'];
        }
    }

    public function getBarServiceByMonthAndUser(int $userID, string $month) {
        return $this->data->getBarServiceByMonthAndUser($userID, $month);
    }
}