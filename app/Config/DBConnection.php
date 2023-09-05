<?php

/*
 * Classe DBConnection, que se encarregará de estabelecer a conexão com o banco de dados.
 */

class DBConnection
{
    private $conn;
    
    const DB_HOST = 'localhost';
    const DB_NAME = 'atreito';
    const DB_USER = 'root';
    const DB_PASS = '123';

    public function __construct($host = self::DB_HOST, $dbname = self::DB_NAME, $username = self::DB_USER, $password = self::DB_PASS)
    {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
