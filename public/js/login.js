$(document).ready(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault(); // Prevenir a submissão padrão do formulário
        
        // Coleta os dados do formulário
        var formData = $(this).serialize();
        
        // Requisição AJAX
        $.post('/login-ajax', formData, function(response) {
            if (response.success) {
                window.location.href = '/dashboard';
            } else {
                // Exibe mensagem de erro (você pode ajustar a forma como a mensagem é exibida)
                alert(response.message);
            }
        }, 'json');
    });
});