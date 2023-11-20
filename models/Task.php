<?php

class Task extends Model
{
  private $name;
  private $description;
  private $startDate;
  private $finishDate;
  private $createdInProject;
  private $userId;

  public function __construct($name = null, $description = null, $startDate = null, $finishDate = null, $createdInProject = null, $userId)
  {
    parent::__construct();
    $this->name = $name;
    $this->description = $description;
    $this->startDate = $startDate;
    $this->finishDate = $finishDate;
    $this->createdInProject = $createdInProject;
    $this->userId = $userId;
  }

  // Métodos Get
  public function getName()
  {
    return $this->name;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function getFinishDate()
  {
    return $this->finishDate;
  }

  public function getCreatedInProject()
  {
    return $this->createdInProject;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  // Métodos Set
  public function setName($name)
  {
    $this->name = $name;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;
  }

  public function setFinishDate($finishDate)
  {
    $this->finishDate = $finishDate;
  }

  public function setCreatedByUser($createdInProject)
  {
    $this->createdInProject = $createdInProject;
  }

  public function setUserId($userId) {
    $this->userId = $userId;
  }

  public function save()
  {
    try {
      $conn = $this->db->getConnection();

      $sql = "INSERT INTO tasks (Name, Description, StartDate, FinishDate, Project_id) VALUES (?, ?, ?, ?, ?)";

      $this->db->executeQuery(false, $sql, [
        $this->name,
        $this->description,
        $this->startDate,
        $this->finishDate,
        $this->createdInProject,
      ]);

      $task_id = $conn->lastInsertId();

      $sql = 'INSERT INTO users_has_tasks (User_id, Task_id) VALUES (?, ?)';

      return $this->db->executeQuery(false, $sql, [
        $this->userId,
        $task_id
      ]);
    } catch (Exception $e) {
      // Manejo de errores
      return $e->getMessage();
    }
  }
}