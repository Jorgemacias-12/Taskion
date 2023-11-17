<?php

require_once './core/init.php';
$routes = require_once './routes/routes.php';

// Obtén la URL y el método HTTP
$url = $_GET['url'] ?? '/';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$method = $_SERVER['REQUEST_METHOD'];

// Resto del código de enrutamiento...
if (array_key_exists($url, $routes) && array_key_exists($method, $routes[$url])) {
  $route = $routes[$url][$method];
  $controllerName = $route['controller'];
  $methodName = $route['action'];

  require_once "controllers/{$controllerName}.php";
  $controller = new $controllerName();
  if (method_exists($controller, $methodName)) {
    $controller->{$methodName}();
  } else {
    // Método no encontrado en el controlador
    $controller->view('404', ['url' => $url, 'showHeader' => true]);
  }
} else {
  // Ruta no encontrada o método no permitido
  $controller = new Controller();
  $controller->view('404', ['url' => $url, 'showHeader' => true]);
}
