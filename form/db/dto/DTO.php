<?php

namespace form\db\dto;

abstract class DTO
{
    public static $table;
    public static $pKey;

    public function __construct($table, $pKey)
    {
        self::$table = $table;
        self::$pKey = $pKey;
    }

    public abstract function update();

    /**
     * @param String $type One of 's', 'i', 'd' or 'b'.
     */
    protected function isInDB($dbConn, $pKeyVal, $type)
    {
        $stmt = $dbConn->prepare('SELECT * FROM ' . self::$table . ' WHERE ' . self::$pKey . '=:' . self::$pKey);
        $stmt->bindParam(':' . self::$pKey, $pKeyVal);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return \count($result) > 0;
    }
}
