<?php

class UserController extends Controller
{
  public function showUserProfile() {

    // Read user
    $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

    // Read projects 
    $projects = new Project();
    $projects = $projects->read(null, $user->getId());

    // Read tasks
    $tasks = new Task();
    $tasks = $tasks->read();

    $this->view('user', ['showHeader' => false, 'projects' => $projects, 'tasks' => $tasks]);
  }

  public function showUserProfileEdit() 
  {
    $this->view('userEdit', ['showHeader' => false]);
  }

}