<?php session_start(); ?>

<?php include('includes/header_inicio.php'); ?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" href='estilos/listaCursos.css'>

<head><title>Panel de Cursos</title></head>

<?php

require_once 'includes/mysql/mysqlGetCursos.php';
require_once 'includes/alert.php';
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
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
                                foreach ($data as $row) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['nombreCurso']}</td>";
                                    echo "<td>{$row['descripcionCurso']}</td>";
                                    echo "<td>{$row['imagenCurso']}</td>";
                                    echo "<td>{$row['duracionCurso']} horas</td>";
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
                <input type="submit" value="Agregar Curso" formaction="addCourse.php">
            </form>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        
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
                    <input type="hidden" id="cursoId" name="cursoId">
                    <button type="submit" class="guardar btn btn-primary">Guardar Cambios</button>
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

        $(".close").on('click', function() {
            $('#modalEdicion').modal('hide');
        });

        $('#formularioEdicion').submit(function (e) {
            e.preventDefault();
            var id = $('#cursoId').val();
            var nombreNuevo = $('#nuevoNombreCurso').val();
            var descNueva = $('#nuevaDescripcionCurso').val();
            var imgNueva = $('#nuevaImagenCurso').val();
            var durNueva = $('#nuevaDuracionCurso').val();
            console.log(id + " JAJASJ NDEA");
            actualizarCurso(id, nombreNuevo, descNueva, imgNueva, durNueva);
        });

        function abrirFormularioEdicion(id) {
            $('#cursoId').val(id);
            $('#modalEdicion').modal('show');
        }

        function actualizarCurso(id, nuevoNombreCurso, nuevaDescripcionCurso, nuevaImagenCurso, nuevaDuracionCurso) {
            $.ajax({
                url: 'includes/mysql/mysqlEditarCurso.php',
                method: 'POST',
                data: { 'id': id, 'nuevoCurso': nuevoNombreCurso, 'descripcionCurso': nuevaDescripcionCurso, 'imagenCurso': nuevaImagenCurso, 'nuevaDuracion': nuevaDuracionCurso },
                success: function (response) {
                    Swal.fire({
                        title: "Exito",
                        text: response,
                        icon: "success"
                    });
                    $('#modalEdicion').modal('hide');
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

        function eliminarCurso(id) {
            $.ajax({
                url: 'includes/mysql/mysqlEliminarCurso.php',
                method: 'POST',
                data: { 'id': id },
                success: function (response) {
                    Swal.fire({
                        title: "Error",
                        text: response,
                        icon: "success"
                    });
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
            $.ajax({
                url: 'includes/mysql/mysqlGetCurso.php',
                method: 'POST',
                data: { 'id': id },
                datatype: 'json',
                success: function (data) {
                    let json = JSON.parse(data);
                    $('#cursoId').val(json[0].id);
                    $('#nuevoNombreCurso').val(json[0].nombreCurso);
                    $('#nuevaDescripcionCurso').val(json[0].descripcionCurso);
                    $('#nuevaImagenCurso').val(json[0].imagenCurso);
                    $('#nuevaDuracionCurso').val(json[0].duracionCurso);
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

