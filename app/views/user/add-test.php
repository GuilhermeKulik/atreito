<?php
require_once __DIR__ . '/../../../app/controllers/UserController.php';;

$userController = new UserController();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Chama o método addUser() do UserController
    $userController->addUser();
}
?>

<!-- Formulário para adicionar usuário -->
<form action="app/views/user/add-test.php" method="POST">
  <label for="name">Nome:</label>
  <input type="text" id="name" name="name" required>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>

  <label for="userType">Tipo de usuário:</label>
  <select id="userType" name="userType" required>
    <option value="admin">Administrador</option>
    <option value="user">Usuário</option>
  </select>

  <label for="password">Senha:</label>
  <input type="password" id="password" name="password" required>

  <label for="phone">Telefone:</label>
  <input type="text" id="phone" name="phone" required>

  <label for="address">Endereço:</label>
  <input type="text" id="address" name="address" required>

  <label for="houseNumber">Número:</label>
  <input type="text" id="houseNumber" name="houseNumber" required>

  <label for="bairro">Bairro:</label>
  <input type="text" id="bairro" name="bairro" required>

  <label for="cep">CEP:</label>
  <input type="text" id="cep" name="cep" required>

  <!-- Botão de envio -->
  <input type="submit" value="Adicionar Usuário">
</form>
