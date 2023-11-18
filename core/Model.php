<?php

require_once './core/Database.php';

class Model
{
  protected $db;
  protected $table;
  protected $attributes = [];

  public function __construct($table, $attributes)
  {
    $this->db = new Database();
    $this->table = $table;
    $this->attributes = $attributes;
  }

  public function save()
  {
    $columns = implode(',', array_keys($this->attributes));
    $placeholders = ":" . implode(', :', array_keys($this->attributes));

    $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

    $result = $this->db->executeQuery(false, $query, $this->attributes);

    return $result;
  }

}