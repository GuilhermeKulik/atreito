document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que o formulário seja enviado normalmente
  
    // Obter os valores dos campos de e-mail e senha
    var email = document.getElementById('login').value;
    var password = document.getElementById('password').value;
  
    // Montar os dados a serem enviados na requisição AJAX
    var data = {
      email: email,
      password: password
    };
  
    // Fazer a requisição AJAX
    $.ajax({
      url: '/app/controllers/LoginController.php',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function(response) {
        // Aqui você pode adicionar o código para tratar a resposta do servidor
        // Por exemplo, verificar se o login foi bem-sucedido ou exibir uma mensagem de erro
        if (response.success) {
          window.location.href = '/index';
        } else {
          displayError('Credenciais inválidas. Por favor, tente novamente.');
        }
      },
      error: function() {
        displayError('Erro na requisição. Por favor, tente novamente.');
      }
    });
  });
  
  function displayError(message) {
    var errorDiv = document.getElementById('error-message');
    errorDiv.style.display = 'block';
    errorDiv.textContent = message;
  }
  