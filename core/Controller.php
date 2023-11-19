<?php

use Jenssegers\Blade\Blade;

class Controller
{
  private $blade;

  public function __construct() {

    $views = __DIR__ . '/../views';
    $cache = __DIR__ . '/../cache';

    $this->blade = new Blade($views, $cache);
  }

  protected function model($model)
  {
    require_once '../models/' . $model . '.php';
    return new $model();
  }

  public function view($view, $data = [])
  {
    echo $this->blade->make($view, $data)->render();
  }

  protected function redirect($path)
  {
    header("Location: /$path"); 
    exit();
  }
}
