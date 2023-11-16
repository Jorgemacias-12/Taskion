<?php

// Carga el archivo de inicialización desde el directorio core
require_once './core/init.php';

// Aquí deberías crear lógica para manejar las solicitudes.
// Una forma común es analizar la URL para determinar qué controlador y método llamar.

$url = $_GET['url'] ?? 'home/index'; // Establece una ruta predeterminada
$url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

$controllerName = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$method = isset($url[1]) ? $url[1] : 'index';

// Asegúrate de que el controlador y el método existan
if (file_exists("../controllers/{$controllerName}.php")) {
  require_once "../controllers/{$controllerName}.php";
  $controller = new $controllerName();

  if (method_exists($controller, $method)) {
    call_user_func_array([$controller, $method], array_slice($url, 2));
  } else {
    // Manejo del error: Método no encontrado
    // Puedes redirigir a una página de error o mostrar un mensaje
  }
} else {
  // Manejo del error: Controlador no encontrado
  // Puedes redirigir a una página de error o mostrar un mensaje
}
