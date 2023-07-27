// validation.js
function validatePhone(phoneValue) {
    var phoneRegex = /^\(\d{2}\)\s?\d{4,5}-\d{4}$/;
    return phoneRegex.test(phoneValue);
  }
  
  function checkPasswordMatch(password, confirmPassword) {
    return password === confirmPassword;
  }
  