<?php

namespace Atreito\Model;

use \PDO;
use \DateTime;
use \LogScore;

/**
 * Score Class
 * Represents the score, experience, and level of a user.
 */
class Score extends GenericModel
{
    private $userId;
    private $xpPoints;
    private $points;
    private $level;
    private $lastUpdated;
    private $streak;
    private $highestStreak;

    const XP_NEEDED_FOR_LEVEL_100 = 100000;
    const TABLE_NAME = "score";

    /**
     * Constructor
     * @param int $userId
     */
    public function __construct($userId)
    {
        parent::__construct($userId);
        $this->userId = $userId;

        // inicia o objeto score com os dados do usuario
        $userData = $this->fetch(self::TABLE_NAME, ['user_id' => $userId]);
        if ($userData) {
            $this->xpPoints = $userData['xp_points'];
            $this->points = $userData['points'];
            $this->level = $userData['level'];
            $this->lastUpdated = $userData['last_updated'];
            $this->streak = $userData['streak'];
            $this->highestStreak = $userData['highest_streak'];
            //$_SESSION['score'] = $userData;
        }
    }

    public function getPoints() {
        return $this->points;
    }

    public function getXpPoints() {
        return $this->xpPoints;
    }

    /**
     * Adiciona pontos ao usuário.
     *
     * @param int $pointsToAdd A quantidade de pontos a serem adicionados.
     */
    public function addPoints($pointsToAdd)
    {
        $this->points += $pointsToAdd; // Adiciona os pontos ao total atual.
        $this->updateScore(); // Atualiza o banco de dados com o novo total de pontos.
       
    }

    /**
     * Adds experience to the user.
     * @param int $xp
     */
    public function addExperience($xp)
    {
        $this->xpPoints += $xp;
        $this->checkForLevelUp();
        $this->streakCheck();
        $this->updateScore();
    }

    /**
     * Consumes user's points.
     * @param int $pointsToConsume
     */
    public function consumePoints($pointsToConsume)
    {
        $this->points -= $pointsToConsume;
        $this->updateScore();
    }

    /**
     * Reverts the last points update.
     */
    public function revertLastUpdate()
    {
        // R.N.F
    }

    /**
     * Checks if user has enough XP to level up.
     */
    private function checkForLevelUp()
    {
        $xpForNextLevel = self::XP_NEEDED_FOR_LEVEL_100 * pow($this->level, 2);
        if ($this->xpPoints >= $xpForNextLevel) {
            $this->xpPoints -= $xpForNextLevel;
            $this->level++;
        }
    }

    /**
     * Check the user's streak based on last update date.
     */
    public function streakCheck()
    {
        $currentDate = new \DateTime();
        $lastUpdated = new \DateTime($this->lastUpdated);

        $interval = $currentDate->diff($lastUpdated);
        $hoursElapsed = $interval->h + ($interval->days * 24);

        if ($hoursElapsed <= 24) {
            $this->streak++;
            if ($this->streak > $this->highestStreak) {
                $this->highestStreak = $this->streak;
            }
        } elseif ($hoursElapsed > 24 && $hoursElapsed <= 48) {
            $this->streak = 0;
        }
    }

    /**
     * Update user's data in the database.
     */
    private function updateScore()
    {
        $data = [
            'xp_points' => $this->xpPoints,
            'points' => $this->points,
            'level' => $this->level,
            'last_updated' => date("Y-m-d H:i:s"),
            'streak' => $this->streak,
            'highest_streak' => $this->highestStreak
        ];
        $conditions = ['user_id' => $this->userId];
        
        $this->update(self::TABLE_NAME, $data, $conditions);
    }

    
    /**
     * Create an initial score entry for a user.
     * @return bool Returns true on success and false on failure.
     */
    public function createScoreForUser($userId)
    {
        $data = [
            'user_id' => $userId,
            'xp_points' => 0,
            'points' => 0,
            'level' => 1,
            'streak' => 0,
            'highest_streak' => 0
        ];

        return $this->insert(self::TABLE_NAME, $data);
    }

    /**
     * Adds points and experience points (XP) to a seller's total.
     *
     * This method increases both the 'points' and 'xp_points' for a seller
     * in the corresponding database table.
     *
     * @param int $points Number of points to add.
     * @return mixed Number of affected rows on successful update, or false
     * if user record not found or user_id not in session.
     * @throws Exception on update method failure.
     */

    public function addPointsSeller($points)
    {
        // Verifica se o user_id está presente na sessão
        if (isset($_SESSION['user']['user_id'])) {
            $userId = $_SESSION['user']['user_id']; // Obtém o user_id da sessão
            $userData = $this->fetch(self::TABLE_NAME, ['user_id' => $userId]); // Obtém os dados do usuário
    
            // Verifica se os dados do usuário foram encontrados
            if ($userData) {
                $userData['points'] += $points; // Adiciona os pontos ao total atual
                $userData['xp_points'] += $points; // Adiciona os pontos de XP ao total atual
    
                // Atualiza os pontos e os pontos de XP do usuário na tabela
                return $this->update(
                    self::TABLE_NAME, 
                    [
                        'points' => $userData['points'],
                        'xp_points' => $userData['xp_points'] // Inclui os xp_points na atualização
                    ], 
                    ['user_id' => $userId]
                );
            } else {
                // Retorna false se o registro do usuário não foi encontrado
                return false;
            }
        } 
    }

     /**
     * Retrieves the ranking of sellers along with user names.
     *
     * @return array An array of user rankings.
     */
    public function getRanking()
    {
        $sql = "SELECT u.name, s.points
                FROM score s
                JOIN user u ON s.user_id = u.user_id
                WHERE u.user_type = 'seller'
                ORDER BY s.points DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
     * Obtém a quantidade atual de pontos de um usuário específico.
     *
     * @param int $userId O ID do usuário para consulta.
     * @return mixed A quantidade de pontos do usuário ou falso se não encontrado.
     */
    public function getCurrentPoints($userId) {
        // Buscar no banco de dados a quantidade de pontos para o userId fornecido.
        $userData = $this->fetch(self::TABLE_NAME, ['user_id' => $userId]);
        
        // Se userData for encontrado, retorna os pontos, caso contrário, retorna falso.
        return $userData ? $userData['points'] : false;
    }

    public function getUserScore($userId)
    {
        $table = 'score';
        $conditions = ['user_id' => $userId];
    
        try {
            $scoreData = $this->fetch($table, $conditions);
    
            if ($scoreData) {
                $this->userId = $userId;
                $this->points = $scoreData['points'];
                $this->xpPoints = $scoreData['xp_points'];
    
                return [
                    'user_id' => $this->userId,
                    'points' => $this->points,
                    'xp_points' => $this->xpPoints,
                ];
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw new Exception("Error retrieving user score: " . $e->getMessage());
        }
    }
}
