$(document).ready(function() {
    $('#addPointsForm').on('submit', function(e) {
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

$(document).ready(function() {
    $('#consumePointsForm').on('submit', function(e) {
        e.preventDefault();
        var userId = $('#userConsumeIdentification').val();
        var points = $('#consumePoints').val();
        $.ajax({
            type: "POST",
            url: "/consume-points",
            data: { userId: userId, points: points },
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    $('#consumePointsForm')[0].reset();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Houve um erro ao processar sua solicitação.');
            }
        });
    });
});