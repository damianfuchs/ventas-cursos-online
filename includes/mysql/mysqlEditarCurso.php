<?php
require_once 'conexionDB.php';
ini_set('display_errors', 1); 
session_start();

if(!empty($_POST) && !empty($_SESSION))
{
    $con = new connect('localhost','root','','TPPA');
    try{
        $dbConnection = $con->conectar();
    } catch (Exception $e){
        $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
        $_SESSION['unexpected_error']="Intente mas tarde.";
        header('Location: ../../register.php');
    }
    $id = $_POST['id'];
    $nuevoNombre = $_POST['nuevoCurso'];
    $nuevaDescripcion = $_POST['descripcionCurso'];
    $nuevaImagen = $_POST['imagenCurso'];
    $nuevaDuracion = $_POST['nuevaDuracion'];
    $sql = "UPDATE cursos SET nombreCurso=?, descripcionCurso=?, imagenCurso=?, duracionCurso=? WHERE id=?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param("sssii", $nuevoNombre, $nuevaDescripcion, $nuevaImagen, $nuevaDuracion, $id);

    if ($stmt->execute()) {
        echo "Actualización exitosa";
    } else {
        echo "Error en la actualización: " . $stmt->error;
    }

    $stmt->close();
  
    
}



?>