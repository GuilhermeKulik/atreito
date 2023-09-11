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
                term: searchTerm,   // Alterado para "term" para corresponder ao seu back-end
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
                // Aqui você pode tratar erros da requisição.
                console.error("Erro ao buscar usuários: ", error);
            }
        });
    });
});

function updateSearchResults(users) {
    // Supondo que você tenha uma tabela para exibir os resultados
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
    resultsGrid.empty(); // Limpa resultados anteriores
    users.forEach(function(user) {
        var userRow = `
            <div class="row mb-2">
                <div class="col-md-2">${user.name}</div>
                <div class="col-md-3">${user.email}</div>
                <div class="col-md-2"><a href="https://wa.me/${user.mobile_number.replace(/\D/g, '')}" target="_blank">${user.mobile_number}</a></div>
                <div class="col-md-2">${user.user_type}</div>
                <div class="col-md-1"><a href="#"><i class="fa fa-cogs"></i></a></div>  <!-- ícone de configurações -->
                <div class="col-md-1"><a href="#" class="text-danger"><i class="fa fa-times"></i></a></div>  <!-- ícone de "X" -->
            </div>
        `;

        resultsGrid.append(userRow);
    });
}