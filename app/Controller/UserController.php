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

    // retorna um json.
    
    public function loginAjax() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $authSuccess = $this->authenticate($email, $password);
        
        if ($authSuccess) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro de autenticação.']);
        }
    
        exit; // Para encerrar a execução após a resposta AJAX.
    }


}


