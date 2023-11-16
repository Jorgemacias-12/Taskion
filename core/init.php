<?php

// Carga las variables de entorno del archivo .env
require_once 'env_loader.php';
loadEnvironmentVariables(__DIR__ . '/../.env');

require_once __DIR__ . '/../vendor/autoload.php';

// Autoload de clases
spl_autoload_register(function ($className) {
  $corePath = __DIR__ . '/' . $className . '.php';
  $controllerPath = __DIR__ . '/../controllers/' . $className . '.php';
  $modelPath = __DIR__ . '/../models/' . $className . '.php';

  if (file_exists($corePath)) {
    require_once $corePath;
  } elseif (file_exists($controllerPath)) {
    require_once $controllerPath;
  } elseif (file_exists($modelPath)) {
    require_once $modelPath;
  }
});

// Iniciar sesión si es necesario
if (!isset($_SESSION)) {
  session_start();
}

// Aquí puedes agregar cualquier otra configuración inicial necesaria

