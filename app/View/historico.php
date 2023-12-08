<?php 
require 'app/Core/Component/Header.php';
use Atreito\Model\LogScore;

// Criando uma instância da classe LogScore
$logScoreModel = new LogScore();

// Obtendo os logs
$logs = $logScoreModel->getLogs();
?>

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
                <!-- Cabeçalho e outros elementos -->
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
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($log['log_id']); ?></td>
                                    <td><?php echo htmlspecialchars($log['transaction_date']); ?></td>
                                    <td><?php echo htmlspecialchars($log['client_id']); ?></td>
                                    <td><?php echo htmlspecialchars($log['admin_id']); ?></td>
                                    <td><?php echo htmlspecialchars($log['transaction_type']); ?></td>
                                    <td><?php echo htmlspecialchars($log['points_amount']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php require 'app/Core/Component/Footer.php'; ?>

