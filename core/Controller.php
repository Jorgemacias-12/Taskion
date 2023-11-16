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
    $path = __DIR__ . '/../views/' . $view . '.php';

    if (file_exists($path)) {
      extract($data);

      require_once $path;
    }
    else 
    {
      die("The view $view doesn't exist!");
    }
  }

  protected function redirect($path)
  {
    header('Location: ' . $path);
    exit;
  }
}
