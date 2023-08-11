 <?php 
session_start();

// Verifica se ta logado para evitar acesso indesejado
if (!isset($_SESSION['user'])) {
  throw new Exception('Acesso restrito.');
}

$user = $_SESSION['user']; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
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
                <li><a href="/app/views/dashboard.php">Dashboard</a></li>
                <li><a href="/app/views/perfil.php">Perfil</a></li>
                <li><a href="#">Pontos</a></li>
                <li><a href="#">Clientes</a></li>
                <li><a href="#">Configurações</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <!-- Conteúdo -->
        <div class="content">
            <p>Nome: <?php echo $user['name'];?></p>
            <p>E-mail: <?php echo $user['email'];?></p>
            <p>Celular: <?php echo $user['phone'];?></p>
            <p>Endereço: <?php echo $user['address'];?></p>
            <p>Cep: <?php echo $user['cep'];?></p>
            <p>Bairro: <?php echo $user['bairro'];?></p>
            <p>Número: <?php echo $user['houseNumber'];?></p>
            <p>Nível: <?php echo $user['userType'];?></p>
        </div>
    </div>
</body>
</html>