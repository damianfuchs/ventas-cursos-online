<?php session_start(); ?>

<?php include('includes/header_usuario.php'); ?>

<link rel="stylesheet" href="estilos/index.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
require_once 'includes/mysql/mysqlGetCursos.php';
require_once 'includes/alert.php';
// Llama a la función para obtener los datos
$data = consultarCursos();
if (isset($_SESSION['unexpected_error'])){
    $unexpected_error_title = $_SESSION['unexpected_error_title'];
    $unexpected_error = $_SESSION['unexpected_error'];
    unset($_SESSION['unexpected_error_title']);
    unset($_SESSION['unexpected_error']);
    $alert = new alerta($unexpected_error_title, $unexpected_error);
    $alert->informar_error();
} elseif (isset($_SESSION['deleted_success'])){
    $deleted_success_title = $_SESSION['deleted_success_title'];
    $deleted_success = $_SESSION['deleted_success'];
    unset($_SESSION['deleted_success_title']);
    unset($_SESSION['deleted_success']);
    $alert = new alerta($deleted_success_title, $deleted_success);
    $alert->informar_error();
}
?>
<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
    <h1 class="text-center text-white">Catálogo de Cursos</h1>

    
    
    <div class="row">
        <?php
        // Imprime los datos en la tabla
        foreach ($data as $row) {
            echo "<div class=\"row\"><div class=\"col-md-4\"><div class=\"card mb-3\">";
            echo "<img src=\"{$row['imagenCurso']}\" class=\"card-img-top img-fluid\" alt=\"Curso Python\">";
            echo "<div class=\"card-body\">";
            echo "<h5 class=\"card-title\">{$row['nombreCurso']}</h5>";
            echo "<p class=\"card-text\">{$row['descripcionCurso']}</p>";
            echo "<a href=\"#\" class=\"btn btn-primary\">Inscribirse</a>";
            echo "</div></div></div>";
        }
    ?>
    </div>
</div>
</body>

<?php include('includes/footer.php'); ?>