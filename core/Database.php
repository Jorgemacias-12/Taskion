<?php

class Database
{
  private $servername;
  private $username;
  private $password;
  private $database;
  private $conn;
  private $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

  public function __construct()
  {
    $this->servername = getenv("DB_HOST") ?? 'localhost';
    $this->username = getenv("DB_USERNAME") ?? "root";
    $this->password = getenv("DB_PASSWORD") !== false ? getenv("DB_PASSWORD") : '';
    $this->database = getenv("DB_DATABASE") ?? "taskion";

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
      else 
      {
        return $stmt->rowCount();
      }
    }
    catch(PDOException $e) {
      throw new Exception("Error: " . $e->getMessage());
    }
  }

  // You might also want to add a method to close the connection if needed
  public function closeConnection()
  {
    $this->conn = null;
  }

  public function getConnection() 
  {
    return $this->conn;
  }
}

?>
