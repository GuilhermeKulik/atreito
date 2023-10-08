<?php

// iniciando a sessao
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'vendor/autoload.php'; // Seu arquivo de carregamento automático ou qualquer configuração inicial necessária

use Atreito\Core\Router\Router;

$router = new Router();
$router->dispatch();  
