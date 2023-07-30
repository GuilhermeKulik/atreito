<?php

// Simulando os dados do formulário
$testData = [
    'email' => 'user@example.com',
    'password' => 'senha123'
];

// Configurar os parâmetros da requisição
$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($testData),
        'timeout' => 10 // Adicione um timeout de 10 segundos
    ]
];

// Fazendo a requisição para o UserController
$context = stream_context_create($options);
$response = @file_get_contents('http://localhost:8080/app/controllers/LoginController.php', false, $context);

// Verificar se houve algum erro na requisição
if ($response === false) {
    echo 'Error: ' . error_get_last()['message'];
} else {
    // Exibindo o resultado na tela
    echo 'Response: ' . $response;
}
