<?php
require_once 'conexionDB.php';
require_once '../alert.php';
ini_set('display_errors', 1);
session_start();

if(!empty($_POST) && !empty($_SESSION))
{
    if(ctype_alnum($_POST['rand_code']) && (htmlentities($_POST['rand_code'] == $_SESSION['rand_code']))){
        $con = new connect('localhost','root','','TPPA');
        try{
            $dbConnection = $con->conectar();
        } catch (Exception $e){
            $_SESSION['unexpected_error_title']="Ocurrió un error inesperado";
            $_SESSION['unexpected_error']="Intente mas tarde.";
            header('Location: ../../index.php');
        }
        $db = $con->conectar();
        $username = stripcslashes($_POST['username']);
        $password = stripcslashes($_POST['password']);
        $userEsc = mysqli_real_escape_string($db, $username);
        $passwEsc = mysqli_real_escape_string($db, $password);

        $stmt = $db->prepare("SELECT username, password, isAdmin FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $userEsc);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($user_db, $pass_db, $isAdmin_db);

        if ($stmt->num_rows == 1){
            $stmt->fetch();
            if (password_verify($passwEsc, $pass_db)) 
            {
                $_SESSION['username'] = $_POST['username'];
                if($isAdmin_db == 1){
                    $_SESSION['op'] = 1;
                }
                header('Location: ../../inicio.php');
            } else {
                $_SESSION['wrong_credentials_title'] = "Error";
                $_SESSION['wrong_credentials'] = "Usuario y/o contraseña incorrectos.";
                header('Location: ../../index.php');
            }
        } else {
            $_SESSION['wrong_credentials_title'] = "Error";
            $_SESSION['wrong_credentials'] = "Usuario y/o contraseña incorrectos.";
            header('Location: ../../index.php');
        }
    } else {
        $_SESSION['captcha_error_title'] = "Error";
        $_SESSION['captcha_error'] = "Credenciales o captcha incorrectos.";
        header('Location: ../../index.php');
    }
}
?>