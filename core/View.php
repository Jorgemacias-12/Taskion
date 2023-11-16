<?php
class View
{
  public static function render($view, $data = [])
  {
    if (file_exists('../views/' . $view . '.php')) {
      extract($data);
      require_once '../views/' . $view . '.php';
    }
  }
}
