<?php
require_once __DIR__ . '/../Controller/ScoreController.php'; 

$scoreController = new Atreito\Controller\ScoreController();
$sellerRanking = $scoreController->getRankingSeller();

require 'app/Core/Component/Header.php';
?>
<title>Ranking - Atreito</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2">
            <?php require 'app/Core/Component/Sidebar.php'; ?>
        </aside>

        <main id="main-content" class="col-12 col-md-9 col-lg-10">
            

            <div class="row">
                <div class="col-12">
                    <div class="card" style='margin-top: 20px'>
                        <div class="card-body">
                            <h5 class="card-title">Ranking dos Vendedores</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Lugar</th>
                                            <th>Nome</th>
                                            <th>Total de Pontos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sellerRanking as $index => $seller): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($seller['name']); ?></td>
                                            <td><?php echo htmlspecialchars($seller['points']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php var_dump($sellerRanking); ?>

<?php require 'app/Core/Component/Footer.php'; ?>
</body>
</html>
