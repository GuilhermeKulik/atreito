$(document).ready(function() {

    $('#registration-form').on('submit', function(e) {
        e.preventDefault(); // Prevenir a submissão padrão do formulário

        // Validação para garantir que as senhas são iguais
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();

        if (password !== confirmPassword) {
            toastr.error('As senhas não coincidem. Por favor, tente novamente.');
            return;
        }

        // Coleta os dados do formulário
        var formData = $(this).serialize();

        // Requisição AJAX
        $.post('/admin-add-user', formData, function(response) {
            if (response.status == 'success') {  // <- Trocado 'response.success' por 'response.status'
                toastr.success("Usuário cadastrado com sucesso!");
                setTimeout(function() {
                    window.location.href = '/admin-dashboard';
                }, 2000);
            } else {
                // Exibe mensagem de erro recebida do servidor
                toastr.error(response.message);
            }
        }, 'json');
    });
});

$(document).ready(function() {
    $(".navbar .add-user-btn").click(function() {
        $("#add-user-panel").toggleClass("d-none");
    });
});
