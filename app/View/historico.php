<?php require 'app/Core/Component/Header.php'; ?>

<title>Histórico - Atreito</title>
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
                    <h1 class="h2">Histórico</h1>
                </div>
                
                <!-- Tabela de Histórico -->
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>Data</th>
                                <th>Cliente ID</th>
                                <th>Admin ID</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- As linhas da tabela serão adicionadas aqui dinamicamente -->
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <?php require 'app/Core/Component/Footer.php'; ?>

    <!-- Opção de incluir jQuery e Bootstrap JS localmente ou através de uma CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
