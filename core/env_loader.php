<?php

function loadEnvironmentVariables($envFilePath)
{
  if (!file_exists($envFilePath)) {
    // Puedes manejar el error como prefieras, ya sea lanzando una excepción o mostrando un mensaje.
    exit('Archivo .env no encontrado.');
  }

  $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    // Ignora los comentarios
    if (strpos(trim($line), '#') === 0) {
      continue;
    }

    // Divide la línea en nombre y valor
    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);

    // Establece la variable de entorno
    if (!array_key_exists($name, $_ENV)) {
      putenv("$name=$value");
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;
    }
  }
}
