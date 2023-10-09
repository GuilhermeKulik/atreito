<?php
namespace Atreito\Controller;

use Atreito\Model\Score;
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
        if (isset($_POST['userId']) && isset($_POST['points'])) {
            $userId = $_POST['userId'];
            $points = $_POST['points'];
    
            try {
                // Obtém o modelo de pontuação do usuário.
                $scoreModel = new Score($userId);
                // Adiciona os pontos ao usuário.
                $scoreModel->addPoints($points);
                // ADD XP
                $scoreModel->addExperience($points);
                // Add pontos ao vendedor
                $scoreModel->addPointsSeller($points);
                // Retorna uma resposta de sucesso.
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Pontos adicionados com sucesso']);
            } catch (Exception $e) {
                // Retorna uma mensagem de erro se algo der errado.
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            // Retorna uma mensagem de erro se userId ou points não forem fornecidos.
            echo json_encode(['status' => 'error', 'message' => 'UserId ou pontos não fornecidos']);
        }
    }
}
