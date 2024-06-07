<?php
/* Front controller: punto de contacto inicial para recoger las peticiones.
Delegará en un ApplicationController para manejar la acción y la vista asociada */

require_once("../app/controllers/IngresosController.php");
require_once("../app/controllers/RetirosController.php");
require_once("../app/controllers/AuthController.php");
require_once("../app/enums/MetodoPagoEnum.php");
require_once("../app/enums/IngresoTipoEnum.php");
require_once("../app/enums/RetiroTipoEnum.php");
require_once("../routers/RouterHandler.php");

// Iniciar sesión (si aún no está iniciada)
session_start();

$slug = $_GET["slug"] ?? "";
$slug = explode("/", $slug);
$resource = $slug[0] == "" ? "/" : $slug[0];
$id = $slug[1] ?? null;
$router = new RouterHandler();

switch ($resource) {
    case '/':
        // Redireccionar a la página de inicio de sesión si no se ha iniciado sesión
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            require_once("../app/views/login.php");
            exit;
        }
        require_once("../app/views/inicio.php");
        break;
    case 'inicio':
        // Redireccionar a la página de inicio de sesión si no se ha iniciado sesión
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            require_once("../app/views/login.php");
            exit;
        }
        require_once("../app/views/inicio.php");
        break;
    case 'login':
        $router->setMethod('GET');
        $router->setData($_POST);
        $router->route(AuthController::class, 'login');
        break;
    case 'logout':
        $router->setMethod('GET');
        $router->route(AuthController::class, 'logout');
        break;
    case 'ingresos':
        // Verificar si el usuario ha iniciado sesión antes de acceder a las rutas de ingresos
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            require_once("../app/views/login.php");
            exit;
        }
        $method = $_POST['_method'] ?? 'GET';
        $router->setMethod($method);
        $router->setData($_POST);
        $router->route(IngresosController::class, $id);
        break;
    case 'retiros':
        // Verificar si el usuario ha iniciado sesión antes de acceder a las rutas de retiros
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            require_once("../app/views/login.php");
            exit;
        }
        $method = $_POST['_method'] ?? 'GET';
        $router->setMethod($method);
        $router->setData($_POST);
        $router->route(RetirosController::class, $id);
        break;
    default:
        require_once("../app/exceptions/404.php");
        break;
}
?>
