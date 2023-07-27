document.getElementById('userForm').addEventListener('submit', function (event) {
  event.preventDefault(); // Evita que o formulário seja enviado normalmente

  // Chamar a função para validar o telefone
  if (!validatePhone()) {
    displayError('Por favor, insira um número de telefone válido no formato brasileiro.');
    return;
  }

  // Chamar a função para verificar se as senhas correspondem
  if (!checkPasswordMatch()) {
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
      console.log('AJAX readyState:', xhr.readyState);
      console.log('AJAX status:', xhr.status);
      console.log('AJAX response:', xhr.responseText);

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

function validatePhone() {
  var phoneInput = document.getElementById('phone');
  var phoneValue = phoneInput.value;
  var phoneRegex = /^\(\d{2}\)\s?\d{4,5}-\d{4}$/;

  return phoneRegex.test(phoneValue);
}

function checkPasswordMatch() {
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;

  return password === confirmPassword;
}

document.getElementById('phone').addEventListener('input', function (event) {
  var phoneInput = event.target;
  var phoneValue = phoneInput.value;

  // Remove todos os caracteres não numéricos do valor do telefone
  phoneValue = phoneValue.replace(/\D/g, '');

  // Verifica se o valor atual já possui o formato correto (xx) xxxx-xxxx
  if (phoneValue.length >= 10) {
    // Aplica a máscara de telefone
    var formattedPhone = '(' + phoneValue.substring(0, 2) + ') ' + phoneValue.substring(2, 7) + '-' + phoneValue.substring(7, 11);

    // Atualiza o valor do campo de telefone com a máscara
    phoneInput.value = formattedPhone;
  }
});
