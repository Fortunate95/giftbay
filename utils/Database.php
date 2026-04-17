<?php

class Database {
    private static $instance = null;
    private $connection;

    // Private constructor to prevent direct instantiation
    private function __construct() {
        $this->connect();
    }

    // Method to get the database connection
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to establish a database connection
    private function connect() {
        try {
            // Read environment variables
            $host = getenv('DB_HOST');
            $db = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $charset = 'utf8mb4';

            // Set the DSN
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            // Create a new PDO instance
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            // Handle connection error
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Method to get the connection instance
    public function getConnection() {
        return $this->connection;
    }
}

// Usage example
//$db = Database::getInstance()->getConnection();
?>