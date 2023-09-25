<?php session_start(); ?>

<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
if (isset($_SESSION['mensaje_exito'])) {
    $mensaje_exito = $_SESSION['mensaje_exito'];
    unset($_SESSION['mensaje_exito']); // Borra el mensaje de éxito para que no se muestre de nuevo
    echo '<div class="alert alert-success">' . $mensaje_exito . '</div>';
} elseif (isset($_SESSION['mensaje_error'])) {
    $mensaje_error = $_SESSION['mensaje_error'];
    unset($_SESSION['mensaje_error']); // Borra el mensaje de error para que no se muestre de nuevo
    echo '<div class="alert alert-danger">'.$mensaje_error.'</div>';
}
?>


<div class="cuadro-Login">
      <img class="avatar"src="imagenes/logo.png" alt="logo">
        <h1>Login</h1>
        <form action="login.php" method="post">

            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" placeholder="Ingrese su Usuario">

            <label for="password">Contraseña</label>
            <input type="password" name="contraseña" placeholder="Ingrese su Contraseña">

            <input type="submit" value="Entrar">

            <a href="#">¿Has olvidado la contraseña?</a><br>
            <a href="#">Crear una Cuenta</a>
        </form>
    </div>

<?php include('includes/footer.php'); ?>