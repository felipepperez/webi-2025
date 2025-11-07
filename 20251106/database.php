<?php
require_once 'config.php';

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new PDO(DB_DSN);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->createTable();
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function createTable()
    {
        $stmt = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'");
        $tableExists = $stmt->fetch() !== false;
        
        if (!$tableExists) {
            $sql = "CREATE TABLE users ( 
                    id INT AUTO_INCREMENT PRIMARY KEY, 
                    nome TEXT NOT NULL, 
                    email TEXT UNIQUE NOT NULL, 
                    senha TEXT NOT NULL
                )";
            $this->pdo->exec($sql);
        }
    }
}

$db = Database::getInstance();