
<?php 

if (!isset($_SESSION)) {
session_start();
} 

require_once __DIR__ . '/../../app/controllers/LoginController.php';
$loginController = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginController->login();
}

$m = isset($_GET['m']) ? urldecode($_GET['m']) : null;
$alertClass = isset($_GET['a']) ? urldecode($_GET['a']) : null;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="login-modal">
                    <div class="card">
                        <h5 class="card-title">Login</h5>

                        <!-- Exibir a mensagem de erro se presente na URL -->
                        <?php if ($m) : ?>
                            <div class="alert alert-<?php echo $alertClass?>" role="alert">
                                <?php echo $m; ?>
                                <?php $m = null; ?>
                            </div>
                        <?php endif; ?>

                        <form id="login-form" method="POST">
                            <div class="mb-3">
                                <label for="login" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="login" name="email" placeholder="Digite seu usuário">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
                            </div>
                            <button type="submit" class="btn btn-login text-white">Entrar</button>
                        </form>
                        <div class="link-container">
                            <a href="<?php echo $basePath; ?>/app/views/user/add.php" class="text-decoration-none">Criar conta</a> |
                            <a href="#" class="text-decoration-none">Recuperar senha</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo $basePath; ?>/public/js/login.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
