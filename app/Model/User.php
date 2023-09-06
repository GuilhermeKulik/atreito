<?php

namespace Atreito\Model;

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
        $this->dateCreated = new \DateTime();
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

    // Functions

    /**
     * Creates a new user in the database.
     * 
     * @return int The ID of the newly created user.
     */
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

    /**
     * Updates an existing user in the database.
     * 
     * @param int $userID The ID of the user to be updated.
     * @param array $newData New data for update (email, password, name).
     * @return int Returns the number of rows affected by the operation.
     */
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
    
    /**
     * Deletes a user from the database.
     * 
     * @param int $userID The ID of the user to be deleted.
     * @return int|null Returns the ID of the deleted user if successful, or null if no changes were made.
     */
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

    /**
     * Authenticates a user using email and password.
     * 
     * @param string $email User's email.
     * @param string $password User's password.
     * @return bool Returns true if successfully authenticated, false otherwise.
     */
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

    /**
     * Generates a hash of the provided password.
     * 
     * @param string $password Password to be hashed.
     * @return string Returns the hashed password.
     */
    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Retrieves a user based on the provided ID.
     * 
     * @param int $id User's ID.
     * @return User|null Returns a User object or null if the user isn't found.
     */
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

    /**
     * Retrieves all users from the database.
     * 
     * @return array Returns a list of users.
     */
    public function getAllUsers() {
        return parent::fetchAll('user');
    }

}

?>