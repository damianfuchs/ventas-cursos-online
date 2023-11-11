<?php
session_start();

if(!empty($_POST) && !empty($_SESSION)){
    $con = new connect('localhost','root','','TPPA');
    try{
        $dbConnection = $con->conectar();
    } catch (Exception $e){
        $_SESSION['dbError']="Error de conexion con la base de datos.";
        header('Location: ../../addCourse.php');
    }
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $duracion = $_POST['duracion'];

    $sql = "INSERT INTO cursos (nombreCurso, descripcionCurso, imagenCurso, duracionCurso) VALUES (?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sssi", $nombre, $descripcion, $imagen, $duracion);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Curso agregado con éxito.";
        } else {
            $_SESSION['error'] = "No se pudo agregar el curso. ".$stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "No se pudo agregar el curso. ".$conexion->error;
    }
    $conexion->close();
    header('Location: ../../addCourse.php');
}
?>

