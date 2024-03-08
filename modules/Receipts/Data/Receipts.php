<?php

namespace possystem\modules\Receipts\Data;

use possystem\classes\database\DB;
use possystem\modules\Receipts\Model\Receipt;

class Receipts
{
    private DB $db;
    private Receipt $tableObject;
    public function __construct()
    {
        $this->tableObject = new Receipt();
        $this->db = new DB($this->tableObject->table);
    }

    /**
     * @param string $name
     * @param int    $creatorID
     *
     * @return array
     * @author bmarinus (19-5-2022 - 09:47)
     */
    public function add(string $name, int $creatorID, int $barServiceID): array
    {
        return $this->db->insert([
            'name' => $name,
            'user_id' => $creatorID,
            'bar_service_id' => $barServiceID
        ]);
    }

    /**
     * @param int $receiptID
     *
     * @return array
     * @author bmarinus (19-5-2022 - 09:47)
     */
    public function remove(int $receiptID): array
    {
        return $this->db->remove($receiptID);
    }

    /**
     * @param int $receiptID
     *
     * @return array
     * @author bmarinus (19-5-2022 - 09:48)
     */
    public function getByID(int $receiptID): array
    {
        return $this->db->getByID($receiptID);
    }

    public function getAll(): array
    {
        return $this->db->selectAll();
    }

    public function getAllByBarService($barServiceID): array
    {
        return $this->db->selectAllByField('bar_service_id', $barServiceID, "pay_datetime,name");
    }

    /**
     * @param int   $receiptID
     * @param float $totalPaid
     * @param float $tip
     *
     * @return array
     * @author bmarinus (19-5-2022 - 09:47)
     */
    public function paid(int $receiptID, float $totalPaid, float $tip): array
    {
        return $this->db->query("UPDATE {$this->tableObject->table}  SET `pay_datetime` = NOW(), `total_paid` = $totalPaid, `tip` = $tip WHERE `id` = $receiptID");
    }

    public function changeName(int $receiptID, string $name): array
    {
        return $this->db->updateField($receiptID, 'name', $name);
    }

}