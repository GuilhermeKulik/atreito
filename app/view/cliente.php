<?php 
require_once __DIR__ . '/../../app/views/components/header.php';
require_once __DIR__ . '/../../app/views/components/menu-lateral.php';
require_once __DIR__ . '/../../app/controllers/ClienteController.php';

$clienteController = new ClienteController();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteController->addCliente();
}

// Pega o erro da url via get
$m = isset($_GET['m']) ? urldecode($_GET['m']) : null;
$alertClass = isset($_GET['a']) ? urldecode($_GET['a']) : null;

?>

            
            <form id="clienteForm" class="p-4 border rounded needs-validation" novalidate method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome*</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail*</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular* (DDD + NÚMERO)</label>
                    <input type="tel" class="form-control" id="celular" name="celular" pattern="[0-9]{2} [0-9]{2} [0-9]{9}" placeholder="XXXXXXXXXXX">
                </div>
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco">
                </div>
                <div class="mb-3">
                    <label for="endereco_numero" class="form-label">Número</label>
                    <input type="number" class="form-control" id="endereco_numero" name="endereco_numero">
                </div>
                <div class="mb-3">
                    <label for="endereco_complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="endereco_complemento" name="endereco_complemento">
                </div>
                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro">
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Gênero</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                </div>
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </form>
        </div>
    </div>
</body>
</html>
