<?php require 'app/Core/Component/Header.php'; ?>

<title>Usuários - Atreito</title>
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
            <?php require 'app/Core/Component/Navbar-users.php'; ?>

            <h2>Pesquisar usuários</h2>

            <!-- pesquisa usuários -->
        <div class="search-container mb-2">
        <form id="searchForm">
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
        </main>

        <!-- Painel de Adição de Usuário -->
        <section id="add-user-panel" class="col-md-12 col-lg-3">

                    <?php require 'app/Core/Component/Registration-modal.php'; ?>
            </div>
        </section>
    </div> <!-- fecha row -->
</div> <!-- fecha container-fluid -->
</body>

<?php require 'app/Core/Component/Footer.php'; ?>

