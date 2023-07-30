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
                $this->redirectToLoginWithError('Por favor, preencha todos os campos.');
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            $userData = $this->userModel->getUserByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                // Login bem-sucedido, redirecionar para a página principal (/index)
                header('Location: /dashboard');
                exit();
            } else {
                // Credenciais inválidas, exibir mensagem de erro
                $errorMessage = 'Credenciais inválidas.';
                $this->redirectToLoginWithError($errorMessage);
            }
        } else {
            // Exibir a página de login
            $errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
            require_once __DIR__ . '/../views/login.php';
        }
    }

    private function redirectToLoginWithError($errorMessage)
    {
        $url = '/app/views/login.php?error=' . urlencode($errorMessage);
        header('Location: ' . $url);
        exit();
    }
}
