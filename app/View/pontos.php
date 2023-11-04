<?php require 'app/Core/Component/Header.php'; ?>
<?php include 'app/Core/Component/Modal_search_user.php'; ?>
<title>Pontos - Atreito</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- Menu Lateral -->
        <aside class="col-md-3 col-lg-2">
            <?php require 'app/Core/Component/Sidebar.php'; ?>
        </aside>

        <!-- Conteúdo Principal -->
        <main id="main-content" class="col-12 col-md-9 col-lg-10 pt-3 pb-3">

            <!-- Upper navbar -->
            <?php require 'app/Core/Component/Navbar-users.php'; ?>

            <div class="row">
                <!-- Card para Adicionar Pontos -->
                <div class="col-lg-6 col-md-6 col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class='card-title'>Adicionar Pontos</h5>
                            <form id="addPointsForm" method="POST">
                                <div class="mb-2">
                                    <label for="points" class='form-label'> Quantidade de pontos </label>
                                    <input type="number" class="form-control" id="points" name="points" placeholder="Quantidade de pontos...">
                                </div>
                                <div class="mb-2">
                                    <label for="userIdentification" class='form-label'> Código do cliente </label>
                                    <input type="text" class="form-control" id="userIdentification" name="userIdentification" placeholder="Número de identificação do usuário...">
                                </div>
                                <div class="mb-2">
                                    <label for="adminIdentification" class='form-label'> Vendedor </label>
                                    <input type="text" class="form-control" id="adminIdentification" value='<?php echo $_SESSION['user']['name']; ?>' disabled placeholder="Seu número de identificação...">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card para Consumir Pontos -->
                <div class="col-lg-6 col-md-6 col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class='card-title'>Consumir Pontos</h5>
                            <form id="consumePointsForm" method="POST">
                                <div class="mb-2">
                                    <label for="consumePoints" class='form-label'>Quantidade de pontos</label>
                                    <input type="number" class="form-control" id="consumePoints" name="consumePoints" placeholder="Quantidade de pontos a consumir...">
                                </div>
                                <div class="mb-2">
                                    <label for="userConsumeIdentification" class='form-label'>Código do cliente</label>
                                    <input type="text" class="form-control" id="userConsumeIdentification" name="userConsumeIdentification" placeholder="Número de identificação do usuário...">
                                </div>
                                <div class="mb-2">
                                    <label for="sellerIdentification" class='form-label'>Vendedor</label>
                                    <input type="text" class="form-control" id="sellerIdentification" value='<?php echo $_SESSION['user']['name']; ?>' disabled placeholder="Seu número de identificação...">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-warning">Consumir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Fecha row interna -->
        </main>

    </div> <!-- fecha row principal -->
</div> <!-- fecha container-fluid -->

<?php require 'app/Core/Component/Footer.php'; ?>
