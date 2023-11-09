function validarContraseñas() {
    var contraseña1 = document.getElementById("password").value;
    var contraseña2 = document.getElementById("confirmPassword").value;
  
    if (contraseña1 === contraseña2) {
        $('#confirmPassword').tooltip('hide');
      } else {
        $('#confirmPassword').tooltip('enable').tooltip('show');
      }
  }
  
  function validarEnTiempoReal() {
    validarContraseñas();
  }

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({ trigger: 'manual' });
  });