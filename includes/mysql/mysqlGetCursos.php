<?php
require_once 'conexionDB.php';
ini_set('display_errors', 1);

function consultarCursos() {
    if(!empty($_SESSION)){
        if(isset($_SESSION['op'])){
            $con = new connect('localhost','root','','TPPA');
            try{
                $dbConnection = $con->conectar();
            } catch (Exception $e){
                $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
                $_SESSION['unexpected_error']="Intente mas tarde.";
                header('Location: ../../inicio.php');
            }
            $sql = "SELECT * FROM cursos";
            $result = $dbConnection->query($sql);

            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        } else {
            $_SESSION['op_error_title'] = "Error";
            $_SESSION['op_error'] = "No tienes permiso de administrador.";
            header('Location: ../../inicio.php');
        }
    }
}


?>