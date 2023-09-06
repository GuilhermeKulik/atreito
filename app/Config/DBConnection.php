<?php

namespace Atreito\Config;

/*
 * Classe DBConnection, que se encarregará de estabelecer a conexão com o banco de dados.
 */

class DBConnection
{
    private static $instance = null;
    private $conn;

    const DB_HOST = 'localhost';
    const DB_NAME = 'atreito';
    const DB_USER = 'root';
    const DB_PASS = '123';

    // O construtor agora é privado, para impedir que se possa instanciar a classe diretamente.
    private function __construct($host = self::DB_HOST, $dbname = self::DB_NAME, $username = self::DB_USER, $password = self::DB_PASS)
    {
        try {
            $this->conn = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    // Impede que a instância seja clonada.
    private function __clone() {}

    // Impede que a instância seja desserializada.
    private function __wakeup() {}

    // Método para obter a única instância da classe.
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
