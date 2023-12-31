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
    $tasks = $this->getTasksData() ?? [];

    $this->view('app', ['showHeader' => false, 'projects' => $projects, 'tasks' => $tasks]);
  }

  public function showTasks()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $tasks = $this->getTasksData();

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

    $this->view('project', ['showHeader' => false, 'endpoint' => 'create']);
  }

  public function showTaskForm()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $projects = $this->getProjectsData();

    $this->view('task', ['showHeader' => false, 'projects' => serialize($projects), 'endpoint' => 'create']);
  }

  public function createTask()
  {
    // fetch all projects again
    $projects = $this->getProjectsData();

    $user_id = $_POST['user_id'] ?? null;

    $project_id = $_POST['project_id'] ?? null;

    $task_name = $_POST['task_name'] ?? null;
    $task_description = $_POST['task_description'] ?? null;

    $task_startDate = !empty($_POST['task_startDate']) && strtotime($_POST['task_startDate'])
      ? date('Y-m-d', strtotime($_POST['task_startDate']))
      : null;
    $task_finishDate = !empty($_POST['task_finishDate']) && strtotime($_POST['task_finishDate'])
      ? date('Y-m-d', strtotime($_POST['task_finishDate']))
      : null;

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
      $this->view('task', ['showHeader' => false, 'errors' => serialize($errors), 'projects' => serialize($projects), 'endpoint' => 'create']);
      return;
    }

    $task = new Task(null, $task_name, $task_description, $task_startDate, $task_finishDate, $project_id, $user_id);

    $result = $task->save();

    $this->redirect('app/tasks?taskCreated');
  }

  public function createProject()
  {
    $user_id = $_POST['user_id'] ?? null;

    $project_name = $_POST['project_name'] ?? null;
    $project_description = $_POST['project_description'] ?? null;
    $project_startDate = !empty($_POST['project_startDate']) && strtotime($_POST['project_startDate'])
      ? date('Y-m-d', strtotime($_POST['project_startDate']))
      : null;
    $project_finishDate = !empty($_POST['project_finishDate']) && strtotime($_POST['project_finishDate'])
      ? date('Y-m-d', strtotime($_POST['project_finishDate']))
      : null;

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
      $this->view('project', ['showHeader' => false, 'errors' => serialize($errors), 'endpoint' => 'create']);
      return;
    }

    $project = new Project(null, $project_name, $project_description, $project_startDate, $project_finishDate, $user_id);

    $result = $project->save();

    $this->redirect('app/projects?projectCreated');
  }

  public function showEditProject()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }
    
    // Get user_id 
    $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

    // Obtén la URL de la superglobal $_GET
    $url = $_GET['url'] ?? '';

    // Divide la URL en partes usando '/'
    $urlParts = explode('/', $url);

    // Obtiene el último elemento del array como el valor de 'id'
    $projectId = end($urlParts);
    $user_id = $user->getId();

    $project = new Project($projectId);

    $project = $project->read($projectId, $user_id)[0];

    $project = new Project(
      $project['id'],
      $project['Name'],
      $project['Description'],
      $project['StartDate'],
      $project['FinishDate'],
      $project['User_id'],
    );

    $this->view('project', ['showHeader' => false, 'endpoint' => 'edit', 'projectId' => $projectId, 'project' => $project]);

  }

  public function showEditTask()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

    $projects = new Project();
    $projects = $projects->read(null, $user->getId());

    // Obtén la URL de la superglobal $_GET
    $url = $_GET['url'] ?? '';

    // Divide la URL en partes usando '/'
    $urlParts = explode('/', $url);

    $taskId = end($urlParts);

    $task = new Task($taskId);
    $task = $task->read($user->getId(), $taskId)[0];
    $task = new Task(
      $task['id'],
      $task['Name'],
      $task['Description'],
      $task['StartDate'],
      $task['FinishDate'],
      $task['Project_id'],
    );

    $this->view('task', ['showHeader' => false, 'endpoint' => 'edit', 'task' => $task, 'projects' => $projects, 'taskId' => $taskId]);
  }

  public function editProject()
  {
    // Obtén la URL de la superglobal $_GET
    $url = $_GET['url'] ?? '';

    // Divide la URL en partes usando '/'
    $urlParts = explode('/', $url);

    // Obtiene el último elemento del array como el valor de 'id'
    $project_id = end($urlParts);

    $user_id = $_POST['user_id'] ?? null;

    $project_name = $_POST['project_name'] ?? null;
    $project_description = $_POST['project_description'] ?? null;
    $project_startDate = !empty($_POST['project_startDate']) && strtotime($_POST['project_startDate'])
      ? date('Y-m-d', strtotime($_POST['project_startDate']))
      : null;
    $project_finishDate = !empty($_POST['project_finishDate']) && strtotime($_POST['project_finishDate'])
      ? date('Y-m-d', strtotime($_POST['project_finishDate']))
      : null;

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

    $project = new Project($project_id, $project_name, $project_description, $project_startDate, $project_finishDate, $user_id);

    $project->update();
    
    $this->redirect('app/projects?updatedProject');
  }

  public function editTask()
  {
    $projects = $this->getProjectsData();

    // Obtén la URL de la superglobal $_GET
    $url = $_GET['url'] ?? '';

    // Divide la URL en partes usando '/'
    $urlParts = explode('/', $url);

    // Obtiene el último elemento del array como el valor de 'id'
    $task_id = end($urlParts);

    $project_id = $_POST['project_id'] ?? null;

    $task_name = $_POST['task_name'] ?? null;
    $task_description = $_POST['task_description'] ?? null;

    $task_startDate = !empty($_POST['task_startDate']) && strtotime($_POST['task_startDate'])
      ? date('Y-m-d', strtotime($_POST['task_startDate']))
      : null;
    $task_finishDate = !empty($_POST['task_finishDate']) && strtotime($_POST['task_finishDate'])
      ? date('Y-m-d', strtotime($_POST['task_finishDate']))
      : null;

    $errors = new MessageBag();

    if (empty($project_id)) {
      $errors->add('project', 'Seleciona un proyecto para continuar');
    } 

    if (empty($task_name)) {
      $errors->add('name', 'El campo de nombre de la tarea es obligatiorio');
    }

    if (empty($task_description)) {
      $errors->add('description', 'El campo de descripción del la tarea es obligatirio');
    }

    if (empty($task_startDate)) {
      $errors->add('startDate', 'La fecha de inicio es obligatoria.');
    }

    if (empty($task_finishDate)) {
      $errors->add('finishDate', 'La fecha de fin es obligatoria');
    }

    if ($errors->isNotEmpty()) {
      $this->view('task', ['showHeader' => false, 'errors' => serialize($errors), 'endpoint' => 'edit', 'projects' => $projects]);
      return;
    }

    $task = new Task(
      $task_id,
      $task_name,
      $task_description,
      $task_startDate,
      $task_finishDate,
      $project_id
    );

    $task->update();

    $this->redirect('app/tasks?updatedTask');
  }

  public function deleteProject()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    // Obtén la URL de la superglobal $_GET
    $url = $_GET['url'] ?? '';

    // Divide la URL en partes usando '/'
    $urlParts = explode('/', $url);

    // Obtiene el último elemento del array como el valor de 'id'
    $projectId = end($urlParts);

    // Verifica si el 'id' está presente
    if ($projectId !== false) {
      // Realiza las operaciones necesarias con $projectId
      // echo "Eliminando proyecto con ID: $projectId";
      $project = new Project($projectId);

      $project->delete();

      $this->redirect("app/projects?projectDeleted");
    } else {
      // Maneja el caso en el que el 'id' no está presente
      // echo "ID de proyecto no proporcionado";
      $this->view("404", ['showHeader' => true]);
    }
  }

  public function deleteTask()
  {
    if (!isset($_SESSION['user'])) {
      $this->redirect("login");
    }

    // Obtén la URL de la superglobal $_GET
    $url = $_GET['url'] ?? '';

    // Divide la URL en partes usando '/'
    $urlParts = explode('/', $url);

    // Obtiene el último elemento del array como el valor de 'id'
    $taskId = end($urlParts);

    // Verifica si el 'id' está presente
    if ($taskId !== false) {
      // Realiza las operaciones necesarias con $projectId
      // echo "Eliminando proyecto con ID: $projectId";
      $task = new Task($taskId);

      $result = $task->delete();

      // var_dump($result);

      $this->redirect("app/tasks?taskDeleted");
    } else {
      // Maneja el caso en el que el 'id' no está presente
      // echo "ID de proyecto no proporcionado";
      $this->view("404", ['showHeader' => true]);
    }
  }

  public function getProjectsData()
  {
    $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

    $project = new Project();

    return $project->read(null, $user->getId());
  }

  public function getTasksData()
  {
    $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

    $task = new Task();

    return $task->read($user->getId(), null);
  }
}