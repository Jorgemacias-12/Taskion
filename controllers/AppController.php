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
    $projects = $this->getProjects() ?? [];

    // Load tasks
    $tasks = $this->getTasks() ?? [];

    $this->view('app', ['showHeader' => false, 'projects' => $projects, 'tasks' => $tasks]);
  }

  public function getProjects()
  {
    return null;
  }

  public function getTasks()
  {
    return null;
  }
}