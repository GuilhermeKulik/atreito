<?php

require_once 'GenericModel.php';

class User extends GenericModel {

    // Atributos
    private $userID;
    private $email;
    private $password;
    private $name;
    private $dateCreated;
    private $dateModified;

    // Construtor
    public function __construct($conn, $email = null, $password = null, $name = null) {
        parent::__construct($conn);
        
        $this->email = $email;
        $this->password = $password ? $this->hashPassword($password) : null;
        $this->name = $name;
        $this->dateCreated = new DateTime();
    }

    // Getters e Setters
    public function setUserID($id) {
        $this->userID = $id;
    }


    public function getUserID() {
        return $this->userID;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $this->hashPassword($password);
    }

    public function getPassword() {
        return $this->password;
    }

    public function setName($name) {
        $this->name = $username;
    }

    public function getName() {
        return $this->name;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function setDateModified() {
        $this->dateModified = new DateTime();
    }

    public function getDateModified() {
        return $this->dateModified;
    }

    // Métodos
    public function createUser() {
        $data = [
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name,
            'registration_date' => $this->dateCreated->format('Y-m-d H:i:s'),
        ];

        $this->userID = parent::insert('user', $data); 
        return $this->userID;
    }

    public function updateUser($userID, $newData) {
        $data = [];
    
        if(isset($newData['email'])) {
            $data['email'] = $newData['email'];
            $this->email = $newData['email'];
        }
    
        if(isset($newData['password'])) {
            $data['password'] = $this->hashPassword($newData['password']);
            $this->password = $this->hashPassword($newData['password']);
        }
    
        if(isset($newData['name'])) {
            $data['name'] = $newData['name'];
            $this->name = $newData['name'];
        }
    
        $conditions = ['user_id' => $userID];
        return parent::update('user', $data, $conditions); 
    }
    

    public function deleteUser($userID) {
        $conditions = ['user_id' => $userID];
        $rowsAffected = parent::delete('user', $conditions);
        
        // Se a exclusão foi bem-sucedida (afetou pelo menos uma linha), retorne o ID do usuário.
        if ($rowsAffected > 0) {
            return $userID;
        }
        
        // Se nada foi excluído (por exemplo, o usuário não existia), você pode retornar null ou lançar uma exceção.
        return null;
    }

    public function authenticate($email, $password) {
        $conditions = ['email' => $email];
        $user = parent::fetch('user', $conditions); 
        
        if ($user && password_verify($password, $user['password'])) {
            $this->userID = $user['user_ID'];
            $this->email = $user['email'];
            $this->password = $user['password'];
            $this->name = $user['name'];
            $this->dateCreated = new DateTime($user['dateCreated']);
            $this->dateModified = new DateTime($user['dateModified']);
            return true;
        }
        return false;
    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getUserById($id) {
        $userData = parent::fetch('user', ['user_id' => $id]);

        if (!$userData) {
            return null; // Ou lançar uma exceção e gravar nos logs, decidir na revisão.
        }

        // Criar um novo objeto User com os dados obtidos e retorná-lo
        $user = new self($this->conn, $userData['email'], $userData['password'], $userData['name']);
        
        // Atribuir outras propriedades se necessário
        $user->setUserID($userData['user_id']);
   
        return $user;
    }

    public function getAllUsers() {
        return parent::fetchAll('user');
    }

}

?>