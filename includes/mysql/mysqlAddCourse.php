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
$descripcion = $_POST['descripcion'];
$duracion = $_POST['duracion'];
$categoria = $_POST['categoria'];

// Consulta SQL con una sentencia preparada
$sql = "INSERT INTO cursos (nombre, descripcion, duracion, categoria) VALUES (?, ?, ?, ?)";


// Preparar la declaración
if ($stmt = $conexion->prepare($sql)) {
    // Vincular los parámetros
    $stmt->bind_param("ssis", $nombre, $descripcion, $duracion, $categoria);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['success'] = "Curso agregado con éxito.";
    } else {
        $_SESSION['error'] = "No se pudo agregar el curso. ".$stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    $_SESSION['error'] = "No se pudo agregar el curso. ".$conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
header('Location: ../addCourse.php');
?>

