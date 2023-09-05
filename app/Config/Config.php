<?php 

// Constantes de configuração da conexão
define('DB_HOST', 'localhost');
define('DB_NAME', 'atreito');
define('DB_USER', 'root');
define('DB_PASS', '123');

// Configurações de sessão
define('SESSION_EXPIRE_TIME', 3600); // Tempo de expiração em segundos

session_set_cookie_params($expire_time);
