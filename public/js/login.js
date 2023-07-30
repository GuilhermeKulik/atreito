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
  fetch('/app/controllers/LoginController.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams(data)
  })
  .then(function(response) {
      if (response.ok) {
          // Redirecionar para a página principal se o login for bem-sucedido
          window.location.href = '/dashboard';
      } else {
          // Exibir mensagem de erro caso o login falhe
          displayError('Credenciais inválidas. Por favor, tente novamente.');
      }
  })
  .catch(function() {
      // Exibir mensagem de erro caso ocorra algum erro na requisição
      displayError('Erro na requisição. Por favor, tente novamente.');
  });
});

function displayError(message) {
  var errorDiv = document.getElementById('error-message');
  errorDiv.style.display = 'block';
  errorDiv.textContent = message;
}
