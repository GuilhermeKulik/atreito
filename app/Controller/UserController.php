<?php

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
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
                    $m = "Usuário cadastrado com sucesso.";
                    $alertClass = 'success';
                    $this->redirectToAddUser($m, $alertClass);
                    exit();
                } else {
                    // Erro ao adicionar usuário
                    echo 'error';
                    exit();
                }
            } catch (Exception $e) {
                // Tratar a exceção
                $m = 'Ocorreu um erro ao processar a solicitação: ' . $e->getMessage();
                $alertClass = 'danger';
                $this->redirectToAddUser($m, $alertClass);
            }
        } else {
            // Exibir o formulário de adição de usuário
            require_once __DIR__ . '/../views/add.php';
        }
    }
    

    private function redirectToLoginWithError($m)
    {
        $url = '/app/views/login.php?m=' . urlencode($m);
        header('Location: ' . $url);
        exit();
    }

    private function redirectToAddUser($m, $alertClass)
    {
        $url = '/app/views/user/add.php?m=' . urlencode($m) . '&a=' . urlencode($alertClass);
        header('Location: ' . $url);
        exit();
    }

}
