<?php 
require 'app/Core/Component/Header.php'; 

use Atreito\Controller\ScoreController;

$scoreController = new ScoreController();
$userId = $_SESSION['user']['user_id']; 
$userXpPoints = $scoreController->getUserXpPoints($userId);

// Calcula o nível atual e os pontos necessários para o próximo nível
$level = floor($userXpPoints / 1000) +1;
$xpForNextLevel = 1000 - ($userXpPoints % 1000);
$progressToNextLevel = ($userXpPoints % 1000) / 1000;
?>
<title>Perfil - Atreito</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- Menu Lateral -->
        <aside class="col-md-3 col-lg-2">
            <?php require 'app/Core/Component/Sidebar.php'; ?>
        </aside>

        <!-- Conteúdo Principal -->
        <main id="main-content" class="col-12 col-md-9 col-lg-10">
            <div class='row' id='perfil-cards'>
                <!-- Card com Informações do Usuário -->
                <div class="col-md-6 mb-4"> 
                    <div class="card user-info-card h-100">
                        <div class="card-body" style='text-align: center'>
                            <h5 class="card-title"></h5> 
                            <h3 class='name-card'><strong>Seja bem-vindo, <?php echo $_SESSION['user']['name']; ?>.</strong></h3>
                            <p> Não perca as promoções exclusivas para os membros do clube.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card Total de Pontos -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">MOEDAS</h5>
                            <p class="card-text card-perfil-value"><?php echo $_SESSION['score']['points']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Card Nível do Usuário -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Nível</h5>
                            <p class="card-text card-perfil-value"> <?php echo $level; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Barra de XP -->
                <div class="col-md-6 mb-4">
                    <div class="card xp-bar h-100" style="background-color: var(--dutch-white);">
                        <div class="card-body">
                            <h5 class="card-title">Experiência</h5>
                            <p style='color: #000; text-align: center'>Total de XP: <?php echo $userXpPoints; ?></p>
                            <p style='color: #000; text-align: center'>XP para o próximo nível: <?php echo $xpForNextLevel; ?></p>
                            <div id="progress"></div> <!-- Container para a barra de progresso -->
                        </div>
                    </div>
                </div>

                <!-- Card Categoria -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5 class="card-title">Categoria</h5>
                            <?php
                            $categoryImage = '';
                            $categoryName = '';

                            if ($userXpPoints < 10000) {
                                $categoryImage = 'public/img/bronze-modified.png';
                                $categoryName = 'Bronze';
                            } elseif ($userXpPoints < 20000) {
                                $categoryImage = 'public/img/prata-modified.png';
                                $categoryName = 'Prata';
                            } else {
                                $categoryImage = 'public/img/gold-modified.png';
                                $categoryName = 'Ouro';
                            }
                            ?>
                            <img src="<?php echo $categoryImage; ?>" alt="Categoria <?php echo $categoryName; ?>" style="max-width: 100px; margin-bottom: 10px;">
                            <p>Você está na categoria <strong><?php echo $categoryName; ?></strong>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var progressToNextLevel = <?php echo json_encode($progressToNextLevel); ?>;

    var bar = new ProgressBar.Line('#progress', {
        strokeWidth: 4,
        easing: 'easeInOut',
        duration: 1400,
        color: '#09A721',
        trailColor: '#eee',
        trailWidth: 1,
        svgStyle: {width: '100%', height: '100%'},
        text: {
            style: {
                color: '#999',
                position: 'absolute',
                right: '0',
                top: '30px',
                padding: 0,
                margin: 0,
                transform: null
            },
            autoStyleContainer: false
        },
        from: {color: '#09A721'},
        to: {color: '#09A721'},
        step: (state, bar) => {
            bar.setText(Math.round(bar.value() * 100) + ' %');
        }
    });

    bar.animate(progressToNextLevel); // Valor de 0.0 a 1.0
});
</script>

</body>
<?php require 'app/Core/Component/Footer.php'; ?>
