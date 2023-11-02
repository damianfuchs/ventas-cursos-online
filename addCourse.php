<?php session_start(); ?>

<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="estilos/index.css">
<link rel="stylesheet" href="estilos/register.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<?php
/*if (isset($_SESSION['not_logged'])) {
    $not_logged = $_SESSION['not_logged'];
    unset($_SESSION['not_logged']);
    echo '<div class="alert alert-warning text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>'.$not_logged.'</div>';
} elseif (isset($_SESSION['mensaje_error'])) {
    $mensaje_error = $_SESSION['mensaje_error'];
    unset($_SESSION['mensaje_error']);
    echo '<div class="alert alert-danger text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>'.$mensaje_error.'</div>';
} elseif (isset($_SESSION['logged_out'])){
  $logged_out = $_SESSION['logged_out'];
  unset($_SESSION['logged_out']);
  echo '<div class="alert alert-warning text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>'.$logged_out.'</div>';
}*/
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="custom-form card">
                <div class="card-header">
                    <h1 class="text-center">Agregar Curso</h1>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="nombre">Nombre del Curso:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre del Curso">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del Curso:</label>
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción del Curso"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración del Curso:</label>
                            <input type="text" class="form-control" id="duracion" placeholder="Duración del Curso">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoría del Curso:</label>
                            <input type="text" class="form-control" id="categoria" placeholder="Categoría del Curso">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Agregar Curso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>