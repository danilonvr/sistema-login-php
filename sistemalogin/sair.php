<?php
session_start();
unset($_SESSION['ID_USUARIO']);
header("location: login.php");
?>