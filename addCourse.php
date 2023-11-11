<?php session_start(); ?>

<?php include('includes/header_inicio.php'); ?>


<link rel="stylesheet" href="estilos/index.css">
<link rel="stylesheet" href="estilos/register.css">
<link rel="stylesheet" href="estilos/addCourse.css">

<link rel="stylesheet" href="estilos/index.css">
<link rel="stylesheet" href="estilos/register.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<?php
require_once 'includes/alert.php';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    $alerta = new alerta("Error", $error);
    $alerta->informar_error();
} elseif (isset($_SESSION['success'])) {
    $agregado = $_SESSION['success'];
    unset($_SESSION['success']);
    $alerta = new alerta("Exito", $agregado);
    $alerta->informar_approv();
} elseif (isset($_SESSION['dbError'])){
    $dbError = $_SESSION['dbError'];
    unset($_SESSION['dbError']);
    $alerta = new alerta("Error", $dbError);
    $alerta->informar_error();
}
?>

<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="custom-form card">
                <div class="card-header">
                    <h1 class="text-center">AGREGAR CURSO</h1>
                </div>
                <div class="card-body">
                    <form action="includes/mysql/mysqlAddCourse.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre del Curso:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Curso">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del Curso:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Descripción del Curso"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen del Curso:</label>
                            <input type="text" class="form-control" name="imagen" id="imagen" placeholder="Imagen del Curso">
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración del Curso:</label>
                            <input type="text" class="form-control" name="duracion" id="duracion" placeholder="Duración del Curso">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Agregar Curso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<?php include('includes/footer.php'); ?>