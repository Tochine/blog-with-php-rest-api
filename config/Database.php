<?php
class Database
{
    // Database credentials

    private $host = 'localhost';
    private $db_name = 'php-blog';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database Connection Successful";
        } catch (PDOException $exception) {
            echo 'Connection failed: ' . $exception->getMessage();
            exit();
        }

        return $this->conn;
    }
}
