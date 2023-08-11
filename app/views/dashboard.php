 <?php 
session_start();

// Verifica se ta logado para evitar acesso indesejado
if (!isset($_SESSION['user'])) {
  throw new Exception('Acesso restrito.');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel ADMIN</title>
    <link rel="stylesheet" href="/public/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Barra Lateral -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>ADMIN</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Pontos</a></li>
                <li><a href="#">Usuários</a></li>
                <li><a href="#">Configurações</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <!-- Conteúdo -->
        <div class="content">
            <h2> Olá <?php echo $_SESSION['user']['name'];?>, bem vindo de volta.
        </div>
    </div>
</body>
</html>
