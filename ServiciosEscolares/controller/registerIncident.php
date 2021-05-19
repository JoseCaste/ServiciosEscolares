<?php
require_once("../model/Connection.php");
$json=file_get_contents("php://input");
$jsonObject=json_decode($json);
$conn= new Connection();
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
?>