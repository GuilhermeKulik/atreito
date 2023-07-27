<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userData = $this->userModel->getUserByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                // Login bem-sucedido, redirecionar para a página principal (/index)
                header('Location: /index');
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

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $userType = $_POST['userType'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $houseNumber = $_POST['houseNumber'];
                $bairro = $_POST['bairro'];
                $cep = $_POST['cep'];
                $instagram = 'teste';
    
                // Preparando os dados do usuário em um array associativo
                $userData = [
                    'name' => $name,
                    'email' => $email,
                    'userType' => $userType,
                    'password' => $password,
                    'phone' => $phone,
                    'address' => $address,
                    'houseNumber' => $houseNumber,
                    'bairro' => $bairro,
                    'cep' => $cep,
                    'instagram' => $instagram,
                ];
    
                // Chamar o método createUser() com os dados do usuário
                $userId = $this->userModel->createUser($userData);
    
                if ($userId) {
                    // Usuário adicionado com sucesso
                    echo 'success';
                    exit();
                } else {
                    // Erro ao adicionar usuário
                    echo 'error';
                    exit();
                }
            } catch (Exception $e) {
                // Tratar a exceção
                $errorMessage = 'Ocorreu um erro ao processar a solicitação: ' . $e->getMessage();
                $this->redirectToAddUserWithError($errorMessage);
            }
        } else {
            // Exibir o formulário de adição de usuário
            require_once __DIR__ . '/../views/add-user.php';
        }
    }
    

    private function redirectToLoginWithError($errorMessage)
    {
        $url = '/app/views/login.php?error=' . urlencode($errorMessage);
        header('Location: ' . $url);
        exit();
    }

    private function redirectToAddUserWithError($errorMessage)
    {
        $url = '/app/views/add-user.php?error=' . urlencode($errorMessage);
        header('Location: ' . $url);
        exit();
    }
}