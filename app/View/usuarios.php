<?php
 require 'app/Core/Component/Header.php'; ?>

    <title>Usuários - Atreito</title>
</head>

<?php require 'app/Core/Component/Sidebar.php'; ?>

        <!-- Conteúdo -->
        <div class="content">
            <h2>Usuários</h2>

            <!-- Filtro ou barra de pesquisa para os usuários -->
            <div class="search-container">
                <form action="" method="GET">
                    <input type="text" class="search-input" name="query" placeholder="Buscar usuário...">
                    <button type="submit" class="search-btn">Buscar</button>
                </form>
            </div>

            <!-- Filtros por nome, email e telefone -->
            <div class="filter-container mt-3">
                <form action="" method="GET">
                    <label><input type="radio" name="filter" value="name" checked> Nome</label>
                    <label><input type="radio" name="filter" value="email"> Email</label>
                    <label><input type="radio" name="filter" value="phone"> Telefone</label>
                    <button type="submit">Filtrar</button>
                </form>
            </div>

            <!-- Grid de Resultados -->
            <div class="results-grid mt-4">
                <!-- O conteúdo dos resultados irá aqui -->
            </div>
        </div>
    </div>
</body>

<?php require 'app/Core/Component/Footer.php'; ?>