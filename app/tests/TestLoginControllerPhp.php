<?php

// Simulando os dados do formulário
$testData = [
    'email' => 'user@example.com',
    'password' => 'senha123'
];

// Configurar os parâmetros da requisição cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/app/controllers/LoginController.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($testData));

// Executar a requisição cURL e capturar a resposta
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Verificar se houve algum erro na requisição cURL
if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Fechar a sessão cURL
curl_close($ch);

// Exibir o resultado na tela
echo 'HTTP Code: ' . $httpCode . '<br>';
echo 'Response: ' . $response;
