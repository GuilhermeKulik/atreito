<?php

namespace Atreito\Model;

use PDO;
use Exception;
use Atreito\Config\DBConnection;

/**
 * Class GenericModel
 * This class provides basic CRUD operations for database tables.
 */
class GenericModel
{
    /** @var PDO Database connection object */
    protected $conn;

    /**
     * GenericModel constructor.
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    /**
     * Constructs an SQL WHERE clause based on the provided conditions.
     *
     * @param array $conditions Associative array of conditions.
     * @return string SQL WHERE clause.
     */
    protected function buildConditions($conditions)
    {
        $clauses = [];
        foreach ($conditions as $key => $value) {
            $clauses[] = "$key = :$key";
        }
        return implode(" AND ", $clauses);
    }

    /**
     * Constructs the "LIKE" conditions for the SQL query based on the provided conditions.
     *
     * @param array $conditions Associative array of conditions.
     * @return string A string representing the "LIKE" conditions for an SQL query.
     */
    protected function buildConditionsLike($conditions)
    {
        $clauses = [];
    
        foreach ($conditions as $key => $value) {
            if (strpos($value, '%') !== false) {
                $clauses[] = "$key LIKE :$key";
            } else {
                $clauses[] = "$key = :$key";
            }
        }
    
        return implode(" AND ", $clauses);
    }

        /**
     * Determines if any condition value contains a LIKE pattern (contains '%').
     *
     * @param array $conditions Associative array of conditions.
     * @return bool True if any condition value contains '%', false otherwise.
     */
    private function hasLikeCondition($conditions)
    {
        foreach ($conditions as $value) {
            if (strpos($value, '%') !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Fetches all rows from the specified table based on conditions.
     *
     * @param string $table The table to fetch data from.
     * @param array $conditions Associative array of conditions.
     * @return array An array of associative arrays for each fetched row.
     */
    protected function fetchAll($table, $conditions = [])
    {
        try {
            // Determine which condition building method to use based on the presence of '%' in any condition value.
            $whereClauseMethod = $this->hasLikeCondition($conditions) ? 'buildConditionsLike' : 'buildConditions';
            $whereClause = $this->$whereClauseMethod($conditions);
            
            $sql = "SELECT * FROM $table" . ($whereClause ? " WHERE $whereClause" : "");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar registros: " . $e->getMessage());
        }
    }

    /**
     * Fetches a single row from the specified table based on conditions.
     *
     * @param string $table The table to fetch data from.
     * @param array $conditions Associative array of conditions.
     * @return array An associative array representing the fetched row.
     */
    protected function fetch($table, $conditions = [])
    {
        try {
            // Determine which condition building method to use based on the presence of '%' in any condition value.
            $whereClauseMethod = $this->hasLikeCondition($conditions) ? 'buildConditionsLike' : 'buildConditions';
            $whereClause = $this->$whereClauseMethod($conditions);
            
            $sql = "SELECT * FROM $table" . ($whereClause ? " WHERE $whereClause" : "") . " LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar registro: " . $e->getMessage());
        }
    }


    /**
     * Inserts a new row into the specified table.
     *
     * @param string $table The table to insert data into.
     * @param array $data Associative array of column names and their corresponding values.
     * @return int The ID of the last inserted row.
     */
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

    /**
     * Updates rows in the specified table based on the provided conditions.
     *
     * @param string $table The table to update data in.
     * @param array $data Associative array of column names and their new values.
     * @param array $conditions Associative array of conditions to determine which rows to update.
     * @return int Number of rows updated.
     */
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

    /**
     * Deletes rows from the specified table based on the provided conditions.
     *
     * @param string $table The table to delete data from.
     * @param array $conditions Associative array of conditions to determine which rows to delete.
     * @return int Number of rows deleted.
     */
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
