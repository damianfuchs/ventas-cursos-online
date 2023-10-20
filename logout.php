<?php
session_start();

if (isset($_SESSION['mensaje_exito'])){
    unset($_SESSION['mensaje_exito']);
    $_SESSION['not_logged'] = "Se ha deslogueado con éxito.";
}

header('Location: index.php');
?>