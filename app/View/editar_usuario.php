<?php require 'app/Core/Component/Header.php'; 

use Atreito\Controller\UserController;

?>
<title>Editar Usuário - Atreito</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- Menu Lateral -->
        <aside class="col-md-3 col-lg-2">
            <?php require 'app/Core/Component/Sidebar.php'; ?>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="col-md-9 col-lg-10 py-3">
            <div class="content-block">
                <h2>Editar Usuário</h2>
                <!-- Formulário de Edição de Usuário -->
                <form id="editUserForm" action="link-para-script-de-processamento" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input value='<?php if($user!=null){$user->getName();}?>' type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do usuário" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email do usuário" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone do usuário" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite uma nova senha">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirme a nova senha">
                    </div>
                    <div class="mb-3">
                        <label for="user_type" class="form-label">Tipo de Usuário</label>
                        <select class="form-control" id="user_type" name="user_type">
                            <option value="member">Membro</option>
                            <option value="seller">Vendedor</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </main>

    </div> <!-- fecha row -->
</div> <!-- fecha container-fluid -->

<?php require 'app/Core/Component/Footer.php'; ?>