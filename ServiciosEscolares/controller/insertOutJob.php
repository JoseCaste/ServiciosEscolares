<?php
require_once("../model/Connection.php");
date_default_timezone_set('America/Mexico_city');
$timestamp= time();
$date_time = date("H:i:s", $timestamp);

$json = file_get_contents("php://input");
$tarjet_number = json_decode($json);

$conn= new Connection();

if($conn->insertOutJob($tarjet_number->tarjet_number,$date_time)){
    http_response_code(200);
    print_r(json_encode(array(
        'status'=>200,
        "message"=> "Salida del trabajo registrada"
    )));
}else{
    http_response_code(400);
    print_r(json_encode(array(
        'status'=>400,
        "message"=> "Algo ocurrió en el proceso"
    )));
}