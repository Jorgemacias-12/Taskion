<?php
class Model
{
  protected $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  // Métodos comunes de CRUD (Crear, Leer, Actualizar, Borrar)
  // Puedes implementar estos métodos en tus modelos específicos según tus necesidades

  public function create($table, $data)
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));

    $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
    $values = array_values($data);

    return $this->db->executeQuery(false, $query, $values);
  }

  public function read($table, $id)
  {
    $query = "SELECT * FROM {$table} WHERE id = ?";
    $values = [$id];

    return $this->db->executeQuery(true, $query, $values);
  }

  public function update($table, $id, $data)
  {
    $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';

    $query = "UPDATE {$table} SET {$setClause} WHERE id = ?";
    $values = array_merge(array_values($data), [$id]);

    return $this->db->executeQuery(false, $query, $values);
  }

  public function delete($table, $id)
  {
    $query = "DELETE FROM {$table} WHERE id = ?";
    $values = [$id];

    return $this->db->executeQuery(false, $query, $values);
  }
}
