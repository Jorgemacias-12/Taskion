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

  public function read($user_id = null, $task_id = null)
  {
    // La consulta base selecciona tareas asociadas al user_id a través de la tabla de proyectos
    $sql = "SELECT tasks.* FROM tasks 
            JOIN projects ON tasks.project_id = projects.id 
            WHERE projects.user_id = ?";

    // Parámetros para la consulta SQL
    $params = [$user_id];

    // Si se proporcionó un id de tarea, agregarlo como condición
    if ($task_id !== null) {
      $sql .= " AND tasks.id = ?";
      $params[] = $task_id;
    }

    // Ejecuta la consulta con los parámetros
    $result = $this->db->executeQuery(true, $sql, $params);

    return $result;
  }

  public function update()
  {
    try {

      $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

      $currentTask = $this->read($user->getId(), $this->id);  // Suponiendo que tengas un método read en la clase Task
      $currentTask = $currentTask[0];

      if (!$currentTask) {
        throw new Exception("Task doesn't exist");
      }

      $currentTask = new Task(
        $currentTask['id'],
        $currentTask['Name'],
        $currentTask['Description'],
        $currentTask['StartDate'],
        $currentTask['FinishDate'],
        $currentTask['Project_id']
      );

      // Compara los valores actuales con los nuevos
      if (
        $this->name === $currentTask->getName() &&
        $this->description === $currentTask->getDescription() &&
        $this->startDate === $currentTask->getStartDate() &&
        $this->finishDate === $currentTask->getFinishDate() &&
        $this->createdInProject === $currentTask->getCreatedInProject()
      ) {
        return true;
      }

      $sql = "UPDATE tasks SET ";
      $updateValues = [];

      if ($this->name !== $currentTask->getName()) {
        $sql .= "Name = ?, ";
        $updateValues[] = $this->name;
      }

      if ($this->description !== $currentTask->getDescription()) {
        $sql .= "Description = ?, ";
        $updateValues[] = $this->description;
      }

      if ($this->startDate !== $currentTask->getStartDate()) {
        $sql .= "StartDate = ?, ";
        $updateValues[] = $this->startDate;
      }

      if ($this->finishDate !== $currentTask->getFinishDate()) {
        $sql .= "FinishDate = ?, ";
        $updateValues[] = $this->finishDate;
      }

      if ($this->createdInProject !== $currentTask->getCreatedInProject()) {
        $sql .= "Project_id = ?, ";
        $updateValues[] = $this->createdInProject;
      }

      $sql = rtrim($sql, ', ');

      $sql .= " WHERE id = ?";

      $updateValues[] = $this->id;

      return $this->db->executeQuery(false, $sql, $updateValues);
    } catch (Exception $e) {
      throw new Error($e->getMessage(), 500);
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