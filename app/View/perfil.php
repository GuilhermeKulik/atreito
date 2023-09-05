<?php
require_once('components/header.php');
require_once('components/menu-lateral.php');
?>

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
