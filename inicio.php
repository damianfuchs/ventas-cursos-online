<?php session_start(); ?>

<?php
if(isset($_SESSION['username']) && isset($_SESSION['op'])){
    include('includes/header_inicio.php');
} else{
    include('includes/header_usuario.php');
}
?>
<link rel="stylesheet" href="./estilos/index.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php
if(!isset($_SESSION['username'])){
    $_SESSION['not_signed_title'] = "Error";
    $_SESSION['not_signed'] = "Debe iniciar sesión.";
    header('Location: index.php');
} else if(isset($_SESSION['op_error'])){
    $op_error_title = $_SESSION['op_error_title'];
    $op_error = $_SESSION['op_error'];
    unset($_SESSION['op_error_title']);
    unset($_SESSION['op_error']);
    $alerta = new alerta($op_error_title, $op_error);
    $alerta->informar_error();
} else if(isset($_SESSION['unexpected_error'])){
    $unexpected_error_title = $_SESSION['unexpected_error_title'];
    $unexpected_error = $_SESSION['unexpected_error'];
    unset($_SESSION['unexpected_error_title']);
    unset($_SESSION['unexpected_error']);
    $alerta = new alerta($unexpected_error_title, $unexpected_error);
    $alerta->informar_error();
}
?>

<link rel="stylesheet" href="./estilos/inicio.css">

<body class="d-flex flex-column min-vh-100">
<div class="title-container">


<div class="contenedorInicio">
    <img class="avatar"src="./imagenes/logo.png" alt="logo">
    <h1 class="title">Bienvenido a Cursos Online</h1><br><br>
    <p>¡Bienvenido a nuestra plataforma de cursos en línea, donde el aprendizaje se encuentra al alcance de tu mano!</p><br>

    <p>¡Explora nuestro portal de aprendizaje de programación y desbloquea un mundo de posibilidades! Ya seas principiante o experimentado, ofrecemos cursos que se adaptan a tus 
    necesidades, cubriendo desde Python hasta JavaScript y más. Nuestros instructores expertos te guiarán a través de lecciones prácticas y proyectos emocionantes. Únete a 
    nuestra comunidad colaborativa y comienza tu viaje hacia el dominio de la programación. ¡Prepárate para escribir el código de tu éxito! ¡Comienza hoy mismo!</p><br>
    
    <form action="cart.php" method="post">
        <input type="submit" value="Ver Cursos!" formaction="cart.php">
    </form>

</div>





</div>
</body>

<?php include('includes/footer.php'); ?>