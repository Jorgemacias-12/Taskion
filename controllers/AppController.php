<?php

use Illuminate\Support\MessageBag;

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

  public function showProjects()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }
    
    $this->view('projects', ['showHeader' => false]);
  }

  public function showProjectForm()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $this->view('project', ['showHeader' => false]);
  }

  public function createProject()
  {
    $user_id = $_POST['user_id'] ?? null;

    $project_name = $_POST['project_name'] ?? null;
    $project_description = $_POST['project_description'] ?? null;
    $project_startDate = $_POST['project_startDate'] ?? null;
    $project_finishDate = $_POST['project_finishDate'] ?? null;

    $errors = new MessageBag();

    if (empty($project_name)) {
      $errors->add('name', 'El campo de nombre del proyecto es obligatiorio');
    }

    if (empty($project_description)) {
      $errors->add('description', 'El campo de descripción del proyecto es obligatirio');
    }

    if (empty($project_startDate)) {
      $errors->add('startDate', 'La fecha de inicio es obligatoria.');
    }

    if (empty($project_finishDate)) {
      $errors->add('finishDate', 'La fecha de fin es obligatoria');
    }

    if ($errors->isNotEmpty()) {
      $this->view('project', ['showHeader' => false, 'errors' => serialize($errors)]);
      return;
    }

    $project = new Project($project_name, $project_description, $project_startDate, $project_finishDate, $user_id);

    $project->save();

    $this->redirect('app/projects?projectCreated');
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