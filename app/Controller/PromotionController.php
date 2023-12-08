<?php

namespace Atreito\Controller;

use Atreito\View\GenericView;
use Atreito\Model\Promotion;
use Atreito\Config\DBConnection;

class PromotionController {

    private $promotionModel;
    private $view;

    public function __construct() {
        $this->promotionModel = new Promotion(DBConnection::getInstance()->getConnection());
        $this->view = new GenericView();
    }

    /**
     * Add a new promotion
     *
     * @return void A resposta é enviada como JSON com o status da operação e uma msg
     */
    public function addPromotion() {
        if (empty($_POST['name']) || empty($_POST['value']) || empty($_POST['expiration_date']) || 
            empty($_POST['category']) || empty($_POST['level'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Todos os campos são obrigatórios.'
            ]);
            exit;
        }
    
        $name = $_POST['name'];
        $value = $_POST['value'];
        $expirationDate = $_POST['expiration_date'];
        $category = $_POST['category'];
        $level = $_POST['level'];
        $createdByUserID = $_SESSION['user']['user_id']; // Supondo que o ID do usuário criador esteja na sessão
    
        // Obtém a conexão do banco de dados
        $conn = \Atreito\Config\DBConnection::getInstance()->getConnection();

        // Cria uma instância da classe Promotion
        $promotionModel = new \Atreito\Model\Promotion($conn);

    
        // Chamando o método createPromotion
        $promotionId = $promotionModel->createPromotion($name, $value, $expirationDate, $category, $level, $createdByUserID);
    
        header('Content-Type: application/json');
        if ($promotionId) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Promoção adicionada com sucesso.',
                'promotion_id' => $promotionId
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Não foi possível adicionar a promoção.'
            ]);
        }
        exit;
    }
    
    

    public function updatePromotionInfo() {
        // Verificar se o ID da promoção foi fornecido
        // Atualizar a promoção utilizando o modelo Promotion
        // Retornar um JSON com o status do resultado
    }

    public function deletePromotion() {
        if (isset($_POST['promotion_id'])) {
            $promotionId = $_POST['promotion_id'];
            
            // Chamar o modelo para deletar a promoção
            $result = $this->promotionModel->deletePromotion($promotionId);
    
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Promoção removida com sucesso.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Não foi possível remover a promoção.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID da promoção não fornecido.']);
        }
        exit;
    }

    public function getPromotionById() {
        // Verificar se o ID da promoção foi fornecido
        // Buscar a promoção pelo ID utilizando o modelo Promotion
        // Retornar a promoção em JSON ou um erro se não for encontrada
    }

    public function getAllPromotions() {
        // Obtendo a conexão com o banco de dados
        $conn = \Atreito\Config\DBConnection::getInstance()->getConnection();
    
        // Criando uma instância do modelo Promotion com a conexão do banco
        $promotionModel = new \Atreito\Model\Promotion($conn);
    
        // Chamando o método para buscar todas as promoções
        $promotions = $promotionModel->getAllPromotions();
    
        // Retornando o array de promoções
        return $promotions;
    }
    

    // Outros métodos conforme necessário...
}

