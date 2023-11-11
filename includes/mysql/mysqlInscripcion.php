<?php
require_once 'conexionDB.php';
ini_set('display_errors', 1); 
session_start();

if(!empty($_POST) && !empty($_SESSION)){
    $con = new connect('localhost','root','','TPPA');
    try{
        $dbConnection = $con->conectar();
    } catch (Exception $e){
        $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
        $_SESSION['unexpected_error']="Intente mas tarde.";
        header('Location: ../../cursos.php');
    }
    $idCurso = $_POST['idCurso'];
    $userExistente=$_SESSION['username'];
    $sqlID="SELECT id FROM usuarios WHERE username = '$userExistente'";
    $idDB=mysqli_fetch_assoc(mysqli_query($dbConnection,$sqlID));
    $stmt = $dbConnection->prepare('INSERT INTO usuarios_cursos (idUsuario, idCurso) VALUES (?, ?)');
    $stmt->bind_param('ii', $idDB['id'], $idCurso);
    $stmt->execute();
    $stmt->close();
    echo "Inscripto con exito!";
}

?>