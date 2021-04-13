<?php
session_start();
require_once("../model/Connection.php");
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if ($username != null && $password != null) {
    validate_admin($username, $password);
}

function validate_admin($username, $password)
{
    $conn = new Connection();
    if ($conn->getAdmin($username, $password)) {
        $_SESSION["username"]=$username;
        $_SESSION["password"]=$password;
        header("Location: http://localhost:".$_SERVER['SERVER_PORT']."/ServiciosEscolares/view/controlPanel.php");
    } else {
        $_SESSION['invalid']="Credenciales no validas";
        header("Location: http://localhost:".$_SERVER['SERVER_PORT']."/ServiciosEscolares/index.php");
    }
}
