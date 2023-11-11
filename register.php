<?php session_start(); ?>

<?php include('includes/header.php'); ?>

<head><title>Registrarse</title></head>

<link rel="stylesheet" href="estilos/index.css">
<link rel="stylesheet" href="estilos/register.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
require_once 'includes/alert.php';
if (isset($_SESSION['register_success'])) {
    $registered_title = $_SESSION['register_success_title'];
    $registered = $_SESSION['register_success'];
    unset($_SESSION['register_success_title']);
    unset($_SESSION['register_success']);
    $alerta = new alerta($registered_title, $registered);
    $alerta->informar_approv();
    header('refresh:5;url=index.php');
} elseif (isset($_SESSION['fields_error'])) {
    $fields_error_title = $_SESSION['fields_error_title'];
    $fields_error = $_SESSION['fields_error'];
    unset($_SESSION['fields_error_title']);
    unset($_SESSION['fields_error']);
    $alerta = new alerta($fields_error_title, $fields_error);
    $alerta->informar_error();
} elseif (isset($_SESSION['user_already_exists'])){
    $user_exists_title = $_SESSION['user_already_exists_title'];
    $user_exists = $_SESSION['user_already_exists'];
    unset($_SESSION['user_already_exists_title']);
    unset($_SESSION['user_already_exists']);
    $alerta = new alerta($user_exists_title, $user_exists);
    $alerta->informar_error();
} elseif (isset($_SESSION['unexpected_error'])){
    $unexpected_error_title = $_SESSION['unexpected_error_title'];
    $unexpected_error = $_SESSION['unexpected_error'];
    unset($_SESSION['unexpected_error_title']);
    unset($_SESSION['unexpected_error']);
    $alerta = new alerta($unexpected_error_title, $unexpected_error);
    $alerta->informar_error();
}
?>
<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
 
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="custom-card card">
            <img class="avatar"src="imagenes/logo.png" alt="logo">
                <div class="card-header">
                    <h1 class="text-center text-white">REGISTRARSE</h1>
                </div>
                <div class="card-body">
                    <form action="includes/mysql/mysqlRegistro.php" method="post">
                        <div class="form-group text-white">
                            <label for="username">Usuario:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Usuario">
                        </div>
                        <div class="form-group text-white">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group text-white">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group text-white">
                            <label for="confirmPassword">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirmar Contraseña" oninput="validarEnTiempoReal()" data-toggle="tooltip" data-placement="right" title="Las contraseñas no coinciden">
                        </div>
                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <label for="codigo">Captcha:</label>
                                <br>
                                <img src="includes/rdnimg.php" >
                                <input type="text" name="rand_code" value="" data-toggle="tooltip" data-placement="right" title="El captcha no coincide.">
                            </div>
                        </div>
                        <button onclick="validarContraseñas()" type="submit" class="c btn-outline-success">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="includes/js/registerCheckPassword.js"></script>

<?php include('includes/footer.php'); ?>