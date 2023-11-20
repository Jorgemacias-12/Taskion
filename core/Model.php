<?php

require_once './core/Database.php';

class Model
{
  protected $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function removeDbProperty() 
  {
    unset($this->db);
  }
}