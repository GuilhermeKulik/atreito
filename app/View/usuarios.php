<?php
 require 'app/Core/Component/Header.php'; ?>

    <title>Usuários - Atreito</title>
</head>

<?php require 'app/Core/Component/Sidebar.php'; ?>

<!-- Main content -->
<div id="main-content" class="col-md-9 col-lg-7">

<!-- Upper navbar -->
<?php require 'app/Core/Component/Navbar-users.php'; ?>

<h2>Usuários</h2>

    <!-- pesquisa usuários -->
    <div class="search-container mb-2">
        <form action="" method="GET">
            <div class="mb-2">
                <input type="text" class="search-input form-control" name="query" placeholder="Buscar usuário...">
            </div>
            
            <!-- Filtros -->
            <div class="filter-container mb-2">
                <label class="mr-2"><input type="radio" name="filter" value="name" checked> Nome</label>
                <label class="mr-2"><input type="radio" name="filter" value="email"> Email</label>
                <label class="mr-2"><input type="radio" name="filter" value="phone"> Telefone</label>
            </div>

            <div>
                <button type="submit" class="search-btn btn btn-light">Buscar</button>
            </div>
        </form>
    </div>

    <!-- Grid de Resultados -->
    <div class="results-grid mt-4">
        <!-- O conteúdo dos resultados irá aqui -->
    </div>
</div>

    <!-- Painel de Adição de Usuário -->
    <div id="add-user-panel" class="col-md-12 col-lg-3 d-none">
        <div class="card">
            <div class="card-header">
                Adicionar Usuário
            </div>
            <div class="card-body">
                <?php require 'app/Core/Components/Add-user-form.php'; ?>
            </div>
        </div>
    </div>

</body>
<?php require 'app/Core/Component/Footer.php'; ?>
