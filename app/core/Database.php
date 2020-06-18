<?php


class Database
{
    private static $instance = null;
    private $connection;
    private $serverName = "hopdt-X510UQ";
    private $userName = "root";
    private $password = "123456a@";
    private $dbname = "mini_project_php";
    private $option = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES uft8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    private function __construct()
    {
        $this->connection = new PDO("mysql:host=" .
                                        $this->serverName .
                                        ";dbname=" .
                                        $this->dbname,
                                        $this->userName,
                                        $this->password,
                                        $this->option);
    }

    public static function query($query)
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        $result = self::$instance->connection->prepare($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        if ($result->columnCount()) {
            return $result->fetchAll();
        }
    }

}