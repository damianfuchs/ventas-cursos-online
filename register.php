<?php session_start(); ?>

<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="estilos/index.css">
<link rel="stylesheet" href="estilos/register.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
/*if (isset($_SESSION['not_logged'])) {
    $not_logged = $_SESSION['not_logged'];
    unset($_SESSION['not_logged']);
    echo '<div class="alert alert-warning text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>'.$not_logged.'</div>';
} elseif (isset($_SESSION['mensaje_error'])) {
    $mensaje_error = $_SESSION['mensaje_error'];
    unset($_SESSION['mensaje_error']);
    echo '<div class="alert alert-danger text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>'.$mensaje_error.'</div>';
} elseif (isset($_SESSION['logged_out'])){
  $logged_out = $_SESSION['logged_out'];
  unset($_SESSION['logged_out']);
  echo '<div class="alert alert-warning text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>'.$logged_out.'</div>';
}*/
?>

<div class="container mt-5">
 
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="custom-card card">
            <img class="avatar"src="imagenes/logo.png" alt="logo">
                <div class="card-header">
                    <h1 class="text-center text-white">REGISTRARSE</h1>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group text-white">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group text-white">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group text-white">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group text-white">
                            <label for="confirmPassword">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmar Contraseña" oninput="validarEnTiempoReal()" data-toggle="tooltip" data-placement="right" title="Las contraseñas no coinciden">
                        </div>
                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <label for="codigo">Captcha:</label>
                                <br>
                                <img src="includes/rdnimg.php" >
                                <input type="text" name="rand_code" value="">
                            </div>
                        </div>
                        <button onclick="validarContraseñas()" type="button" class="c btn-outline-success">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="includes/js/registerCheckPassword.js"></script>

<?php include('includes/footer.php'); ?>