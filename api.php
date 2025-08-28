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



    /**
     * Check if a user session exists
     */
    private function sessionCheck(): void
    {
        if (isset($_SESSION['db_host'])) {
            $this->json([
                "status" => "ok",
                "db" => $_SESSION['db_name'],
                "host" => $_SESSION['db_host'],
                "user" => $_SESSION['db_user']
            ]);
        } else {
            $this->json(["status" => "error", "message" => "No session"]);
        }
    }



    /**
     * List all tables in the connected database
     */
    private function listTables(): void
    {
        if (!$this->conn) {
            $this->json(["status" => "error", "message" => "No connection"]);
        }
        $res = $this->conn->query("SHOW TABLES");
        $tables = [];
        while ($row = $res->fetch_array()) $tables[] = $row[0];
        $this->json(["status" => "ok", "tables" => $tables]);
    }



    /**
     * Empty a specified table (TRUNCATE TABLE)
     */
    private function emptyTable(): void
    {
        $table = $_POST['table'] ?? '';
        if (!$this->conn) {
            $this->json(["status" => "error", "message" => "No connection"]);
        }
        $table = $this->conn->real_escape_string($table);
        if ($this->conn->query("TRUNCATE TABLE `$table`")) {
            $this->json(["status" => "ok", "message" => "Table emptied"]);
        } else {
            $this->json(["status" => "error", "message" => $this->conn->error]);
        }
    }


    /**
     * Drop a specified table (DROP TABLE)
     */
    private function dropTable(): void
    {
        $table = $_POST['table'] ?? '';
        if (!$this->conn) {
            $this->json(["status" => "error", "message" => "No connection"]);
        }
        $table = $this->conn->real_escape_string($table);
        if ($this->conn->query("DROP TABLE `$table`")) {
            $this->json(["status" => "ok", "message" => "Table dropped"]);
        } else {
            $this->json(["status" => "error", "message" => $this->conn->error]);
        }
    }


    /**
     * Export the entire database as an SQL file
     */
    private function exportDb(): void
    {
        if (!$this->conn) {
            $this->json(["status" => "error", "message" => "No connection"]);
        }
        $dbname = $_SESSION['db_name'];
        header("Content-Type: application/sql");
        header("Content-Disposition: attachment; filename=\"$dbname.sql\"");
        $res = $this->conn->query("SHOW TABLES");
        while ($row = $res->fetch_array()) {
            $t = $row[0];
            $create = $this->conn->query("SHOW CREATE TABLE `$t`")->fetch_assoc()["Create Table"];
            echo "$create;\n\n";
            $rows = $this->conn->query("SELECT * FROM `$t`");
            while ($r = $rows->fetch_assoc()) {
                $vals = array_map(fn($v) => is_null($v) ? "NULL" : "'" . $this->conn->real_escape_string((string)$v) . "'", array_values($r));
                echo "INSERT INTO `$t` VALUES(" . implode(",", $vals) . ");\n";
            }
            echo "\n\n";
        }
        exit;
    }


    /**
     * Export a specified table as an SQL file
     */
    private function exportTable(): void
    {
        $table = $_GET['table'] ?? '';
        if (!$this->conn) {
            $this->json(["status" => "error", "message" => "No connection"]);
        }
        $table = $this->conn->real_escape_string($table);
        header("Content-Type: application/sql");
        header("Content-Disposition: attachment; filename=\"$table.sql\"");
        $create = $this->conn->query("SHOW CREATE TABLE `$table`")->fetch_assoc()["Create Table"];
        echo "$create;\n\n";
        $rows = $this->conn->query("SELECT * FROM `$table`");
        while ($r = $rows->fetch_assoc()) {
            $vals = array_map(fn($v) => is_null($v) ? "NULL" : "'" . $this->conn->real_escape_string((string)$v) . "'", array_values($r));
            echo "INSERT INTO `$table` VALUES(" . implode(",", $vals) . ");\n";
        }
        exit;
    }



    /**
     * Import an SQL file into the connected database
     */
    private function importSql(): void
    {
        if (!isset($_FILES['sqlfile'])) {
            $this->json(["status" => "error", "message" => "No file"]);
        }
        $sql = file_get_contents($_FILES['sqlfile']['tmp_name']);
        if (!$this->conn) {
            $this->json(["status" => "error", "message" => "No connection"]);
        }
        if ($this->conn->multi_query($sql)) {
            while ($this->conn->more_results() && $this->conn->next_result()) {
            }
            $this->json(["status" => "ok", "message" => "Import successful"]);
        } else {
            $this->json(["status" => "error", "message" => $this->conn->error]);
        }
    }

    /**
     * Log out the user and destroy the session
     */
    private function logout(): void
    {
        session_destroy();
        $this->json(["status" => "ok", "message" => "Logged out"]);
    }

    /**
     * Send a JSON response 
     */

    private function json(array $data): void
    {
        echo json_encode($data);
        exit;
    }
}



$action = $_REQUEST['action'] ?? '';
$api = new OreoSQLApi();
$api->dispatch($action);
