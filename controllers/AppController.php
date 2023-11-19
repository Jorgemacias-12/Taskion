<?php

require_once 'core/Controller.php';

class AppController extends Controller
{
  public function getApp()
  {

    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    if (isset($_GET['logout'])) {
      session_destroy();

      $this->redirect("login");
      return;
    }

    // Load projects
    $projects = $this->getProjectsData() ?? [];

    // Load tasks
    $tasks = $this->getsTasksData() ?? [];

    $this->view('app', ['showHeader' => false, 'projects' => $projects, 'tasks' => $tasks]);
  }

  public function getProjectsData()
  {
    return null;
  }

  public function getsTasksData()
  {
    return null;
  }
}