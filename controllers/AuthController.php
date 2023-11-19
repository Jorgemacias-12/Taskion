<?php

use Illuminate\Support\MessageBag;

require_once 'core/Controller.php';

class AuthController extends Controller
{
  public function getLogin()
  {
    $this->view('login', ['showHeader' => true]);
  }

  public function doLogin()
  {

  }

  public function getRegister()
  {
    $this->view('register', ['showHeader' => true]);
  }

  public function doRegister()
  {
    // Obtener datos del formulario
    $name = $_POST['name'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $avatar = $_FILES['avatar'];

    $errors = new MessageBag();

    // Validar cada campo y añadir mensajes específicos
    if (empty($name)) {
      $errors->add('name', 'El campo nombre es obligatorio.');
    } else if (
      strlen($name) < 5 ||
      strlen($name) >= 100
    ) {
      $errors->add('name', 'Tamaño máximo de nombre 5 y 100 caracteres');
    }

    if (empty($username)) {
      $errors->add('username', 'El campo nombre de usuario es obligatorio.');
    }

    if (empty($email)) {
      $errors->add('email', 'El campo correo es obligatorio.');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors->add('email', 'El correo electrónico no es válido.');
    }

    if (empty($password)) {
      $errors->add('password', 'El campo contraseña es obligatorio.');
    }

    // Comprobar si hay errores
    if ($errors->isNotEmpty()) {
      $this->view('register', ['showHeader' => true, 'errors' => serialize($errors), 'oldInput' => $_POST]);
      return;
    }

    $avatar = file_get_contents($avatar['tmp_name']);

    $user = new User(null, $name, $username, $email, $password, $avatar);

    $result = $user->save();

    $this->redirect('login?message=accountCreated', ['result' => '¡Cuenta creada exitosamente!']);
  }
}