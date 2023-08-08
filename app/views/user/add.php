<?php
require_once __DIR__ . '/../../../app/controllers/UserController.php';;

$userController = new UserController();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // chama addUser() -> UserController
    $userController->addUser();
}

// pega o erro da url
$m = isset($_GET['m']) ? urldecode($_GET['m']) : null;
$alertClass = isset($_GET['a']) ? urldecode($_GET['a']) : null;
?>


<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/add-user.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="add-user-modal">
                    <div class="card">
                        <h5 class="card-title">Adicionar Usuário</h5>

                        <!-- Mensagem de erro -->
                        <?php if ($m) : ?>
                            <div class="alert alert-<?php echo $alertClass?>" role="alert">
                                <?php echo $m; ?>
                                <?php $m = null; ?>
                            </div>
                        <?php endif; ?>

                        <form id="userForm"  method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userType" class="form-label">Nível</label>
                                        <select class="form-control" id="userType" name="userType" required>
                                            <option value="admin">Administrador</option>
                                            <option value="vendedor">Vendedor</option>
                                            <option value="cliente">Cliente</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirme a senha" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Digite o endereço" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="houseNumber" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="houseNumber" name="houseNumber" placeholder="Digite o número da casa" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Digite o bairro" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-add-user text-white">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/validation.js"></script>
</body>
</html>
