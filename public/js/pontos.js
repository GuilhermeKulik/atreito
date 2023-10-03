$(document).ready(function() {
    $('#pointsForm').on('submit', function(e) {
        e.preventDefault(); // Previne a submissão padrão do formulário.
        //console.log('Form Submittion Prevented'); // Log para teste.
    
        var userId = $('input[name="userIdentification"]').val();
        var points = $('input[name="points"]').val();
    
        //console.log('UserID:', userId, 'Points:', points); // Log para teste.
    
        $.ajax({
            type: "POST",
            url: "/add-points", 
            data: { userId: userId, points: points },
            success: function(response) {
                //console.log('Success:', response); 
                // Aqui nós verificamos o status da resposta e mostramos a notificação apropriada.
                if(response.status === 'success') {
                    toastr.success(response.message); 
                    $('#pointsForm')[0].reset(); // limpa o formulário
                } else {
                    toastr.error(response.message); 
                }
            },
            error: function(error) {
                console.log('Error:', error); // Log para teste.
                toastr.error('Houve um erro ao processar sua solicitação.'); 
            }
        });
    });
});