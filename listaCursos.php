<?php session_start(); ?>

<?php include('includes/header_inicio.php'); ?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" href='estilos/listaCursos.css'>

<head><title>Panel de Cursos</title></head>

<?php

require_once 'includes/mysql/mysqlGetCursos.php';
require_once 'includes/alert.php';
// Llama a la función para obtener los datos
$data = consultarCursos();
if(!isset($_SESSION['username'])){
    $_SESSION['not_signed_title'] = "Error";
    $_SESSION['not_signed'] = "Debe iniciar sesión.";
    header('Location: index.php');
}elseif(!isset($_SESSION['op'])){
    $_SESSION['op_error_title'] = "Error";
    $_SESSION['op_error'] = "No posee permisos.";
    header('Location: inicio.php');
} elseif (isset($_SESSION['unexpected_error'])){
    $unexpected_error_title = $_SESSION['unexpected_error_title'];
    $unexpected_error = $_SESSION['unexpected_error'];
    unset($_SESSION['unexpected_error_title']);
    unset($_SESSION['unexpected_error']);
    $alert = new alerta($unexpected_error_title, $unexpected_error);
    $alert->informar_error();
} elseif (isset($_SESSION['deleted_success'])){
    $deleted_success_title = $_SESSION['deleted_success_title'];
    $deleted_success = $_SESSION['deleted_success'];
    unset($_SESSION['deleted_success_title']);
    unset($_SESSION['deleted_success']);
    $alert = new alerta($deleted_success_title, $deleted_success);
    $alert->informar_error();
}


?>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>DataTables.js</title>
        <!-- Bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
        <!-- DataTable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <!-- Custom CSS -->
        <link rel="stylesheet" href='estilos/listaCursos.css'>
    </head>
    <body>
        <div class="container my-4">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <table id="tableCursos" class="table table-striped">
                        <caption>
                            Lista de Cursos
                        </caption>
                        <thead>
                            <tr>
                                <th class="centered">ID</th>
                                <th class="centered">Nombre</th>
                                <th class="centered">Descripcion</th>
                                <th class="centered">Link Imagen</th>
                                <th class="centered">Duracion</th>
                                <th class="centered">Modificar</th>
                                <th class="centered">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Imprime los datos en la tabla
                                foreach ($data as $row) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['nombreCurso']}</td>";
                                    echo "<td>{$row['descripcionCurso']}</td>";
                                    echo "<td>{$row['imagenCurso']}</td>";
                                    echo "<td>{$row['duracionCurso']} horas</td>";
                                    // Agrega más columnas según tus necesidades
                                    echo "<td>";
                                    echo "<button class=\"editar btn btn-sm btn-primary\" data-id='{$row['id']}'><i class=\"fa-solid fa-pencil\"></i></button>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<button class=\"eliminar btn btn-sm btn-danger\" data-id='{$row['id']}'><i class=\"fa-solid fa-trash-can\"></i></button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            <form action="addCourse.php" method="post">
                <!-- Tus otros campos del formulario pueden ir aquí -->

                <input type="submit" value="Agregar Curso" formaction="addCourse.php">
            </form>

        </div>
        <!-- Bootstrap-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- DataTable -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <!-- Custom JS -->
        
    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="modalEdicionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdicionLabel">Editar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Edición -->
                <form id="formularioEdicion">
                    <div class="form-group">
                        <label for="nuevoNombreCurso">Nuevo Nombre del Curso:</label>
                        <input type="text" class="form-control" id="nuevoNombreCurso" name="nuevoNombreCurso" required>
                    </div>
                    <div class="form-group">
                        <label for="nuevaDescripcionCurso">Nueva Descripcion del Curso:</label>
                        <input type="text" class="form-control" id="nuevaDescripcionCurso" name="nuevaDescripcionCurso" required>
                    </div>
                    <div class="form-group">
                        <label for="nuevaImagenCurso">Nueva Imagen del Curso:</label>
                        <input type="text" class="form-control" id="nuevaImagenCurso" name="nuevaImagenCurso" required>
                    </div>
                    <div class="form-group">
                        <label for="nuevaDuracionCurso">Nueva Duracion del Curso:</label>
                        <input type="text" class="form-control" id="nuevaDuracionCurso" name="nuevaDuracionCurso" required>
                    </div>
                    <!-- Agrega más campos según sea necesario -->
                    <input type="hidden" id="cursoId" name="cursoId">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
    </body>
</html>

<script>
    $(document).ready(function () {
        

        $('table').on('click', '.eliminar', function () {
            var id = $(this).attr('data-id');
            console.log(id);
            eliminarCurso(id);
        });

        $('table').on('click', '.editar', function () {
            var id = $(this).attr('data-id');
            console.log(id);
            cargarDatosEdicion(id);
            abrirFormularioEdicion(id);
        });

        $('#formularioEdicion').submit(function (e) {
            e.preventDefault();
            var id = $('#cursoId').val();
            var nombreNuevo = $('#nuevoNombreCurso').val();
            var descNueva = $('#nuevaDescripcionCurso').val();
            var imgNueva = $('#nuevaImagenCurso').val();
            var durNueva = $('#nuevaDuracionCurso').val();
            actualizarCurso(id, nuevoNombreCurso);
        });

        function abrirFormularioEdicion(id) {
            // Puedes cargar los datos actuales del curso en el formulario aquí
            // En este ejemplo, simplemente establecemos el ID del curso en un campo oculto
            $('#cursoId').val(id);
            // Abre el modal de edición
            $('#modalEdicion').modal('show');
        }

        function actualizarCurso(id, nuevoNombreCurso) {
            // Lógica para enviar la solicitud AJAX de actualización
            $.ajax({
                url: 'editar_curso.php',
                method: 'POST',
                data: { 'id': id, 'nuevo_nombre_curso': nuevoNombreCurso },
                success: function (response) {
                    console.log(response);
                    Swal.fire({
                        title: "Exito",
                        text: response,
                        icon: "success"
                    });
                    // Actualiza la tabla después de la edición
                    // Cierra el formulario de edición (modal)
                    $('#modalEdicion').modal('hide');
                    location.reload(true);
                },
                error: function (error) {
                    Swal.fire({
                        title: "Error en la solicitud AJAX",
                        text: error,
                        icon: "error"
                    });
                }
            });
        }

        function eliminarCurso(id) {
            $.ajax({
                url: 'includes/mysql/mysqlEliminarCurso.php', // Archivo PHP que manejará la eliminación
                method: 'POST',
                data: { 'id': id },
                success: function (response) {
                    // Maneja la respuesta del servidor si es necesario
                    Swal.fire({
                        title: "Error",
                        text: response,
                        icon: "success"
                    });
                    // Actualiza la tabla si es necesario
                    setTimeout(function(){ window.location.reload(true); }, 5000);
                },
                error: function (error) {
                    Swal.fire({
                        title: "Error en la solicitud AJAX",
                        text: error,
                        icon: "error"
                    });
                }
            });
        }

        function cargarDatosEdicion(id) {
            console.log(id);
            // Realizar una llamada AJAX para obtener los datos del curso
            $.ajax({
                url: 'includes/mysql/mysqlGetCurso.php', // Cambia esto al script que obtiene los datos del curso por ID
                method: 'POST',
                data: { 'id': id },
                success: function (data) {
                    console.log(data);
                   // Llenar el formulario con los datos obtenidos
                    $('#cursoId').val(data.id);
                    $('#nuevoNombreCurso').val(data.nombreCurso);
                    $('#nuevaDescripcionCurso').val(data.descripcionCurso);
                    $('#nuevaImagenCurso').val(data.imagenCurso);
                    $('#nuevaDuracionCurso').val(data.duracionCurso);
                    // Puedes agregar más campos según sea necesario
                },
                error: function (error) {
                    console.error('Error al cargar datos de edición', error);
                }
            });
        }
    });
</script>

<?php include('includes/footer.php'); ?>
<?php

