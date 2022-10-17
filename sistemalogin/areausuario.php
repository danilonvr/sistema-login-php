<?php
    session_start();
    if(!isset($_SESSION['ID_USUARIO']))
    {
        header("location: login.php");
        exit();
    }
?>

OLÁ
<a href="sair.php">Sair</a>