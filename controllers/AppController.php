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

  public function showTasks()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $tasks = $this->getsTasksData();

    $this->view('tasks', ['showHeader' => false, 'tasks' => $tasks]);
  }

  public function showProjects()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $projects = $this->getProjectsData();

    $this->view('projects', ['showHeader' => false, 'projects' => $projects]);
  }

  public function showProjectForm()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $this->view('project', ['showHeader' => false,]);
  }

  public function showTaskForm()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $projects = $this->getProjectsData();

    $this->view('task', ['showHeader' => false, 'projects' => serialize($projects)]);
  }

  public function createTask()
  {
    // fetch all projects again
    $projects = $this->getProjectsData();

    $user_id = $_POST['user_id'] ?? null;

    $project_id = $_POST['project_id'] ?? null;

    $task_name = $_POST['task_name'] ?? null;
    $task_description = $_POST['task_description'] ?? null;
    $task_startDate = $_POST['task_startDate'] ?? null;
    $task_finishDate = $_POST['task_finishDate'] ?? null;

    $errors = new MessageBag();

    if ($project_id === "null") {
      $errors->add('project', 'Selecciona un proyecto para continuar');
    }

    if (empty($task_name)) {
      $errors->add('name', 'El campo de nombre del proyecto es obligatiorio');
    }

    if (empty($task_description)) {
      $errors->add('description', 'El campo de descripción de la  tarea es obligatirio');
    }

    if (empty($task_startDate)) {
      $errors->add('startDate', 'La fecha de inicio es obligatoria.');
    }

    if (empty($task_finishDate)) {
      $errors->add('finishDate', 'La fecha de fin es obligatoria');
    }

    if ($errors->isNotEmpty()) {
      $this->view('task', ['showHeader' => false, 'errors' => serialize($errors), 'projects' => serialize($projects)]);
      return;
    }

    $task = new Task($task_name, $task_description, $task_startDate, $task_finishDate, $project_id, $user_id);

    $task->save();

    $this->redirect('app/tasks?taskCreated');
  }

  public function createProject()
  {
    $user_id = $_POST['user_id'] ?? null;

    $project_name = $_POST['project_name'] ?? null;
    $project_description = $_POST['project_description'] ?? null;
    $project_startDate = date('Y-m-d', strtotime($_POST['project_startDate'])) ?? null;
    $project_finishDate = date('Y-m-d', strtotime($_POST['project_finishDate'])) ?? null;

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

    $project = new Project(null, $project_name, $project_description, $project_startDate, $project_finishDate, $user_id);

    $result = $project->save();

    $this->redirect('app/projects?projectCreated');
  }

  public function getProjectsData()
  {
    $project = new Project();

    return $project->read();
  }

  public function getsTasksData()
  {
    return null;
  }
}