<?php

class UserController extends Controller
{
  public function showUserProfile() {

    // Read projects 
    $projects = new Project();
    $projects = $projects->read();

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