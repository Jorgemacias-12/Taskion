<?php

require_once './core/init.php';
$routes = require_once './routes/routes.php';

// Obtén la URL o utiliza la ruta raíz como predeterminada
$url = $_GET['url'] ?? '/';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);

// Resto del código de enrutamiento...
if (array_key_exists($url, $routes)) {
  $controllerName = $routes[$url]['controller'];
  $methodName = $routes[$url]['method'];

  // Incluir el controlador y ejecutar el método
  require_once "controllers/{$controllerName}.php";
  $controller = new $controllerName();
  $controller->{$methodName}();
} else {
  // Ruta no encontrada
  echo "404 - Página no encontrada";
}
