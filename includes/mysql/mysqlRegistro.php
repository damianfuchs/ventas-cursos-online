<?php
session_start();
// Datos de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "TPPA";

// Crear una conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    $_SESSION['dbError'] = "Error de conexion con la base de datos.";
    die("Error de conexión: " . $conexion->connect_error);
    header('Location: addCourse.php');
}

// Datos que deseas insertar (escapados)
$nombre = $_POST['nombre'];
$mail = $_POST['mail'];
$contrasena = $_POST['contrasena'];
$repContrasena = $_POST['repContrasena'];

// Consulta SQL con una sentencia preparada
$sql = "INSERT INTO cursos (nombre, mail, contrasena, repContrasena) VALUES (?, ?, ?, ?)";


// Preparar la declaración
if ($stmt = $conexion->prepare($sql)) {
    // Vincular los parámetros
    $stmt->bind_param("ssis", $nombre, $descripcion, $duracion, $categoria);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['success'] = "Se ha registrado con exito!.";
    } else {
        $_SESSION['error'] = "Error al registrarse. ".$stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    $_SESSION['error'] = "No se pudo registrar. ".$conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
header('Location: ../index.php.php');
?>