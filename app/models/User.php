<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    private $conn;
    private $table = 'users';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

public function createUser($data)
{
    try {
        // Verifica se a senha está presente no array e a criptografa
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // Verifica os campos obrigatórios antes de realizar a criação do usuário
        if (empty($data['name']) || empty($data['email']) || empty($data['userType']) || empty($data['phone'])) {
            throw new Exception("Erro. Preencha todos os campos obrigatórios.");
        }

        // Verifica se o email já está em uso
        if ($this->emailExists($data['email'])) {
            $m = "ERRO!<br>Este e-mail já foi cadastrado.";
            $alertClass = 'danger';
            $url = '/app/views/user/add.php?m=' . urlencode($m) . '&a=' . urlencode($alertClass);
            header('Location: ' . $url);
            exit();
        }

        $query = "INSERT INTO $this->table (name, email, userType, password, phone, address, houseNumber, bairro, cep, instagram) VALUES (:name, :email, :userType, :password, :phone, :address, :houseNumber, :bairro, :cep, :instagram)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':userType', $data['userType']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':houseNumber', $data['houseNumber']);
        $stmt->bindParam(':bairro', $data['bairro']);
        $stmt->bindParam(':cep', $data['cep']);
        $stmt->bindParam(':instagram', $data['instagram']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Em caso de erro, capturamos a exceção e a lançamos novamente para ser tratada em outro lugar
        throw $e;
    }
}


    public function getUserById($userId)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $data)
    {
        // Define os campos que podem ser atualizados
        $updateFields = ['name', 'email', 'phone', 'address', 'houseNumber', 'bairro', 'cep', 'instagram', 'userType'];
        $queryParts = [];
        foreach ($updateFields as $field) {
            if (isset($data[$field])) {
                $queryParts[] = "$field = :$field";
            }
        }

        // Caso nenhum campo seja fornecido para atualização, retorna um erro
        if (empty($queryParts)) {
            throw new Exception("No fields provided for update. At least one field is required.");
        }

        // Monta a query
        $query = "UPDATE $this->table SET " . implode(', ', $queryParts) . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $data['id'] = $userId;
        $stmt->execute($data);

        return $stmt->rowCount();
    }

    public function deleteUser($userId)
    {
        try {
            // Verifica se o ID do usuário foi fornecido
            if (empty($userId)) {
                throw new Exception("User ID is required for deleting the user.");
            }

            $query = "DELETE FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Em caso de erro, capturamos a exceção e a lançamos novamente para ser tratada em outro lugar
            throw $e;
        }
    }

    public function checkPermission($userId, $requiredRoles)
    {
        $user = $this->getUserById($userId);
        if ($user && in_array($user['userType'], $requiredRoles)) {
            return true;
        }
        return false;
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    
     }
}