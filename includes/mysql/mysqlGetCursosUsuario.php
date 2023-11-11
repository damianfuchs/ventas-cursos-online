<?php
require_once 'conexionDB.php';
ini_set('display_errors', 1);

function getCursosUsuario(){
    $con = new connect('localhost','root','','TPPA');
        try{
            $dbConnection = $con->conectar();
        } catch (Exception $e){
            $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
            $_SESSION['unexpected_error']="Intente mas tarde.";
            header('Location: ../../cursos.php');
        }
        $userExistente=$_SESSION['username'];
        $sqlID="SELECT id FROM usuarios WHERE username = '$userExistente'";
        $idDB=mysqli_fetch_assoc(mysqli_query($dbConnection,$sqlID));
        $idUsuario = $idDB['id'];
        $sql = "SELECT idCurso from usuarios_cursos WHERE idUsuario = '$idUsuario'";
        $result = $dbConnection->query($sql);
        $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        
        $dbConnection->close();
        return $data;
}

?>