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

    /**
     * Establish a new database connection
     */
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


    /**
     * Dispatch the action to the corresponding method.
     */
    public function dispatch(string $action): void
    {
        switch ($action) {
            case "login":
                $this->login();
                break;
            case "sessionCheck":
                $this->sessionCheck();
                break;
            case "list":
                $this->listTables();
                break;
            case "empty":
                $this->emptyTable();
                break;
            case "drop":
                $this->dropTable();
                break;
            case "exportDb":
                $this->exportDb();
                break;
            case "exportTable":
                $this->exportTable();
                break;
            case "import":
                $this->importSql();
                break;
            case "logout":
                $this->logout();
                break;
            default:
                $this->json(['status' => 'error', 'message' => 'Unknown action']);
        }
    }



    /**
     * Handle user login from POST request
     */
    private function login(): void
    {
        $host = $_POST['host'] ?? '';
        $db   = $_POST['db'] ?? '';
        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';

        $conn = @new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            $this->json(["status" => "error", "message" => $conn->connect_error]);
        }
        $_SESSION['db_host'] = $host;
        $_SESSION['db_name'] = $db;
        $_SESSION['db_user'] = $user;
        $_SESSION['db_pass'] = $pass;

        $this->json(["status" => "ok", "db" => $db, "host" => $host, "user" => $user]);
    }
}
