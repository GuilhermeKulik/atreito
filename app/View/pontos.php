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
     <!-- Conteúdo Principal -->
<!-- Conteúdo Principal -->
<main id="main-content" class="col-12 col-md-9 col-lg-10">

    <!-- Upper navbar -->
    <?php require 'app/Core/Component/Navbar-users.php'; ?>

    <div class="row">

        <!-- Card para Adicionar Pontos -->
        <div class="col-lg-10 col-md-8 col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <p class='card-title'>Adicionar Pontos</p>
                    <form id="pointsForm" method="POST">
                        <div class="mb-2">
                            <p class='form-label'> Quantidade de pontos <p>
                            <input type="number" class="points-input form-control" name="points" placeholder="Quantidade de pontos...">
                        </div>
                        <div class="mb-2">
                        <p class='form-label'> Codigo do cliente <p>
                            <input type="text" class="user-identification-input form-control" name="userIdentification" placeholder="Número de identificação do usuário...">
                        </div>
                        <div class="mb-2">
                        <p class='form-label'> Vendedor <p>
                            <input type="text" class="admin-identification-input form-control" value='<?php echo $_SESSION['user']['name'];?>' disabled name="adminIdentification" placeholder="Seu número de identificação...">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-login text-white assign-points-btn btn btn-light">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mini Perfil -->
        <div class="col-lg-3 col-md-4 col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Usuario</p>
                </div>
            </div>
        </div>

    </div> <!-- Fecha row interna -->
</main>



        <!-- Painel Adicional (trigado pelo js) -->
        <section id="additional-panel" class="col-md-12 col-lg-3">
            <!-- Conteúdo adicional aqui (trigado pelo js) -->
        </section>
    </div> <!-- fecha row principal -->
</div> <!-- fecha container-fluid -->

</body>

<?php require 'app/Core/Component/Footer.php'; ?>
