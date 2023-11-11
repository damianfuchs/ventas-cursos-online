<?php
session_start();

if (isset($_SESSION['username']) || isset($_SESSION['op'])){
    unset($_SESSION['username']);
    unset($_SESSION['op']);
}

header('Location: index.php');
?>