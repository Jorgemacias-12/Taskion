<?php

require_once 'core/Controller.php';

class AuthController extends Controller {
  public function getLogin()
  {
    $this->view('login', ['showHeader' => true]);
  }

  public function doLogin()
  {

  }
}