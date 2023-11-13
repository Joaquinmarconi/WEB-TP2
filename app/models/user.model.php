<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=pagina_musica;charset=utf8', 'root', '');
    }

    public function createUser($usuario_name, $password) {
        // Generas el hash de la contraseña usando el algoritmo por defecto
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertas el hash en la base de datos
        $query = $this->db->prepare('INSERT INTO usuarios (usuario_name, password) VALUES (?, ?)');
        $query->execute([$usuario_name, $hash]);
    }


    public function getByName($name) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario_name = ?');
        $query->execute([$name]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}