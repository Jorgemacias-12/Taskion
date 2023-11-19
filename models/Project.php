<?php

class Project extends Model
{

  private $name;
  private $description;
  private $startDate;
  private $finishDate;
  private $createdByUser;

  public function __construct($name = null, $description = null, $startDate = null, $finishDate = null, $createdByUser = null)
  {
    $this->name = $name;
    $this->description = $description;
    $this->startDate = $startDate;
    $this->finishDate = $finishDate;
    $this->createdByUser = $createdByUser;
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

  public function getCreatedByUser()
  {
    return $this->createdByUser;
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

  public function setCreatedByUser($createdByUser)
  {
    $this->createdByUser = $createdByUser;
  }

  public function save()
  {
    $sql = "INSERT INTO projects (Name, Description, StartDate, FinishDate, User_id) VALUES (?, ?, ?, ?, ?)";

    return $this->db->executeQuery(false, $sql, [
      $this->name,
      $this->description,
      $this->startDate,
      $this->finishDate,
      $this->createdByUser,
    ]);
  }
}
