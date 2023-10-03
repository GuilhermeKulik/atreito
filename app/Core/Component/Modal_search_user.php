<!-- Modal Structure -->
<div class="modal fade" id="userSearchModal" tabindex="-1" aria-labelledby="userSearchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userSearchModalLabel">Pesquisar Usuários</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Digite a pesquisa" aria-label="Pesquisar" aria-describedby="search-addon">
          <span class="input-group-text" id="search-addon"><i class="bi bi-search"></i></span>
        </div>
        <!-- Filters -->
        <div class="filter-bar mb-3">
          <label class="form-check">
            <input class="form-check-input" type="radio" name="filterOption" value="name" checked> Nome
          </label>
          <label class="form-check">
            <input class="form-check-input" type="radio" name="filterOption" value="email"> Email
          </label>
          <label class="form-check">
            <input class="form-check-input" type="radio" name="filterOption" value="cellphone"> Celular
          </label>
        </div>
        <!-- User List -->
        <div class="user-list">
          <!-- User items will be appended here dynamically -->
          <!-- Example of a user item: -->
          <!--
          <div class="user-item d-flex justify-content-between align-items-center mb-2">
            <span class="user-name">Nome do Usuário</span>
            <span class="user-email">email@dominio.com</span>
            <span class="user-cell">+55 11 98765-4321</span>
          </div>
          -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
