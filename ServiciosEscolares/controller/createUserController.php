<?php
session_start();
require_once("../model/Connection.php");
$conn = new Connection();

$name = $_REQUEST['txtName'];
$lastname = $_REQUEST['txtLastName'];
$mail = $_REQUEST['txtEmail'];
$tarjet_number = $_REQUEST['txtNumTarjet'];

/**save data if an error exists */
$_SESSION['name'] = $name;
$_SESSION['lastname'] = $lastname;
$_SESSION['email'] = $mail;
$_SESSION['tarjet_number'] = $tarjet_number;

$regular_expresion = "/^[A-Za-z\\ \']+$/";
if($conn->verifyTarjetNumber($tarjet_number)){
    unset($_SESSION["tarjetNumberInvalid"]); //if is correct, delete error to controlPanel.php
    if (preg_match($regular_expresion, $name)) {
        unset($_SESSION["nameInvalid"]); 
        
        if (preg_match($regular_expresion, $lastname)) {
            unset($_SESSION["lastnameInvalid"]);
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                unset($_SESSION["emailInvalid"]);
                if ($conn->addEmployee($name, $lastname, $mail, $tarjet_number)) {
                    unset($_SESSION['userInvalid']);
                }
            } else {
                $_SESSION['userInvalid']="userNotValid";
                $_SESSION['emailInvalid'] = "El email no es válido";
            }
        } else {
            $_SESSION['userInvalid']="userNotValid";
            $_SESSION['lastnameInvalid'] = "El apellido no es válido";
        }
    } else {
        $_SESSION['userInvalid']="userNotValid";
        $_SESSION['nameInvalid'] = "El nombre no es válido";
    }
}else{
    $_SESSION['userInvalid']="userNotValid";
    $_SESSION['tarjetNumberInvalid']="El número de tarjeta ya existe";
}


header("Location: http://localhost:" . $_SERVER['SERVER_PORT'] . "/ServiciosEscolares/ServiciosEscolares/view/controlPanel.php");
