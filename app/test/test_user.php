<?php

require_once __DIR__ . '/../../app/model/GenericModel.php';
require_once __DIR__ . '/../../app/model/User.php';
require_once __DIR__ . '/../../app/config/DBConnection.php';

// Conexão
$dbInstance = new DBConnection();
$conn = $dbInstance->getConnection();

// Instanciação dos modelos
$genericModel = new GenericModel($conn);

// Função de teste
function test($description, $condition, $errorMsg = null) {
    echo $description;
    if ($condition) {
        echo " - <span style='color:green;'>OK</span><br>";
    } else {
        echo " - <span style='color:red;'>ERRO</span>";
        if ($errorMsg) {
            echo " (Detalhes: $errorMsg)";
        }
        echo "<br>";
    }
}
echo "<h1>Testes Model</h1>";

// Testes
echo "<h3>Testes User</h3>";
// 1. Inserção de um novo usuário
$user = new User($conn, 'johndoe@example.com' . rand(1,9999), 'password123', 'John Doe');

$newUserId = $user->createUser();

test('Teste de inserção', $newUserId !== false, "Falha ao inserir usuário. ID não foi retornado.");

$user = $user->getUserById($newUserId);
test('Teste de busca por ID', $user !== false && $user->getName() == 'John Doe', "Falha ao buscar usuário pelo ID. Usuário não encontrado ou nome incorreto.");

$updated = $user->updateUser($newUserId, ['name' => 'Johnny']);
test('Teste de atualização', $updated == 1, "Falha ao atualizar usuário.");

$users = $user->getAllUsers();
test('Teste de listagem', is_array($users) && count($users) > 0, "Falha ao listar usuários.");

$deleted = $user->deleteUser($newUserId);
test('Teste de exclusão', is_numeric($deleted), "Falha ao excluir usuário.");

// Fechando conexão
$conn = null;
