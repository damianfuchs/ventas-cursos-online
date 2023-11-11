<?php
require_once 'conexionDB.php';
ini_set('display_errors', 1);

if(!empty($_POST) && !empty($_SESSION)){
    if(isset($_SESSION['op'])){
        $con = new connect('localhost','root','','TPPA');
        try{
            $dbConnection = $con->conectar();
        } catch (Exception $e){
            $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
            $_SESSION['unexpected_error']="Intente mas tarde.";
            header('Location: ../../inicio.php');
        }
        $id = $_POST['id'];
        $sql = "SELECT id, nombreCurso, descripcionCurso, imagenCurso, duracionCurso FROM cursos WHERE id = ?";
        var_dump($sql);
        $stmt = $dbConnection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
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


?>