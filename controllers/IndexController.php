<?php

require_once 'core/Controller.php';

class IndexController extends Controller {

  public function index() {
    $this->view('index', ['showHeader' => true]);
  }
}