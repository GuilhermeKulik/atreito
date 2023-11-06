<?php

namespace Atreito\Model;

use PDO;
use Exception;

    /**
     * Classe LogScore
     *
     * Esta classe é responsável por manipular os registros de log de pontos no sistema.
     */
    class LogScore extends GenericModel
    {
        private $logId;
        private $transactionDate;
        private $clientId;
        private $adminId;
        private $transactionType;
        private $pointsAmount;
    
        const TABLE_NAME = "log_score";
    
        /**
         * Construtor da classe LogScore.
         *
         * Inicializa um novo objeto LogScore com os dados fornecidos.
         *
         * @param string $transactionDate Data da transação.
         * @param int $clientId           ID do cliente associado à transação.
         * @param int $adminId            ID do administrador que realizou a transação.
         * @param string $transactionType Tipo de transação realizada (por exemplo, "add" ou "consume").
         * @param int $pointsAmount       Quantidade de pontos envolvidos na transação.
         */
        public function __construct($clientId, $adminId, $transactionType, $pointsAmount)
        {
            parent::__construct();
            $this->transactionDate = date('Y-m-d H:i:s');
            $this->clientId = $clientId;
            $this->adminId = $adminId;
            $this->transactionType = $transactionType;
            $this->pointsAmount = $pointsAmount;
        }
    
        /**
         * Método save
         *
         * Insere um novo registro de log no banco de dados com os dados do objeto atual.
         *
         * @return int Retorna o ID do novo registro de log inserido no banco de dados.
         */
        public function save()
        {
            // Prepara os dados para inserção
            $data = [
                'transaction_date' => $this->transactionDate,
                'client_id' => $this->clientId,
                'admin_id' => $this->adminId,
                'transaction_type' => $this->transactionType,
                'points_amount' => $this->pointsAmount,
            ];
            // Insere os dados no banco e retorna o ID do registro inserido
            return $this->insert(self::TABLE_NAME, $data);
        }
    
    

    /**
     * Log a transaction.
     *
     * @param int $clientId The client's ID.
     * @param int $adminId The admin's ID.
     * @param string $transactionType The type of transaction ('ADD' or 'CONSUME').
     * @param int $pointsAmount The amount of points.
     * @return bool Returns true on success and false on failure.
     */
    public function logTransaction($clientId, $adminId, $transactionType, $pointsAmount)
    {
        $data = [
            'client_id' => $clientId,
            'admin_id' => $adminId,
            'transaction_type' => $transactionType,
            'points_amount' => $pointsAmount
        ];

        return $this->insert(self::TABLE_NAME, $data);
    }

    /**
     * Get all transactions for a specific client.
     *
     * @param int $clientId The client's ID.
     * @return array An array of transactions.
     */
    public function getTransactionsForClient($clientId)
    {
        return $this->fetchAll(self::TABLE_NAME, ['client_id' => $clientId]);
    }

    /**
     * Get all transactions conducted by a specific admin.
     *
     * @param int $adminId The admin's ID.
     * @return array An array of transactions.
     */
    public function getTransactionsByAdmin($adminId)
    {
        return $this->fetchAll(self::TABLE_NAME, ['admin_id' => $adminId]);
    }

     /**
     * Get the total number of transactions for a specific month.
     *
     * @param int $month The month (1-12).
     * @param int $year The year.
     * @return int Total number of transactions.
     */
    public function getTotalTransactionsForMonth($month, $year)
    {
        $sql = "SELECT COUNT(*) as total_transactions 
                FROM ".self::TABLE_NAME." 
                WHERE MONTH(transaction_date) = :month AND YEAR(transaction_date) = :year";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['month' => $month, 'year' => $year]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_transactions'] ?? 0;
    }

    /**
     * Get the total accumulated points for a specific month.
     *
     * @param int $month The month (1-12).
     * @param int $year The year.
     * @return int Total accumulated points.
     */
    public function getTotalPointsForMonth($month, $year)
    {
        $sql = "SELECT SUM(points_amount) as total_points 
                FROM ".self::TABLE_NAME." 
                WHERE MONTH(transaction_date) = :month AND YEAR(transaction_date) = :year";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['month' => $month, 'year' => $year]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_points'] ?? 0;
    }

    /**
     * Get the total accumulated points for a specific year.
     *
     * @param int $year The year.
     * @return int Total accumulated points.
     */
    public function getTotalPointsForYear($year)
    {
        $sql = "SELECT SUM(points_amount) as total_points 
                FROM ".self::TABLE_NAME." 
                WHERE YEAR(transaction_date) = :year";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['year' => $year]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_points'] ?? 0;
    }
}
