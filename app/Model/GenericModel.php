<?php

namespace Atreito\Model;

use PDO;
use Exception;
use Atreito\Config\DBConnection;

class GenericModel
{   
    protected $conn;

    public function __construct()
    {
        // Pega a única instância de DBConnection e obtém a conexão dela
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    protected function buildConditions($conditions)
    {
        if (!is_array($conditions)) {
            return $conditions;
        }

        $clauses = [];
        foreach ($conditions as $key => $value) {
            $clauses[] = "$key = :$key";
        }
        return implode(" AND ", $clauses);
    }

    protected function buildLikeConditions($conditions) {
        if (!is_array($conditions)) {
            return $conditions;
        }
    
        $clauses = [];
        foreach ($conditions as $key => $value) {
            $clauses[] = "$key LIKE :$key";
        }
        return implode(" AND ", $clauses);
    }

    protected function fetchAll($table, $conditions = [])
    {
        try {
            $whereClause = $this->buildConditions($conditions);
            $sql = "SELECT * FROM $table" . ($whereClause ? " WHERE $whereClause" : "");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar todos: " . $e->getMessage());
        }
    }

    protected function fetch($table, $conditions = [])
    {
        try {
            $whereClause = $this->buildConditions($conditions);
            $sql = "SELECT * FROM $table" . ($whereClause ? " WHERE $whereClause" : "") . " LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar registro: " . $e->getMessage());
        }
    }

    protected function insert($table, $data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir: " . $e->getMessage());
        }
    }

    protected function update($table, $data, $conditions)
    {
        try {
            $setValues = array_map(function($key) {
                return "$key = :$key";
            }, array_keys($data));
            $setClause = implode(', ', $setValues);
            $whereClause = $this->buildConditions($conditions);
            $sql = "UPDATE $table SET $setClause WHERE $whereClause";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array_merge($data, $conditions));
            return $stmt->rowCount();
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar: " . $e->getMessage());
        }
    }

    protected function delete($table, $conditions)
    {
        try {
            $whereClause = $this->buildConditions($conditions);
            $sql = "DELETE FROM $table WHERE $whereClause";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->rowCount();
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar: " . $e->getMessage());
        }
    }
}
