<?php require 'app/Core/Component/Header.php'; ?>
<title>Ranking - Atreito</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- Menu Lateral -->
        <aside class="col-md-3 col-lg-2">
            <?php require 'app/Core/Component/Sidebar.php'; ?>
        </aside>

        <!-- Conteúdo Principal -->
        <main id="main-content" class="col-12 col-md-9 col-lg-10">

            <!-- Upper navbar -->
            <?php require 'app/Core/Component/Navbar-users.php'; ?>

            <div class="row">

                <!-- Ranking Mensal -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ranking Mensal</h5>
                            <!-- Aqui você iria iterar sobre os dados dos usuários e criar um 'card' para cada um -->
                            <?php
                            // Exemplo de como os dados podem ser iterados (ajuste conforme seus dados reais)
                            foreach ($monthlyRankingUsers as $user) {
                                echo "
                                <div class='card mb-2'>
                                    <div class='card-body'>
                                        <img src='' alt='User Image' class='rounded-circle' width='50' height='50'> <!-- Inserir URL da imagem -->
                                        <p>{$user['name']}</p>
                                        <p>Pontos: {$user['points']}</p>
                                        <p>Colocação: {$user['ranking']}</p>
                                    </div>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Ranking Anual -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ranking Anual</h5>
                            <!-- Aqui você iria iterar sobre os dados dos usuários e criar um 'card' para cada um -->
                            <?php
                            // Exemplo de como os dados podem ser iterados (ajuste conforme seus dados reais)
                            foreach ($annualRankingUsers as $user) {
                                echo "
                                <div class='card mb-2'>
                                    <div class='card-body'>
                                        <img src='' alt='User Image' class='rounded-circle' width='50' height='50'> <!-- Inserir URL da imagem -->
                                        <p>{$user['name']}</p>
                                        <p>Pontos: {$user['points']}</p>
                                        <p>Colocação: {$user['ranking']}</p>
                                    </div>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div> <!-- Fecha row interna -->
        </main>

    </div> <!-- fecha row principal -->
</div> <!-- fecha container-fluid -->

</body>

<?php require 'app/Core/Component/Footer.php'; ?>
