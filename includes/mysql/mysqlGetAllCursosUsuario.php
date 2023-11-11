<?php
require_once 'conexionDB.php';
ini_set('display_errors', 1);

function getAllCursosUsuario(){
    $con = new connect('localhost','root','','TPPA');
        try{
            $dbConnection = $con->conectar();
        } catch (Exception $e){
            $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
            $_SESSION['unexpected_error']="Intente mas tarde.";
            header('Location: ../../misCursos.php');
        }
        $userExistente=$_SESSION['username'];
        $sqlID="SELECT id FROM usuarios WHERE username = '$userExistente'";
        $idDB=mysqli_fetch_assoc(mysqli_query($dbConnection,$sqlID));
        $idUsuario = $idDB['id'];
        $sql = "SELECT DISTINCT id, nombreCurso, descripcionCurso, duracionCurso from cursos INNER JOIN usuarios_cursos ON idUsuario = '$idUsuario'";
        $result = $dbConnection->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        $dbConnection->close();
        return $data;
}

?>