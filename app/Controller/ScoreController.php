<?php
namespace Atreito\Controller;

use Atreito\Model\Score;
use Atreito\Model\LogScore;
use Atreito\Config\DBConnection;

class ScoreController {

    private $scoreModel;
    
    /*
    public function __construct($user_id) {
        $this->scoreModel = new Score($user_id);
    } 
    /*

    /**
     * Adiciona pontos a um usuário específico via requisição POST.
     *
     * @return void
     */
    public function addPoints() {
        if (isset($_POST['userId']) && isset($_POST['points']) && isset($_SESSION['user']['user_id'])) {
            $userId = $_POST['userId'];
            $points = $_POST['points'];
            $adminId = $_SESSION['user']['user_id']; // Obtendo adminId da sessão
    
            try {
                // Obtém o modelo de pontuação do usuário.
                $scoreModel = new Score($userId);
                // Adiciona os pontos ao usuário.
                $scoreModel->addPoints($points);
                
                // Adiciona XP ao usuário.
                $scoreModel->addExperience($points);
                // Adiciona pontos ao vendedor.
                $scoreModel->addPointsSeller($points);
                
                // Cria e salva o log de transação.
                $transactionDate = date("Y-m-d H:i:s");
                $transactionType = 'add';
                $logScore = new LogScore($userId, $adminId, $transactionType, $points);
                $logScore->save(); 
    
                // Atualiza a pontuação na sessão.
                $_SESSION['score']['points'] += $points; 
                // TODO: Arrumar bug interface.
    
                // Retorna uma resposta de sucesso.
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Pontos adicionados com sucesso']);
            } catch (Exception $e) {
                // Retorna uma mensagem de erro se algo der errado.
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            // Retorna uma mensagem de erro se userId, points ou adminId não forem fornecidos.
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'UserId, pontos ou adminId não fornecidos']);
        }
    }

        /**
     * Get the seller ranking.
     *
     * @return array The ranking of sellers as an associative array.
     */
    public function getRankingSeller() {
        try {
            // Cria uma instância de LogScore com a conexão ao banco de dados
            $logScoreModel = new LogScore(DBConnection::getInstance()->getConnection());
            
            // Obtém o ranking dos vendedores para o mês atual
            $sellerRanking = $logScoreModel->getSellersRankingThisMonth();

            return ['status' => 'success', 'ranking' => $sellerRanking];
        } catch (Exception $e) {
            // Manipula exceções ocorridas e retorna uma mensagem de erro
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }


    /**
     * Consume points from a user's score.
     * Ensures required data is present, 
     * checks if the user has enough points,
     * performs the transaction, and logs it.
     *
     * @return void Outputs JSON indicating success or failure.
     */
    public function consumePoints() {
        if (isset($_POST['userId']) && isset($_POST['points'])) {
            $userId = $_POST['userId'];
            $pointsToConsume = $_POST['points'];
            $adminId = $_SESSION['user']['user_id']; 

            $scoreModel = new Score($userId);
            $currentPoints = $scoreModel->getPoints();

            if ($currentPoints !== false && $currentPoints >= $pointsToConsume) {
                $scoreModel->consumePoints($pointsToConsume); 

                $transactionDate = date('Y-m-d H:i:s'); 
                $transactionType = 'consume'; 
                
                $logScore = new LogScore($userId, $adminId, $transactionType, $pointsToConsume);
                $logScore->save(); // Salvando log da transação 
                $_SESSION['score']['points'] -= $pointsToConsume; 

                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Pontos consumidos com sucesso.']);
            } else {
                $errorMsg = $currentPoints === false ? 'Erro ao processar.' : 'Pontos insuficientes.';
                echo json_encode(['status' => 'error', 'message' => $errorMsg]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao processar. Informações incompletas ou inválidas.']);
        }
        exit;
    }

    public function getUserXpPoints($userId) {
        $scoreModel = new Score($userId);
        return $scoreModel->getXpPoints();
    }
    

}
