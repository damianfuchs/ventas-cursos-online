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
    $id=$_POST['id'];
    $sql = "DELETE FROM cursos WHERE id = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    $stmt->close();
  
    
}


?>