<?php
require_once './app/views/user.view.php';
require_once './app/models/user.model.php';

class UserController
{
    private $view;
    private $model;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    public function showCreateUser()
    {
        $this->view->showCreateUser();
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_name = $_POST['usuario_name'] ?? null;
            $password = $_POST['password'] ?? null;

            if (empty($usuario_name) || empty($password)) {
                $this->view->showCreateUser('Faltan completar datos');
                return;
            }

            // Creo el usuario
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->model->createUser($usuario_name, $hashedPassword);


            // Redirijo al login
            header('Location: ' . BASE_URL . '/login');
        } else {
            $this->view->showCreateUser();
        }
    }
}