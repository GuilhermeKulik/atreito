<?php

require_once 'vendor/autoload.php'; // Seu arquivo de carregamento automático ou qualquer configuração inicial necessária

use Atreito\Core\Router\Router;

$router = new Router();
$router->dispatch();