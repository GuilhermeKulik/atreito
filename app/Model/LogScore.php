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
         * Inicializa um novo objeto LogScore. Se os parâmetros forem fornecidos,
         * eles serão usados para inicializar as propriedades do objeto.
         *
         * @param int|null $clientId ID do cliente associado à transação (opcional).
         * @param int|null $adminId ID do administrador que realizou a transação (opcional).
         * @param string|null $transactionType Tipo de transação realizada (opcional).
         * @param int|null $pointsAmount Quantidade de pontos envolvidos na transação (opcional).
         */
        public function __construct($clientId = null, $adminId = null, $transactionType = null, $pointsAmount = null)
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
     * Retrieves a ranking of sellers based on the total sum of points added in transactions.
     *
     * This method performs a SQL JOIN between the `log_score` and `user` tables,
     * filtering by the user type as 'seller' and transaction type as 'ADD'.
     * It includes transactions for the current month and orders the results
     * by the total sum of points in descending order.
     * 
     * @return array An associative array containing the ranking of sellers.
     * @throws Exception Throws an exception if an error occurs during the database query.
     */
    public function getSellersRankingThisMonth() {
        try {
            // Obtém o primeiro dia do mês atual em formato 'YYYY-MM-DD'
            $firstDayOfMonth = date('Y-m-01');
            // Obtém o último dia do mês atual em formato 'YYYY-MM-DD'
            $lastDayOfMonth = date('Y-m-t');
    
            $sql = "SELECT 
                        u.name AS seller_name, 
                        SUM(ls.points_amount) AS total_points
                    FROM log_score ls
                    JOIN user u ON ls.admin_id = u.user_id
                    WHERE ls.transaction_type = 'ADD'
                        AND u.user_type = 'seller'
                        AND ls.transaction_date >= :firstDayOfMonth
                        AND ls.transaction_date <= :lastDayOfMonth
                    GROUP BY u.user_id
                    ORDER BY total_points DESC";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['firstDayOfMonth' => $firstDayOfMonth, 'lastDayOfMonth' => $lastDayOfMonth]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error in retrieving seller ranking: " . $e->getMessage());
        }
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


    /**
     * Get all log records from the system.
     *
     * Retrieves a complete list of log entries from the database
     * and returns them as an associative array.
     *
     * @return array An associative array containing all log records.
     */
    public function getLogs()
    {
        try {
            // SQL query to fetch all records from log_score table
            $sql = "SELECT * FROM " . self::TABLE_NAME . " ORDER BY transaction_date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar logs: " . $e->getMessage());
        }
    }
}
