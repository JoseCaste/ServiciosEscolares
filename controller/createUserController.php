<?php
require_once("../model/Connection.php");
$conn= new Connection();

$name= $_REQUEST['txtName'];
$lastname=$_REQUEST['txtLastName'];
$mail=$_REQUEST['txtEmail'];
$tarjet_number=$_REQUEST['txtNumTarjet'];

if($conn->addEmployee($name,$lastname,$mail,$tarjet_number)){
    header("Location: http://localhost:".$_SERVER['SERVER_PORT']."/ServiciosEscolares/view/controlPanel.php");
}
