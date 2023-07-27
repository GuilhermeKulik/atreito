// ERROR BOX

$(document).ready(function() {
    var errorMessage = $('#error-message');
    var errorMessageText = errorMessage.text().trim(); // Obter o texto da mensagem de erro e remover espaços em branco

    // Verificar se a mensagem de erro está presente e não está vazia
    if (errorMessage.length > 0 && errorMessageText !== '') {
        errorMessage.show(); // Exibir a mensagem de erro
        setTimeout(function() {
            errorMessage.slideUp('slow'); // Ocultar a mensagem de erro após 10 segundos
        }, 10000);
    }
});

// FORMULÁRIO 

$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault(); // Evita o envio do formulário padrão

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Sucesso na resposta da requisição AJAX
                if (response.success) {
                    // Login bem-sucedido, redirecionar para a página principal (/index)
                    window.location.href = '/index';
                } else {
                    // Credenciais inválidas, exibir mensagem de erro
                    var errorMessage = response.message;
                    showErrorMessage(errorMessage);
                }
            },
            error: function() {
                // Erro na requisição AJAX
                var errorMessage = 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente mais tarde.';
                showErrorMessage(errorMessage);
            }
        });
    });

    function showErrorMessage(message) {
        var errorMessageElement = $('#error-message');
        errorMessageElement.text(message);
        errorMessageElement.show();

        // Após 10 segundos, ocultar a mensagem de erro
        setTimeout(function() {
            errorMessageElement.hide();
        }, 10000);
    }
});

