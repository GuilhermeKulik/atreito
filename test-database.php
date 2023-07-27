<?php

require_once 'app/models/User.php';

$user = new User($dbConnection);

// Teste de criação (CREATE)
$newUser = array(
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'phone' => '1234567890',
    'instagram' => 'johndoe_insta',
    'address' => '123 Main St',
    'cep' => '12345-678',
    'bairro' => 'Central',
    'houseNumber' => '456',
    'userType' => 'admin',
    'password' => 'senha123'
);

try {
    $userId = $user->createUser($newUser);
    echo '<p style="color: green;">CREATE TEST PASSED: User created successfully! ID: ' . $userId . '</p>';
} catch (Exception $e) {
    echo '<p style="color: red;">CREATE TEST FAILED: ' . $e->getMessage() . '</p>';
}

// Teste de recuperação (READ)
try {
    $retrievedUser = $user->getUserById($userId);
    echo '<p style="color: green;">READ TEST PASSED: User retrieved successfully:</p>';
    echo '<pre style="color: green;">';
    var_dump($retrievedUser);
    echo '</pre>';
} catch (Exception $e) {
    echo '<p style="color: red;">READ TEST FAILED: ' . $e->getMessage() . '</p>';
}

// Teste de atualização (UPDATE)
$updateData = array(
    'name' => 'Jane Smith',
    'email' => 'janesmith@example.com',
    'instagram' => 'janesmith_insta',
    'address' => '456 Elm St',
    'cep' => '98765-432',
    'bairro' => 'Downtown',
    'houseNumber' => '789'
);

try {
    $user->updateUser($userId, $updateData);
    echo '<p style="color: green;">UPDATE TEST PASSED: User updated successfully!</p>';
} catch (Exception $e) {
    echo '<p style="color: red;">UPDATE TEST FAILED: ' . $e->getMessage() . '</p>';
}

// Recupera os detalhes do usuário após a atualização
try {
    $retrievedUser = $user->getUserById($userId);
    echo '<p style="color: green;">User retrieved successfully after update:</p>';
    echo '<pre style="color: green;">';
    var_dump($retrievedUser);
    echo '</pre>';
} catch (Exception $e) {
    echo '<p style="color: red;">An error occurred while retrieving the updated user: ' . $e->getMessage() . '</p>';
}

// Teste de exclusão (DELETE)
try {
    $user->deleteUser($userId);
    echo '<p style="color: green;">DELETE TEST PASSED: User deleted successfully!</p>';
} catch (Exception $e) {
    echo '<p style="color: red;">DELETE TEST FAILED: ' . $e->getMessage() . '</p>';
}

// Verifica se o usuário ainda existe após a exclusão
try {
    $deletedUser = $user->getUserById($userId);
    if ($deletedUser) {
        echo '<p style="color: red;">User still exists after deletion, DELETE TEST FAILED.</p>';
    } else {
        echo '<p style="color: green;">User does not exist after deletion, DELETE TEST PASSED.</p>';
    }
} catch (Exception $e) {
    echo '<p style="color: red;">An error occurred while checking the deleted user: ' . $e->getMessage() . '</p>';
}
?>
