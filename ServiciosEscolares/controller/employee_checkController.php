<?php
session_start();
require_once("../model/Connection.php");
date_default_timezone_set('America/Mexico_city');
$json = file_get_contents("php://input");
$tarjet_number = json_decode($json);

$conn= new Connection();

$timestamp= time();
$date_time = date("H:i:s", $timestamp); //this time is when user puts her/his tarjet number to register
$message=$conn->setIOEmployee($tarjet_number->tarjet_number,$date_time);
if($message!=null){
    http_response_code(200);
    print_r(json_encode(array(
        'status'=>200,
        "message"=> $message
    )));
}else{
    http_response_code(400);
    print_r(json_encode(array(
        'status'=>400,
        "message"=> "Algo ocurrió en el proceso"
    )));
}
?>