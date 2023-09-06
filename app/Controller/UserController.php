<?php

namespace Atreito\Controller;

session_start();

use Atreito\View\GenericView;
use Atreito\Model\User;
use Atreito\Config\DBConnection;

class UserController {

    private $userModel;
    private $view;

    public function __construct() {
        $this->userModel = new User(DBConnection::getInstance()->getConnection());
        $this->view = new GenericView();
    } 

    public function login($email, $password) {
        $authSuccess = $this->authenticate($email, $password);
        
        if ($authSuccess) {
            $_SESSION['user'] = [
                'email' => $this->userModel->getEmail(),
                'id' => $this->userModel->getUserID(),
                // Estou assumindo que você tenha um método 'getUserType()' na classe User
                'type' => $this->userModel->getUserType()
            ];

            // Redireciona para o dashboard
            $this->view->renderView('/dashboard');
        } else {
            // Definindo a mensagem de erro na sessão
            $_SESSION['login_error'] = "Não foi possível realizar o login. Verifique suas credenciais e tente novamente.";

            // Redireciona de volta para a página de login
            $this->view->renderView('/login');
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        $this->view->renderView('/login');
    }

    public function checkLogin() {
        if (isset($_SESSION['user'])) {
            $userType = $_SESSION['user']['type'];
           
            // ou retornar o tipo de usuário diretamente (Do jeito que está)
            return $userType;
            
            // ou redirecionar com base no tipo de usuário
            /*
            switch ($userType) {
                case 'admin':
                    $this->view->renderView('/admin-dashboard');
                    break;
                case 'seller':
                    $this->view->renderView('/seller-dashboard');
                    break;
                case 'client':
                    $this->view->renderView('/client-dashboard');
                    break;
                default:
                    $this->logout();
            }
            */
        } else {
            $this->view->renderView('/login');
        }
    }

    private function authenticate($email, $password) {
        $conditions = ['email' => $email];
        $user = $this->userModel->fetch('user', $conditions); 
        
        if ($user && password_verify($password, $user['password'])) {
            $this->userModel->setUserID($user['user_ID']);
            $this->userModel->setEmail($user['email']);
            $this->userModel->setPassword($user['password']);
            $this->userModel->setName($user['name']);
            // a data de criação e modificação serão definidas dentro do modelo, quando os dados são carregados
            return true;
        }

        return false;
    }

    // retorna um json apos login.
    
    public function loginAjax() {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $authSuccess = $this->authenticate($email, $password);
    
        if ($authSuccess) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'As credenciais fornecidas estão incorretas. Tente novamente.']);
        }
    
        exit; // Para encerrar a execução após a resposta AJAX.
    }

    public function addUser() {
        // Verificar se todos os campos necessários estão definidos
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['cellphone']) ||
            !isset($_POST['userType']) || !isset($_POST['password']) || !isset($_POST['confirmPassword'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Todos os campos são obrigatórios.'
            ]);
            exit;  // Encerrar a execução após enviar a resposta
        }
        
        // Verificar se as senhas são iguais
        if ($_POST['password'] !== $_POST['confirmPassword']) {
            echo json_encode([
                'status' => 'error',
                'message' => 'As senhas não coincidem.'
            ]);
            exit;  // Encerrar a execução após enviar a resposta
        }
    
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cellphone = $_POST['cellphone'];
        $userType = $_POST['userType'];
        $password = $_POST['password'];
    
        $result = $this->userModel->createUser($name, $email, $cellphone, $password, $userType);
    
        // TODO: Log the user creation here.
    
        // TODO: Send confirmation either by email or WhatsApp Web.
        header('Content-Type: application/json');
        if (is_numeric($result)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Usuário adicionado com sucesso.',
                'user_id' => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => $result['message']  // Presumindo que $result contém a mensagem de erro
            ]);
        }
        exit;  // Encerrar a execução após enviar a resposta
    }
    
}