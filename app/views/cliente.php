
<?php 

require_once('components/header.php');
require_once('components/menu-lateral.php');

?>

            <h2>Adicionar Cliente</h2>
            <form id="clienteForm" class="p-4 border rounded needs-validation" novalidate method="POST" action="#">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="codigo_usuario" class="form-label">Código de Usuário</label>
                    <input type="text" class="form-control" id="codigo_usuario" name="codigo_usuario" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="tel" class="form-control" id="celular" name="celular" pattern="[0-9]{2} [0-9]{2} [0-9]{9}" placeholder="+55 00 000000000">
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
