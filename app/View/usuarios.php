<?php require 'app/Core/Component/Header.php'; ?>

<title>Usuários - Atreito</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2">
            <?php require 'app/Core/Component/Sidebar.php'; ?>
        </aside>
        <main id="main-content" class="col-md-9 col-lg-7">
            <?php require 'app/Core/Component/Navbar-users.php'; ?>
            <h2>Pesquisar usuários</h2>
            <!-- Modal para Edição de Usuário -->
            <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userEditModalLabel">Editar Usuário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-user-form">
                            <input type="hidden" id="editUserId" name="editUserId" value="">

                                <!-- Campo de Nome -->
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="editName" name="name" placeholder="Digite o nome">
                                </div>
                                <!-- Campo de Email -->
                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" placeholder="Digite o email">
                                </div>
                                <!-- Campo de Celular -->
                                <div class="mb-3">
                                    <label for="editPhone" class="form-label">Celular</label>
                                    <input type="tel" class="form-control" id="editPhone" name="cellphone" placeholder="Digite o celular">
                                </div>
                                <!-- Campo de Senha -->
                                <div class="mb-3">
                                    <label for="editPassword" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="editPassword" name="password">
                                </div>
                                <!-- Campo de Confirmar Senha -->
                                <div class="mb-3">
                                    <label for="editConfirmPassword" class="form-label">Confirmar Senha</label>
                                    <input type="password" class="form-control" id="editConfirmPassword" name="confirmPassword">
                                </div>
                                <!-- Botão para salvar as alterações -->
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="triggerDeleteUserModal('#editUserId')">Excluir</button>

                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<!-- Modal de exclusão de usuário -->
<div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDeleteModalLabel">Excluir Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="userInfo">
        <!-- Os dados do usuário serão injetados aqui -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Excluir</button>
      </div>
    </div>
  </div>
</div>
            <div class="search-container mb-2">
                <form id="searchForm">
                    <div class="mb-2">
                        <input type="text" class="search-input form-control" name="query" placeholder="Buscar usuário...">
                    </div>
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
            <div class="results-grid mt-4">
                <div class="row mb-2 font-weight-bold">
                    <div class="col-md-2">Código</div>
                    <div class="col-md-2">Nome</div>
                    <div class="col-md-3">E-mail</div>
                    <div class="col-md-2">Telefone</div>
                    <div class="col-md-2">Editar</div>
                    <div class="col-md-1"></div>
                </div>
                <div id="resultsGrid">
                </div>
            </div>
        </main>
        <section id="add-user-panel" class="col-md-12 col-lg-3">
            <?php require 'app/Core/Component/Registration-modal.php'; ?>
        </section>
    </div>
</div>
<?php require 'app/Core/Component/Footer.php'; ?>
