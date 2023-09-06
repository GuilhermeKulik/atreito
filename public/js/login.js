$(document).ready(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault(); // Prevenir a submissão padrão do formulário

        // Coleta os dados do formulário
        var formData = $(this).serialize();

        // Requisição AJAX
        $.post('/login-ajax', formData, function(response) {
            if (response.success) {
                toastr.success("Login bem-sucedido!");
                setTimeout(function() {
                    window.location.href = '/dashboard';
                }, 2000);
            } else {
                // Exibe mensagem de erro recebida do servidor
                toastr.error(response.message);
            }
        }, 'json');
    });
});