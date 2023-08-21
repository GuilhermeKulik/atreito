<?php

require_once __DIR__ . '/../../config/database.php';

class Cliente
{
    private $conn;
    private $table = 'Cliente';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getClienteById($clientId)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $clientId);
        $stmt->execute();
    }

    public function getClienteByEmail($email)
    {
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->conn->fetchAll($sql);
    }

    public function add()
    {

        try {   
            $query = "INSERT INTO $this->table (nome, email, celular, data_nascimento, endereco_rua, endereco_numero, endereco_complemento, endereco_bairro, endereco_cidade, genero) 
                      VALUES (:nome, :email, :celular, :data_nascimento, :endereco_rua, :endereco_numero, :endereco_complemento, :endereco_bairro, :endereco_cidade, :genero)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':celular', $this->celular);
            $stmt->bindParam(':data_nascimento', $this->dataNascimento);
            $stmt->bindParam(':endereco_rua', $this->enderecoRua);
            $stmt->bindParam(':endereco_numero', $this->enderecoNumero);
            $stmt->bindParam(':endereco_complemento', $this->enderecoComplemento);
            $stmt->bindParam(':endereco_bairro', $this->enderecoBairro);
            $stmt->bindParam(':endereco_cidade', $this->enderecoCidade);
            $stmt->bindParam(':genero', $this->genero);
    
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
}


