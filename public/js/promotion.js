$(document).ready(function() {
    $('#save-promotion').click(function(e) {
        e.preventDefault(); // Previne a submissão padrão do formulário.

        var promotionData = {
            name: $('#promotion-name').val(),
            value: $('#promotion-value').val(),
            expiration_date: $('#promotion-expiration').val(),
            category: $('#promotion-category').val(),
            level: $('#promotion-level').val()
        };

        $.ajax({
            type: "POST",
            url: "/promotion-add", 
            data: promotionData,
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    $('#addPromotionModal').modal('hide');
                    $('#promotion-form')[0].reset();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                var errorMsg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Houve um erro ao processar sua solicitação.';
                toastr.error(errorMsg);
            }
        });
    });
});
