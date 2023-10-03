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
        <main id="main-content" class="col-md-9 col-lg-7">

            <!-- Upper navbar -->
            <?php require 'app/Core/Component/Navbar-users.php'; ?> <!-- Supondo que a barra de navegação seja a mesma -->

            <!-- Atribuição de pontos -->
            <div class="points-container mb-2">
                <h2> Adicionar pontos
                <form id="pointsForm" method="POST">
                    <div class="mb-2">
                        <input type="number" class="points-input form-control" name="points" placeholder="Quantidade de pontos...">
                    </div>
                    <div class="mb-2">
                        <input type="text" class="user-identification-input form-control" name="userIdentification" placeholder="Número de identificação do usuário...">
                    </div>
                    <div>
                        <button type="submit" class="assign-points-btn btn btn-light">Enviar</button>

                    </div>
                </form>
            </div>
            <div id="mini-profile">
                <p class="user-name-display"></p>
                <p class="user-email-display"></p>
                <p class="user-phone-display"></p>
            </div>
        </main>

        <!-- Painel Adicional (trigado pelo js) -->
        <section id="additional-panel" class="col-md-12 col-lg-3">
            <!-- Conteúdo adicional aqui (trigado pelo js) -->
        </section>
    </div> <!-- fecha row -->
</div> <!-- fecha container-fluid -->

</body>

<?php require 'app/Core/Component/Footer.php'; ?>
