<?php

require_once './core/init.php';
$routes = require_once './routes/routes.php';

// Obtén la URL y el método HTTP
$url = $_GET['url'] ?? '/';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$method = $_SERVER['REQUEST_METHOD'];

// Resto del código de enrutamiento...
$matched = false;

foreach ($routes as $routePattern => $routeConfig) {
    // Reemplaza los marcadores de posición en la ruta con expresiones regulares
    $routePattern = str_replace(['/', ':id'], ['\/', '([0-9]+)'], $routePattern);

    // Verifica si la URL coincide con el patrón
    if (preg_match("/^$routePattern$/", $url, $matches) && $method === $routeConfig[$method]['method']) {
        $matched = true;

        $controllerName = $routeConfig[$method]['controller'];
        $methodName = $routeConfig[$method]['action'];

        // Elimina el primer elemento que es la URL completa
        array_shift($matches);

        require_once "./controllers/{$controllerName}.php";
        $controller = new $controllerName();

        if (method_exists($controller, $methodName)) {
            // Llama al método y pasa los parámetros capturados
            call_user_func_array([$controller, $methodName], $matches);
        } else {
            // Método no encontrado en el controlador
            $controller->view('404', ['url' => $url, 'showHeader' => true]);
        }

        break;
    }
}

// Si no hay coincidencias, maneja la ruta no encontrada
if (!$matched) {
    $controller = new Controller();
    $controller->view('404', ['url' => $url, 'showHeader' => true]);
}
