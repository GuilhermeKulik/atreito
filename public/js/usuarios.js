$(document).ready(function() {
    $('#searchForm').submit(function(event) {
        // Previne o comportamento padrão de submissão do formulário.
        event.preventDefault();

        var searchTerm = $('input[name="query"]').val();
        var selectedFilter = $('input[name="filter"]:checked').val();

        // Se o termo de pesquisa estiver vazio, não faça nada.
        if(!searchTerm) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/results-user',
            data: {
                term: searchTerm,   
                filter: selectedFilter
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    displayUserResults(response);
                }
            },
            error: function(error) {
                // tratar erros da requisição.
                console.error("Erro ao buscar usuários: ", error);
            }
        });
    });
});

function updateSearchResults(users) {
    var tableBody = $('#usersTable tbody');
    tableBody.empty(); // limpar resultados anteriores

    users.forEach(function(user) {
        var row = '<tr>' +
                    '<td>' + user.name + '</td>' +
                    '<td>' + user.email + '</td>' +
                    // Adicione outras colunas conforme necessário
                  '</tr>';
        tableBody.append(row);
    });
}

// REFRESH USERS LIST
function displayUserResults(users) {
    var resultsGrid = $('#resultsGrid');
    resultsGrid.empty(); 
    users.forEach(function(user) {
        var userRow = `
            <div class="row mb-2">
                <div class="col-md-2">${user.user_id}</div>
                <div class="col-md-2">${user.name}</div>
                <div class="col-md-3">${user.email}</div>
                <div class="col-md-2"><a href="https://wa.me/${user.mobile_number.replace(/\D/g, '')}" target="_blank">${user.mobile_number}</a></div>
                <div class="col-md-2"><a href="#" data-bs-toggle="modal" data-bs-target="#userEditModal" data-user-id="${user.user_id}"><i class="fas fa-edit"></i></a></div>
            </div>
        `;

        resultsGrid.append(userRow);
    });
}

$(document).ready(function() {
    $('#edit-user-form').on('submit', function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize(); //Serializa os dados do formulário para envio

        //Faz a requisição AJAX para a URL de edição do usuário
        $.ajax({
            type: 'POST',
            url: '/user-edit-send', // URL para onde o formulário será enviado
            data: formData, // dados do formulário serializados para envio
            dataType: 'json', // espera resposta em JSON
            success: function(response) {
                // Processa a resposta em caso de sucesso
                if (response.status === 'success') {
                    toastr.success(response.message); // Exibe uma notificação de sucesso
                    $('#userEditModal').modal('hide'); // Esconde o modal de edição
                } else {
                    toastr.error(response.message); 
                }
            },
            error: function(xhr, status, error) {
                // Processa erros na requisição AJAX
                console.error("Erro ao processar a solicitação: " + error); 
            }
        });
    });
});




$(document).ready(function() {
    // Edit user click handler
    $(document).on('click', 'a[data-bs-target="#userEditModal"]', function() {
        var userId = $(this).data('user-id');
        $.ajax({
            type: 'POST',
            url: '/get-user',
            data: { userId: userId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'error') {
                    toastr.error(response.message);
                } else {
                    var user = response.data;
                    $('#userEditModal #editName').val(user.name);
                    $('#userEditModal #editEmail').val(user.email);
                    $('#userEditModal #editPhone').val(user.mobile_number);
                    $('#userEditModal #editUserId').val(user.userId);
                    $('#userEditModal').modal('show');
                }
            },
            error: function(request, status, error) {
                toastr.error("Error: " + error);
            }
        });
    });

 

    // Confirm delete user handler
    $('#confirmDelete').click(function() {
        var userId = $(this).data('user-id');
        $.ajax({
            type: 'POST',
            url: '/delete-user',
            data: { userId: userId },
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success("Usuário excluído com sucesso.");
                    $('#userDeleteModal').modal('hide');
                    // Tenho q criar algo pra fazer refresh na page tipo:
                    // refreshUserList();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error("Erro ao excluir usuário.");
            }
        });
    });
});

function triggerDeleteUserModal(userIdFieldSelector) {
    var userId = $(userIdFieldSelector).val(); // Obtem o ID do usuário do campo oculto no modal de edição.

    // Configura o texto ou dados do usuário no modal de exclusão e abre o modal de exclusão.
    $('#userDeleteModal').find('#userInfo').html("Tem certeza que deseja excluir o usuário?");

    // Somente mostra o modal de exclusão, não esconde o modal de edição.
    $('#userDeleteModal').modal('show');
}
