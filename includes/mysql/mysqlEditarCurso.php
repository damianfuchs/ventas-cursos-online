<?php
// Establece la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TPPA";

if(($_POST['action'] == 'edit') && !empty($_POST['id'])){ 
    $conn = new mysqli($servername, $username, $password, $dbname);
    $id = $_POST['id'];
    $nuevoNombre = $_POST['nombreCurso'];
    $nuevaDescripcion = $_POST['descripcionCurso'];
    $nuevaImagen = $_POST['imagenCurso'];
    $nuevaDuracion = $_POST['duracionCurso'];
    $sql = "UPDATE cursos SET nombreCurso=?, descripcionCurso=?, imagenCurso=?, duracionCurso=? WHERE id=?";

// Prepara la sentencia
$stmt = $conn->prepare($sql);

// Vincula los parámetros
$stmt->bind_param("sssi", $nuevoNombre, $nuevaDescripcion, $nuevaImagen, $nuevaDuracion, $id);

// Ejecuta la sentencia
if ($stmt->execute()) {
    echo "Actualización exitosa";
} else {
    echo "Error en la actualización: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
$response = array( 
    'status' => 1, 
    'msg' => 'Member data has been updated successfully.', 
    'data' => $userData 
); 
echo json_encode($response);
}



// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibe los datos del formulario (ajusta los nombres según tu formulario)


// Sentencia SQL preparada

?>