<?php

namespace form\db;

class DBConnection
{
    private static $dbConnection;
    private static $instance = null;

    /**
     * @throws \Exception
     */
    private function __construct()
    {
        $host = 'localhost';
        $port = '3306';
        $db = '62130_Ivan_Hristov';
        $usr = 'root';
        $pwd = '';

        try {
            self::$dbConnection = new \PDO("mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db", $usr, $pwd);
            self::$dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDO\Exception $e) {
            throw new \Exception("Грешка при свързване с базата от данни: " . $e->getMesagge());
        }
    }

    /**
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DBConnection();
        }

        return self::$instance;
    }

    public static function getPDO()
    {
        return self::$dbConnection;
    }
}
