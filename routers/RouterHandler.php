<?php

class RouterHandler
{
    protected $method;
    protected $data;

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function route($controller, $id)
    {
        // Verificar si el usuario ha iniciado sesión antes de permitir el acceso a las rutas protegidas
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: /login.php");
            exit;
        }

        $resources = new $controller();
        switch ($this->method) {
            case "GET":
                if ($id && $id == "create") {
                    $resources->create();
                } else if ($id && $id == "delete") {
                    $resources->delete();
                } else if ($id && $id == "edit") {
                    $resources->edit();
                } else if ($id) {
                    $resources->show($id);
                } else {
                    $resources->index();
                }
                break;
            case "POST":
                $resources->store($this->data);
                break;
            case "DELETE":
                $resources->destroy($this->data);
                break;
            case "PUT":
                $resources->update($this->data);
                break;
        }
    }
}
?>


