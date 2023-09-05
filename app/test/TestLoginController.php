<?php

// Simulando os dados do formulário
$testData = [
    'email' => 'user@example.com',
    'password' => 'senha123'
];

// Fazendo a requisição para o UserController
$url = 'http://localhost:8080/app/controllers/LoginController.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Define um timeout de 10 segundos
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($testData));
$response = curl_exec($ch);

// Verificando se houve algum erro na requisição cURL
if (curl_errno($ch)) {
    echo 'Erro na requisição cURL: ' . curl_error($ch);
}

// Exibindo o resultado na tela
echo 'Response: ' . $response;

// Fechando a sessão cURL
curl_close($ch);
