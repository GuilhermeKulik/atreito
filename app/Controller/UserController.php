<?php

namespace Atreito\Controller;


use Atreito\View\GenericView;
use Atreito\Model\User;
use Atreito\Model\Score;
use Atreito\Config\DBConnection;

class UserController {

    private $userModel;
    private $view;

    public function __construct() {
        $this->userModel = new User(DBConnection::getInstance()->getConnection());
        $this->view = new GenericView();
    } 
/*
    public function login($email, $password) {
        $authSuccess = $this->authenticate($email, $password);
        
        if ($authSuccess) {
            // Redireciona para o dashboard
            $this->view->renderView('/perfil');
        } else {
            // Definindo a mensagem de erro na sessão
            $_SESSION['login_error'] = "Não foi possível realizar o login. Verifique suas credenciais e tente novamente.";

            // Redireciona de volta para a página de login
            $this->view->renderView('/login');
        }
    }
*/
    public function logout() {
        unset($_SESSION['user']);
        $this->view->renderView('/login');
    }

    public function checkLogin() {
        if (isset($_SESSION['user'])) {
            $userType = $_SESSION['user']['type'];
           
            // ou retornar o tipo de usuário diretamente (Do jeito que está)
            return $userType;
            

        } else {
            $this->view->renderView('/login');
        }
    }

    private function authenticate($email, $password) {
        $conditions = ['email' => $email];
        $user = $this->userModel->fetch('user', $conditions); 
        if ($user && password_verify($password, $user['password'])) {
            $this->userModel->setUserID($user['user_id']);
            $this->userModel->setEmail($user['email']);
            $this->userModel->setPassword($user['password']);
            $this->userModel->setName($user['name']);
            $_SESSION['user'] = $user;
            $score = new Score($user['user_id']);
            $_SESSION['score'] = $score->getUserScore($user['user_id']);
            return true;
        }

        return false;
    }

    public function checkLoggedIn() {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
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
        //Pegando do post 
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cellphone = $_POST['cellphone'];
        $userType = $_POST['userType'];
        $password = $_POST['password'];

        //insere o usuário
        $result = $this->userModel->createUser($name, $email, $cellphone, $password, $userType);
        
        //se for númerico é pq adicionou no banco, criar o score do jogador =)
        if (is_numeric($result)) {
            $score = new Score($result);
            $score->createScoreForUser($result);
        }
    
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
                'message' => $result['message'] 
            ]);
        }
        exit; 
    }

    /**
     * Retrieves users based on the search term.
     */
    public function getUsersBySearch() {
        if (isset($_POST['term'])) {
            $term = $_POST['term'];
            $users = $this->userModel->searchUsers($term);
            
            header('Content-Type: application/json');
            echo json_encode($users);
            exit;
        } else {
            echo json_encode(['error' => 'Termo de busca não fornecido.']);
            exit;
        }
    }

    public function getUserByIdentification() {
        if (isset($_POST['userIdentification'])) {
            $userIdentification = $_POST['userIdentification'];
            $user = $this->userModel->getUserByIdentification($userIdentification);
            
            if($user) {
                echo json_encode([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'mobile_number' => $user['mobile_number']
                ]);
            } else {
                echo json_encode(['error' => 'Usuário não encontrado.']);
            }
            exit;
        } else {
            echo json_encode(['error' => 'Identificação do usuário não fornecida.']);
            exit;
        }
    }

    /**
     * Fetches user data by ID and returns it as a JSON response.
      */
    public function getUserByIdJson() {
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];
            $user = $this->userModel->getUserById($userId);
            header('Content-Type: application/json');
            if ($user) {
                $userData = [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'mobile_number' => $user->getPhone(),
                    'userId' => $userId
                ];
                echo json_encode([
                    'status' => 'success',
                    'data' => $userData
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Usuário não encontrado.'
                ]);
            }
            } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Codigo de usuário não fornecido.'
            ]);
        }
        exit;
    }  


    public function updateUserInfo() {
        if ($_POST['password'] !== $_POST['confirmPassword']) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Os campos de senha não estão iguais.'
            ]);
            exit;
        }

        $newData = [];
        $userId = $_POST['userId'];

        if (!empty($_POST['name'])) {
            $newData['name'] = $_POST['name'];
        }
        if (!empty($_POST['email'])) {
            $newData['email'] = $_POST['email'];
        }
        if (!empty($_POST['password'])) {
            $newData['password'] = $_POST['password']; 
        }
        if (!empty($_POST['cellphone'])) {
            $newData['cellphone'] = $_POST['cellphone']; 
        }

        $updateCount = $this->userModel->updateUser($userId, $newData);

        header('Content-Type: application/json');

        if ($updateCount > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Dados atualizados com sucesso.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro ao atualizar.'
            ]);
        }
        exit;
    }  

    /**
     * Deletes a user from the database by ID.
     *
     * @param int $userID The user's ID to be deleted.
     * @return array An associative array with the status of the operation and a message.
     */
    public function deleteUserById($userID) {
        // Call the generic delete method from the GenericModel.
        $deletedCount = $this->userModel->delete('user', ['user_id' => $userID]);

        header('Content-Type: application/json');
        // Check if any row was actually deleted.
        if ($deletedCount > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Usuário excluído com sucesso.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro ao excluir usuário ou usuário não encontrado.'
            ]);
        }
        exit;
    }

}