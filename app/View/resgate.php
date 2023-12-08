<?php 
require 'app/Core/Component/Header.php'; 
use Atreito\Controller\PromotionController;

$promotionController = new PromotionController();
$promotions = $promotionController->getAllPromotions();
?>

<title>Resgate - Atreito</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Menu Lateral -->
            <aside class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <?php require 'app/Core/Component/Sidebar.php'; ?>
            </aside>

            <!-- Conteúdo Principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Resgate</h1>
                    <!-- Botão para adicionar promoções -->
                    <div class='row'>
                    <div class='col'>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromotionModal">
                        Adicionar
                    </button>
                    </div>
                    <div class='col'>
                        <!-- Botão para excluir promoções -->
                        <button type="button" class="btn btn-danger add-promo" data-bs-toggle="modal" data-bs-target="#deletePromotionModal">
                            Remover
                        </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tabela de promoções -->
                <h2>Troque suas moedas por mercadorias da loja</h2>
                <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Data de Expiração</th>
                                <th>Categoria</th>
                                <th>Nível</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promotions as $promotion): ?>
                                <?php 
                                    $expirationDate = new DateTime($promotion['expiration_date']);
                                    $formattedDate = $expirationDate->format('Y-m-d'); // Formata a data
                                    $now = new DateTime();
                                    if ($expirationDate < $now) {
                                        continue; // Não exibir se a data de expiração passou
                                    }
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($promotion['promotion_id']); ?></td>
                                    <td><?php echo htmlspecialchars($promotion['name']); ?></td>
                                    <td><?php echo htmlspecialchars($promotion['value']); ?></td>
                                    <td><?php echo htmlspecialchars($formattedDate); ?></td>
                                    <td><?php echo htmlspecialchars($promotion['category']); ?></td>
                                    <td><?php echo htmlspecialchars($promotion['level']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Adicionar Promoção -->
                <div class="modal fade" id="addPromotionModal" tabindex="-1" role="dialog" aria-labelledby="addPromotionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPromotionModalLabel">Nova Promoção</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                    
                            <form id="promotion-form">
                                <div class="mb-3">
                                    <label for="promotion-name" class="col-form-label">Nome:</label>
                                    <input type="text" class="form-control" id="promotion-name" name="promotion-name">
                                </div>
                                <div class="mb-3">
                                    <label for="promotion-value" class="col-form-label">Valor:</label>
                                    <input type="text" class="form-control" id="promotion-value" name="promotion-value">
                                </div>
                                <div class="mb-3">
                                    <label for="promotion-expiration" class="col-form-label">Data de Expiração:</label>
                                    <input type="date" class="form-control" id="promotion-expiration" name="promotion-expiration">
                                </div>
                                <div class="mb-3">
                                    <label for="promotion-category" class="col-form-label">Categoria:</label>
                                    <select class="form-control" id="promotion-category" name="promotion-category">
                                        <option value="Bronze">Bronze</option>
                                        <option value="Prata">Prata</option>
                                        <option value="Ouro">Ouro</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="promotion-level" class="col-form-label">Nível:</label>
                                    <input type="number" class="form-control" id="promotion-level" name="promotion-level" min="1">
                                </div>
                            </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" id="save-promotion">Salvar Promoção</button>
                            </div>
                        </div>
                    </div>
                </div>
                                    <!-- Modal Excluir Promoção -->
                <div class="modal fade" id="deletePromotionModal" tabindex="-1" role="dialog" aria-labelledby="deletePromotionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePromotionModalLabel">Excluir Promoção</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="delete-promotion-form">
                                    <div class="mb-3">
                                        <label for="promotion-id" class="col-form-label">Código da Promoção:</label>
                                        <input type="text" class="form-control" id="promotion-id" name="promotion-id">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="confirm-delete-promotion">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>           

            </main>
        </div>
    </div>

    <?php require 'app/Core/Component/Footer.php'; ?>

    <!-- Opção de incluir jQuery e Bootstrap JS localmente ou através de uma CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

