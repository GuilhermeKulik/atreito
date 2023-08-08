<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

class LoginController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar se os campos de e-mail e senha foram enviados
            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                $this->redirectToLogin('Por favor, preencha todos os campos.','danger');
            }
    
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $userData = $this->userModel->getUserByEmail($email);
    
            if ($userData && password_verify($password, $userData['password'])) {
                // Login bem-sucedido, redirecionar para a página principal (/dashboard)
                header('Location: /dashboard');
                exit();
            } else {
                // Credenciais inválidas, exibir mensagem de erro na página de login
                $this->redirectToLogin('Credenciais inválidas. Por favor, tente novamente.', 'danger');
            }
        } else {
            // Exibir a página de login
            $this->renderLoginView();
        }
    }

    private function redirectToLogin($m, $alertClass)
    {
        $url = '/app/views/login.php?m=' . urlencode($m) . '&a=' . urlencode($alertClass);
        header('Location: ' . $url);
        exit();
    }
}
