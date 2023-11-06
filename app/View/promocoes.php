<?php require 'app/Core/Component/Header.php'; ?>

<title>Promoções - Atreito</title>
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
                    <h1 class="h2">Promoções</h1>
                    <!-- Botão para adicionar promoções -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromotionModal">
                        Adicionar Promoção
                    </button>
                </div>
                
                <!-- Tabela de promoções -->
                <h2>Lista de Promoções</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Data de Expiração</th>
                                <th>Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Linhas da tabela adicionadas dinamicamente aqui -->
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
                                <form>
                                    <div class="mb-3">
                                        <label for="promotion-name" class="col-form-label">Nome:</label>
                                        <input type="text" class="form-control" id="promotion-name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="promotion-value" class="col-form-label">Valor:</label>
                                        <input type="text" class="form-control" id="promotion-value">
                                    </div>
                                    <div class="mb-3">
                                        <label for="promotion-expiration" class="col-form-label">Data de Expiração:</label>
                                        <input type="date" class="form-control" id="promotion-expiration">
                                    </div>
                                    <div class="mb-3">
                                        <label for="promotion-category" class="col-form-label">Categoria:</label>
                                        <select class="form-control" id="promotion-category">
                                            <option value="Bronze">Bronze</option>
                                            <option value="Prata">Prata</option>
                                            <option value="Prata">Ouro</option>
                                            <!-- Outras categorias aqui -->
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary">Salvar Promoção</button>
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

