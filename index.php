<?php session_start(); ?>

<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="estilos/index.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
require_once 'includes/alert.php';
if (isset($_SESSION['wrong_credentials'])) {
  $wrong_credentials = $_SESSION['wrong_credentials'];
  unset($_SESSION['wrong_credentials']);
  $alert = new alerta($wrong_credentials);
  $alert->informar_error();
} elseif (isset($_SESSION['captcha_error'])) {
  $captcha_error = $_SESSION['captcha_error'];
  unset($_SESSION['captcha_error']);
  $alert = new alerta($captcha_error);
  $alert->informar_error();
} elseif (isset($_SESSION['not_signed'])){
  $not_signed = $_SESSION['not_signed'];
  unset($_SESSION['not_signed']);
  $alert = new alerta($not_signed);
  $alert->informar_error();
}
?>

<div class="cuadro-Login">
      <img class="avatar"src="imagenes/logo.png" alt="logo">
        <h1>ENTRAR</h1>
        <form action="includes/mysql/mysqlLogin.php" method="post">

            <label for="usuario">Usuario</label>
            <input type="text" name="username" placeholder="Ingrese su Usuario">

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Ingrese su Contraseña">

            <div class="form-row">

                  <div class="col-md-6 mb-3">
                  <label for="codigo">Captcha:</label>
                    <br>
                    <img src="includes/rdnimg.php" >
                  <input type="text" name="rand_code" value="">
                </div>
            </div>

            <input type="submit" value="Entrar">

            <a href="#">¿Has olvidado la contraseña?</a><br>
            <a href="#">Crear una Cuenta</a>
        </form>
    </div>

<?php include('includes/footer.php'); ?>