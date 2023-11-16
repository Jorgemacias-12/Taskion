<?php
class Controller
{
  protected function model($model)
  {
    require_once '../models/' . $model . '.php';
    return new $model();
  }

  protected function view($view, $data = [])
  {
    require_once '../views/' . $view . '.php';
  }

  protected function redirect($path)
  {
    header('Location: ' . $path);
    exit;
  }
}
