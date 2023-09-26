<?php session_start(); ?>

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="./estilos/index.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
if(isset($_SESSION['mensaje_error'])){
    header('Location: index.php');
} elseif(!isset($_SESSION['mensaje_exito'])){
    $_SESSION['not_logged'] = "Debe iniciar sesión.";
    header('Location: index.php');
} elseif(isset($_SESSION['mensaje_exito'])) {
    $mensaje_exito = $_SESSION['mensaje_exito'];
    echo '<div class="alert alert-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Success:">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </svg>' . $mensaje_exito . '</div>';
}
?>

<div class="title-container">
<h1 class="title">Bienvenido al sitio</h1>
</div>

<?php include('includes/footer.php'); ?>