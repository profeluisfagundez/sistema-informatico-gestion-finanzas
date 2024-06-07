<?php

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UsuarioModel($db);
    }

    public function login()
    {
        require_once '../app/views/login.php';
    }

    public function loginProcess()
    {
        session_start(); // Inicia la sesión al principio del método
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->findByUsername($username);

        if ($user && password_verify($password, $user['contrasena'])) {
            $_SESSION['user'] = $user;
            require_once '../app/views/inicio.php';
            exit(); // Finaliza el script después de enviar la redirección
        } else {
            $error = "Nombre de usuario o contraseña incorrectos.";
            require_once '../app/views/login.php';
        }
    }

    public function logout()
    {
        session_start(); // Inicia la sesión al principio del método
        session_destroy();
        require_once '../app/views/login.php';
        exit(); // Finaliza el script después de enviar la redirección
    }
}

?>



