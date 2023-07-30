<?php

// Simulando os dados do formulário
$testData = [
    'email' => 'user@example.com',
    'password' => 'senha123'
];

// Fazendo a requisição para o LoginController
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/app/controllers/LoginController.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($testData));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Exibindo o resultado na tela
echo 'HTTP Code: ' . $httpCode . '<br>';
echo 'Response: ' . $response;
