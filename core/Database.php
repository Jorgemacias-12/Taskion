<?php

class Database
{
  private $servername = getenv("DB_HOST") ?? 'localhost';
  private $username = getenv("DB_USERNAME") ?? "root";
  private $password;
  private $database = getenv("DB_DATABASE") ?? "taskion";
  private $conn;
  private $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  public function __construct()
  {
    $this->password = getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : '';
    $dsn = "mysql:host={$this->servername};dbname={$this->database};charset=utf8mb4";

    try {
      $this->conn = new PDO($dsn, $this->username, $this->password, $this->options);
    } catch (PDOException $e) {
      echo "Connection error: " . $e->getMessage();
      exit;
    }
  }

  public function executeQuery($isSelect, $query, $values = [])
  {
    try {
      $stmt = $this->conn->prepare($query);
      $stmt->execute($values);

      if ($isSelect) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      return $stmt->rowCount();

    } 
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
    finally {
      $this->closeConnection();
    }
  }

  // You might also want to add a method to close the connection if needed
  public function closeConnection()
  {
    $this->conn = null;
  }
}

?>
