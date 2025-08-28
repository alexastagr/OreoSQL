<?php

declare(strict_types=1);

session_start();
header("Content-Type: application/json; charset=UTF-8");

final class OreoSQLApi
{
    private ?mysqli $conn = null;

    public function __construct()
    {
        $this->conn = $this->getConn();
    }

    private function getConn(): ?mysqli
    {
        if (!isset($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name'])) return null;
        $mysqli = @new mysqli(
            (string)$_SESSION['db_host'],
            (string)$_SESSION['db_user'],
            (string)$_SESSION['db_pass'],
            (string)$_SESSION['db_name']
        );
        if ($mysqli->connect_error) return null;
        $mysqli->set_charset("utf8mb4");
        return $mysqli;
    }
}
