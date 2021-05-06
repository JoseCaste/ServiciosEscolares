<?php
session_start();
require_once("../model/Connection.php");
date_default_timezone_set('America/Mexico_city');
$json = file_get_contents("php://input");
$tarjet_number = json_decode($json);

$conn= new Connection();

$timestamp= time();
$date_time = date("H:i:s", $timestamp); //this time is when user puts her/his tarjet number to register

if($conn->employeeRestriction($tarjet_number->tarjet_number)){

    if($conn->getInJob($tarjet_number->tarjet_number,$date_time)){
        $salaryDecrementMessage=$conn->getEmployeedNotChecked($tarjet_number->tarjet_number);//this function is to check if a user has not checked any out job in his history
        http_response_code(200);
        print_r(json_encode(array(
            'status'=>200,
            "message"=> "Entrada registrada",
            "salaryDecrement"=> $salaryDecrementMessage
        )));
    }else{
        http_response_code(409);
        print_r(json_encode(array(
            'status'=>409,
            "message"=> "El usuario tiene restringida su comida. ¿Desea ingresar su salida?"
        )));
    }
    
}else{
    $message=$conn->setIOEmployee($tarjet_number->tarjet_number,$date_time);
    if($message!=null){
        $salaryDecrementMessage=$conn->getEmployeedNotChecked($tarjet_number->tarjet_number);//this function is to check if a user has not checked any out job in his history

        http_response_code(200);
        print_r(json_encode(array(
            'status'=>200,
            "message"=> $message,
            "salaryDecrement"=> $salaryDecrementMessage
        )));
    }else{
        http_response_code(400);
        print_r(json_encode(array(
            'status'=>400,
            "message"=> "Algo ocurrió en el proceso"
        )));
    }
}
