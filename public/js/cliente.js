document.addEventListener("DOMContentLoaded", function () {
    const celularInput = document.getElementById("celular");
  
    if (celularInput) {
      celularInput.addEventListener("input", function (event) {
        const input = event.target;
        const value = input.value.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
        const formattedValue = formatPhoneNumber(value); // Formata o número de telefone
        input.value = formattedValue;
      });
    }
  });
  
  // Função para formatar o número de telefone
  function formatPhoneNumber(value) {
    if (value.length <= 2) {
      return value;
    }
  
    if (value.length <= 7) {
      const ddd = value.substring(0, 2);
      const firstPart = value.substring(2, 7);
      return `${ddd} ${firstPart}`;
    }
  
    if (value.length <= 11) {
      const ddd = value.substring(0, 2);
      const firstPart = value.substring(2, 7);
      const secondPart = value.substring(7, 11);
      return `${ddd} ${firstPart}-${secondPart}`;
    }
  
    // Se tiver mais de 11 dígitos, retorna os primeiros 11
    return value.substring(0, 11);
  }
  