// ajax.js
document.getElementById('userForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que o formulário seja enviado normalmente
  
    // Chamar a função para validar o telefone
    var phoneInput = document.getElementById('phone');
    var phoneValue = phoneInput.value;
    if (!validatePhone(phoneValue)) {
      displayError('Por favor, insira um número de telefone válido no formato brasileiro.');
      return;
    }
  
    // Chamar a função para verificar se as senhas correspondem
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    if (!checkPasswordMatch(password, confirmPassword)) {
      displayError('As senhas digitadas não correspondem. Por favor, verifique novamente.');
      return;
    }
  
    // Se todas as validações passarem, enviar o formulário via AJAX
    var form = this;
    var formData = new FormData(form);
  
    // Fazer a requisição AJAX
    var xhr = new XMLHttpRequest();
    xhr.open(form.method, '/app/controllers/UserController.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Aqui você pode adicionar o código para tratar a resposta do servidor
          // Por exemplo, mostrar uma mensagem de sucesso, redirecionar para outra página, etc.
          if (xhr.responseText === 'success') {
            window.location.href = '/success.php';
          } else {
            displayError('Erro ao adicionar usuário. Por favor, tente novamente.');
          }
        } else {
          displayError('Erro na requisição. Por favor, tente novamente.');
        }
      }
    };
    xhr.send(formData);
  });
  
  function displayError(message) {
    var errorDiv = document.getElementById('error-message');
    errorDiv.style.display = 'block';
    errorDiv.textContent = message;
  }
  