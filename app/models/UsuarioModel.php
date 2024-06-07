<?php

class UsuarioModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function findByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario LIMIT 1");
        $stmt->bindParam(':nombre_usuario', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (:nombre_usuario, :contrasena)");
        $stmt->bindParam(':nombre_usuario', $username);
        $stmt->bindParam(':contrasena', $hashedPassword);
        return $stmt->execute();
    }
}


