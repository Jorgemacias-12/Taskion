<?php

class Task extends Model
{
  private $id;
  private $name;
  private $description;
  private $startDate;
  private $finishDate;
  private $createdInProject;
  private $userId;

  public function __construct($id = null, $name = null, $description = null, $startDate = null, $finishDate = null, $createdInProject = null, $userId = null)
  {
    parent::__construct();
    $this->id = $id;
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

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  public function save()
  {
    try {
      $conn = $this->db->getConnection();

      $sql = "INSERT INTO tasks (Name, Description, StartDate, FinishDate, Project_id) VALUES (?, ?, ?, ?, ?)";

      var_dump($this);
      print_r("Valor:" . $this->finishDate . " <br>");
      // var_dump($this->startDate);

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

  public function read($id = null)
  {
    $sql = "SELECT * FROM tasks";


    if ($id !== null) {
      $sql .= " WHERE id = ?";
    }

    if ($id !== null) {
      $result = $this->db->executeQuery(true, $sql, [
        $id
      ]);
    } else {
      $result = $this->db->executeQuery(true, $sql, []);
    }

    return $result;
  }

  public function update()
  {
    try {
      $currentTask = $this->read($this->id);
      $currentTask = $currentTask[0];

      if (!$currentTask) {
        throw new Exception("Task doesn't exist");
      }

      $sql = "UPDATE tasks SET ";
      $updateValues = [];

      if ($this->name !== $currentTask['Name']) {
        $sql .= "Name = ?, ";
        $updateValues[] = $this->name;
      }

      if ($this->description !== $currentTask['Description']) {
        $sql .= "Description = ?, ";
        $updateValues[] = $this->description;
      }

      if ($this->startDate !== $currentTask['StartDate']) {
        $sql .= "StartDate = ?, ";
        $updateValues[] = $this->startDate;
      }

      if ($this->finishDate !== $currentTask['FinishDate']) {
        $sql .= "FinishDate = ?, ";
        $updateValues[] = $this->finishDate;
      }

      if ($this->userId !== $currentTask['User_id']) {
        $sql .= "User_id = ?, ";
        $updateValues[] = $this->userId;
      }

      // No modificamos Project_id

      // Agrega más condiciones para otros campos...

      $sql = rtrim($sql, ', ');
      $sql .= " WHERE id = ?";

      $updateValues[] = $this->id;

      return $this->db->executeQuery(false, $sql, $updateValues);
    } catch (Exception $e) {
      throw new Exception($e->getMessage(), 500);
    }
  }

  public function delete()
  {
    $sql = "DELETE FROM tasks WHERE id = ?";


    return $this->db->executeQuery(false, $sql, [
      $this->id
    ]);
  }
}