<?php

class Project extends Model
{
  private $id;
  private $name;
  private $description;
  private $startDate;
  private $finishDate;
  private $createdByUser;

  public function __construct($id = null, $name = null, $description = null, $startDate = null, $finishDate = null, $createdByUser = null)
  {
    parent::__construct();

    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->startDate = $startDate;
    $this->finishDate = $finishDate;
    $this->createdByUser = $createdByUser;
  }

  // Métodos Get

  public function getId()
  {
    return $this->id;
  }

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

  public function getCreatedByUser()
  {
    return $this->createdByUser;
  }

  // Métodos Set
  public function setId($id)
  {
    $this->id = $id;
  }

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

  public function setCreatedByUser($createdByUser)
  {
    $this->createdByUser = $createdByUser;
  }

  public function save()
  {
    try {
      $sql = "INSERT INTO projects (Name, Description, StartDate, FinishDate, User_id) VALUES (?, ?, ?, ?, ?)";

      return $this->db->executeQuery(false, $sql, [
        $this->name,
        $this->description,
        $this->startDate,
        $this->finishDate,
        $this->createdByUser,
      ]);
    } catch (Exception $e) {
      throw new Error($e->getMessage(), 500);
    }
  }

  public function read($id = null, $user_id = null) 
  {
    $sql = "SELECT * FROM projects WHERE User_id = ?";

    if ($id !== null) {
      $sql .= " AND id = ?";
    }

    if ($id !== null) {
      $result = $this->db->executeQuery(true, $sql, [
        $id
      ]);
    } else {
      $result = $this->db->executeQuery(true, $sql, [
        $user_id
      ]);
    }

    return $result;
  }

  public function update()
  {
    try {
      $currentProject = $this->read($this->id);
      $currentProject = $currentProject[0];

      if (!$currentProject) {
        throw new Exception("Project doesn't exist");
      }

      $currentProject = new Project(
        $currentProject['id'],
        $currentProject['Name'],
        $currentProject['Description'],
        $currentProject['StartDate'],
        $currentProject['FinishDate'],
        $currentProject['User_id']
      );

      // Compara los valores actuales con los nuevos
      if (
        $this->name === $currentProject->getName() &&
        $this->description === $currentProject->getDescription() &&
        $this->startDate === $currentProject->getStartDate() &&
        $this->finishDate === $currentProject->getFinishDate() &&
        $this->createdByUser === $currentProject->getCreatedByUser()
      ) {
        return true;
      }

      $sql = "UPDATE projects SET ";
      $updateValues = [];

      if ($this->name !== $currentProject->getName()) {
        $sql .= "Name = ?, ";
        $updateValues[] = $this->name;
      }

      if ($this->description !== $currentProject->getDescription()) {
        $sql .= "Description = ?, ";
        $updateValues[] = $this->description;
      }

      if ($this->startDate !== $currentProject->getStartDate()) {
        $sql .= "StartDate = ?, ";
        $updateValues[] = $this->startDate;
      }

      if ($this->finishDate !== $currentProject->getFinishDate()) {
        $sql .= "FinishDate = ?, ";
        $updateValues[] = $this->finishDate;
      }

      if ($this->createdByUser !== $currentProject->getCreatedByUser()) {
        $sql .= "User_id = ?, ";
        $updateValues[] = $this->createdByUser;
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
    $sql = "DELETE FROM projects WHERE id = ?";

    $this->db->executeQuery(false, $sql, [
      $this->id
    ]);
  }
}
