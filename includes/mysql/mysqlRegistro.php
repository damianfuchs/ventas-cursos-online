<?php
require_once 'conexionDB.php';
require_once '../alert.php';
ini_set('display_errors', 1); 
session_start();

if(!empty($_POST) && !empty($_SESSION))
{
    if($_POST['rand_code']==$_SESSION['rand_code']){
        $con = new connect('localhost','root','','TPPA');
        try{
            $dbConnection = $con->conectar();
        } catch (Exception $e){
            echo '<script language="javascript">alert('.$e.');</script>';
        }
        $userExistente=$_POST['username'];
        $exists="SELECT username FROM usuarios WHERE username = '$userExistente'";
        $user_existe=mysqli_query($dbConnection,$exists);
        if(!mysqli_fetch_assoc($user_existe) || mysqli_fetch_assoc($user_existe)!=NULL){
            if(ctype_alnum($_POST['username']) && ctype_alnum($_POST['password']) && $_POST['username']!=NULL && $_POST['password']!=NULL){
                $user = stripcslashes($_POST['username']); // Es esto necesario?
                $email = stripcslashes($_POST['email']);
                $password = stripcslashes($_POST['password']);

                $_SESSION['username'] = $user;

                $userEsc = mysqli_real_escape_string($dbConnection,$user);
                $emailEsc = mysqli_real_escape_string($dbConnection,$email);
                $passwordEsc = mysqli_real_escape_string($dbConnection,$password);

                $hash = password_hash($passwordEsc, PASSWORD_BCRYPT);

                $stmt = $dbConnection->prepare('INSERT INTO usuarios (username, email, password) VALUES ( ?, ?, ?)');
                $stmt->bind_param('sss', $userEsc, $emailEsc, $hash);
                $stmt->execute();
                $stmt->close();
                $_SESSION['register_success']="Usuario registrado correctamente.\nSeras redireccionado a la página principal.";
                header('Location: ../../register.php');
            }else{
                $_SESSION['fields_error']="Error en los datos ingresados, reviselos y vuelva a intentarlo.";
                header('Location: ../../register.php');
            }
        } else{
            $_SESSION['user_already_exists']="El usuario ya existe.";
            header('Location: ../../register.php');
        }
    }
  
    
}


?>