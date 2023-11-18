<?php

require_once './core/Database.php'; // Incluir la clase Database

class Model
{
  protected $db;
  protected $table;

  public function __construct($table)
  {
    $this->db = new Database();
    $this->table = $table;
  }

  public function create(array $data)
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

    return $this->db->executeQuery(false, $query, $data);
  }

  public function read($id = null)
  {
    if ($id === null) {
      $query = "SELECT * FROM {$this->table}";
      return $this->db->executeQuery(true, $query);
    } else {
      $query = "SELECT * FROM {$this->table} WHERE id = :id";
      return $this->db->executeQuery(true, $query, ['id' => $id]);
    }
  }

  public function update($id, array $data)
  {
    $setClause = implode(', ', array_map(function ($key) {
      return "{$key} = :{$key}";
    }, array_keys($data)));

    $data['id'] = $id;
    $query = "UPDATE {$this->table} SET {$setClause} WHERE id = :id";

    return $this->db->executeQuery(false, $query, $data);
  }

  public function delete($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id = :id";

    return $this->db->executeQuery(false, $query, ['id' => $id]);
  }
}
