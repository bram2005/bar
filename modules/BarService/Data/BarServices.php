<?php

namespace possystem\modules\BarService\Data;

use possystem\classes\database\DB;
use possystem\modules\BarService\Model\BarService;

class BarServices
{
    private DB $db;
    private BarService $tableObject;
    public function __construct()
    {
        $this->tableObject = new BarService();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param int $userID
     *
     * @return array
     * @author bmarinus (20-5-2022 - 13:39)
     */
    public function add(int $userID) :array
    {
        return $this->db->insert([
            'user_id' => $userID
        ]);
    }

    public function remove(int $barServiceID) :array
    {
        return $this->db->remove($barServiceID);
    }

    /**
     * @param $barServiceID
     *
     * @return array
     * @author bmarinus (31-5-2022 - 14:25)
     */
    public function getByID(int $barServiceID) :array
    {
        return $this->db->getByID($barServiceID);
    }

    public function getAll() :array
    {
        return $this->db->selectAll();
    }

    /**
     * @param int    $barServiceID
     * @param string $newComment
     *
     * @return array
     * @author bmarinus (31-5-2022 - 14:25)
     */
    public function addComment(int $barServiceID, string $newComment) :array
    {
        return $this->db->updateField($barServiceID, 'comments', $newComment);
    }

    /**
     * @param int    $barServiceID
     * @param string $endDateTime
     * @param float  $totalRevenue
     *
     * @return array
     * @author bmarinus (31-5-2022 - 14:25)
     */
    public function end(int $barServiceID, float $totalRevenue, float $totalTips) : array {
        //printr("UPDATE {$this->tableObject->table}  SET `end_datetime` = NOW(), `total_revenue` = '{$totalRevenue}', `total_tips` = '{$totalTips}' WHERE `id` = {$barServiceID}");
        return $this->db->query("UPDATE {$this->tableObject->table}  SET `end_datetime` = NOW(), `total_revenue` = '{$totalRevenue}' , `total_tips` = '{$totalTips}' WHERE `id` = {$barServiceID}");
//
//        $resultEndDateTime = $this->db->updateField($barServiceID, "end_datetime", $endDateTime);
//        if ($resultEndDateTime['complete']) {
//            return $this->db->updateField($barServiceID, "total_revenue", $totalRevenue);
//        }
//        return $resultEndDateTime;
    }

    public function getOpenBarServiceOnUser(int $userID) {
        return $this->db->query( "SELECT * FROM {$this->tableObject->table} WHERE `user_id` = {$userID} AND `end_datetime` IS NULL", "SELECT");
    }

    public function getBarServiceByMonthAndUser(int $userID, string $month) {
        printr("SELECT * FROM {$this->tableObject->table} WHERE `user_id` = {$userID} AND monthname(start_datetime)='{$month}' AND `total_tips` > 0");
        return $this->db->query("SELECT * FROM {$this->tableObject->table} WHERE `user_id` = {$userID} AND monthname(start_datetime)='{$month}' AND `total_tips` > 0", "SELECTALL");
    }

}