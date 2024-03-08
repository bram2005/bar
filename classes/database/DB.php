<?php
namespace possystem\classes\database;

use PDO;
use PDOException;

class DB extends PDO
{
    private string $table;

    public function __construct($table)
    {
        $config = include("config.php");
        parent::__construct("mysql:host=$config->db_host;dbname=$config->db_name", $config->db_user, $config->db_password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->table = $table;
    }

    /**
     * @param $sql  string SQL Statement
     * @param $type string|null TYPE of request
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:27)
     */
    private function execute(string $sql, string $type = NULL): array
    {
        $result['complete'] = FALSE;
        $result['error'] = NULL;
        $result['result'] = NULL;

        $stmt = $this->prepare($sql);

        try {
            $test = $stmt->execute();
            $result['complete'] = TRUE;
            $result['result'] = $test;

        } catch(PDOException $e) {
            $result['error'] = "$sql - $e";
        }
        if ($type === 'SELECT') {
            $result['result'] = $stmt->fetch(PDO::FETCH_OBJ);
        } elseif ($type === 'SELECTALL') {
            $result['result'] = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        if (empty($result['result']) && ($type === 'SELECT' || $type === 'SELECTALL')) {
            $result['complete'] = FALSE;
            $result['error'] = "Nothing Found";
        }
        if ($type === 'INSERT') {
            $result['result'] = $this->lastInsertId();
        }

        return $result;

    }

    /**
     * @param $table string Table name
     * @param $data  array Array with the data. The key must have the name of the Column
     *
     * @return array
     * @author bmarinus (9-5-2022 - 14:38)
     */
    public function insert(array $data): array
    {
        $columns = [];
        $values = [];
        foreach ($data as $key => $value) {
            $columns[] = "`$key`";
            $values[] = "'$value'";
        }
        $columns_string = implode(", ", $columns);
        $values_string = implode(", ", $values);

        $sql = "INSERT INTO {$this->table} ($columns_string) VALUES ($values_string)";
        return $this->execute($sql, "INSERT");
    }

    /**
     * @param $table string Table name
     * @param $ID    int ID of the row you want to delete
     *
     * @return array
     * @author bmarinus (9-5-2022 - 14:37)
     */
    public function remove(int $ID): array
    {
        $sql = "DELETE FROM {$this->table} WHERE `id` = $ID";
        return $this->execute($sql);
    }

    public function removeByField(string $fieldName, string $value): array
    {
        $sql = "DELETE FROM {$this->table} WHERE `$fieldName` = '$value'";
        return $this->execute($sql);
    }

    /**
     * @param $table string Table name
     * @param $id    int ID of the row you want to Update
     * @param $key   string Key of the Column that you want to update
     * @param $value string Value of the Column that you want to update
     *
     * @return array
     * @author bmarinus (9-5-2022 - 14:39)
     */
    public function updateField(int $id, string $key, string $value): array
    {
        $key = "`$key`";
        $sql = "UPDATE $this->table SET $key = '$value' WHERE `id` = $id";
        return $this->execute($sql);
    }

    /**
     * @param $table string Table name
     * @param $id    int Primary key of the Table
     *
     * @return array
     * @author bmarinus (9-5-2022 - 16:23)
     */
    public function getByID(int $id): array
    {
        $sql = "SELECT * FROM $this->table WHERE `id` = $id";
        return $this->execute($sql, 'SELECT');
    }

    /**
     * @param string $table
     *
     * @return array
     * @author bmarinus (10-5-2022 - 11:11)
     */
    public function selectAll($orderBy = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";
        if (!empty($orderBy)) {
            $sql .= " ORDER BY {$orderBy}";
        }
        return $this->execute($sql, 'SELECTALL');
    }

    /**
     * @param string $sql
     * @param null   $type
     *
     * @return array|false|\PDOStatement
     * @author bmarinus (10-5-2022 - 10:28)
     */
    public function query($sql, $type = NULL) {
        return $this->execute($sql, $type);
    }

    public function selectAllByField(string $fieldName, string $value, $orderBy = "") : array
    {
        $sql = "SELECT * FROM {$this->table} WHERE `$fieldName` = '$value' ";
        if (!empty($orderBy)) {
            $sql .= "ORDER BY $orderBy";
        }
        return $this->execute($sql, 'SELECTALL');
    }
}