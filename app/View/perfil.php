<?php 

require 'app/Core/Component/Header.php'; 


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
<!-- Conteúdo Principal -->
<main id="main-content" class="col-12 col-md-9 col-lg-10">

    <!-- Row para os Cards -->

        <!-- Card com Informações do Usuário -->
        <div class='row' id='perfil-cards'>
            <div class="col-12 col-md-6"> <!-- Divisão para uma coluna em todas as telas -->
                <div class="card user-info-card">
                    <div class="card-body">
                        <h5 class="card-title">Minha conta</h5> <!-- Substitua pelo nome real do usuário -->
                        <p class="form-label card-text">Email:</p> <?php echo $_SESSION['user']['email'];?></p> <!-- Substitua pelo email real do usuário -->
                        <p class="form-label card-text">Celular:</p> <?php echo $_SESSION['user']['mobile_number'];?></p> <!-- Substitua pelo número de celular real do usuário -->
                    </div>
                </div>
            </div>
        </div>
  <?php var_dump($_SESSION['score']); ?>

        <!-- Card Total de Pontos -->
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    
                    <h5 class="card-title">PONTOS</h5>
                    <p class="card-text card-perfil-value" ><?php echo $_SESSION['score']['points'] ?> <!-- Valor --></p>
                </div>
            </div>
        </div>

                <!-- Card Total de Pontos -->
                <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Level</h5>
                    <p class="card-text card-perfil-value">1</p>
                </div>
            </div>
        </div>

                <!-- Barra de XP -->
                <div class="col-12 col-md-6">
            <div class="card xp-bar" style="background-color: var(--dutch-white); margin-top: 20px;">
                <div class="card-body">
                    <h5 class="card-title">Experiencia</h5>
                    <div id="progress"></div> <!-- Contêiner para a barra de progresso -->
                </div>
            </div>
        </div>

    </div>
</main>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
            bar.setText(Math.round(bar.value() * 100) + ' %'); // Aqui você pode substituir bar.value() pela porcentagem de XP do usuário.
        }
    });

    bar.animate(1.0);  // Substitua 1.0 pela porcentagem de XP do usuário dividida por 100.
});
</script>

</body>
<?php require 'app/Core/Component/Footer.php'; ?>
