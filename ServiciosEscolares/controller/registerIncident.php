<?php
require_once("../model/Connection.php");
$json=file_get_contents("php://input");
$jsonObject=json_decode($json);
$conn= new Connection();
date_default_timezone_set('America/Mexico_city');
$timestamp= time();
$date_time = date("Y-m-d", $timestamp); 
if($jsonObject->date > $date_time){
    http_response_code(404);
    print_r(json_encode(array(
        'status'=>406,
        "message"=> "No se permiten registrar fechas futuras"
    )));
}else{
    //verify if that date has been register
if($conn->checkIncident($jsonObject->tarjet_number, $jsonObject->date)){
    http_response_code(404);
    print_r(json_encode(array(
        'status'=>404,
        "message"=> "El empleado ya se ha registrado"
    )));
}else{
    /*http_response_code(201);
    print_r(json_encode(array(
        'status'=>201,
        "message"=> "El empleado se ha registrado"
    )));*/
    if($conn->registerIncident($jsonObject->tarjet_number,$jsonObject->explainIncidents, $jsonObject->date)){
        http_response_code(201);
        print_r(json_encode(array(
            'status'=>201,
            "message"=> "Se ha registrado la comisión"
        )));
    }
}
}

?>