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
                    // Manipule erros aqui
                    alert(response.error);
                } else {
                    updateSearchResults(response);
                }
            },
            error: function(error) {
                // Aqui você pode tratar erros da requisição.
                console.error("Ocorreu um erro ao buscar usuários: ", error);
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
