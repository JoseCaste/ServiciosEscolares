<?php
//in to job at 9 am to 14
//out to eat at 14 to 15
//out to job at 17
session_start();
require_once("../model/Connection.php");
date_default_timezone_set('America/Mexico_city');
$json = file_get_contents("php://input");
$tarjet_number = json_decode($json);

$in= '13:59:59';
$out_eat='15:00:00';
$out_to_job='19:00:00';

$conn= new Connection();

$timestamp= time();
$date_time = date("H:i:s", $timestamp); //this time is when user puts her/his tarjet number to register


if($date_time<= date('H:i:s',strtotime($in))){
    $conn->insertInputOutput($date_time,$tarjet_number->tarjet_number,'in_job');
    http_response_code(200);
    print_r(json_encode(array(
        'status'=>200,
        "message"=> "Verificado"
    )));
}else if($date_time<= date('H:i:s',strtotime($out_eat))){
    if($conn->updateInputOutput($date_time,$tarjet_number->tarjet_number,'out_eat')){
        http_response_code(200);
        print_r(json_encode(array(
            'status'=>200,
            "message"=> "Verificado"
        )));
    }else{
        http_response_code(400);
        print_r(json_encode(array(
            'status'=>400,
            "message"=> "Algo ocurrió en el proceso"
        )));
    }
    
}else if($date_time<= date('H:i:s',strtotime($out_to_job))){
    if($conn->updateInputOutput($date_time,$tarjet_number->tarjet_number,'out_job')){
        http_response_code(200);
        print_r(json_encode(array(
            'status'=>200,
            "message"=> "Verificado"
        )));    
    }else{
        http_response_code(400);
        print_r(json_encode(array(
            'status'=>400,
            "message"=> "Algo ocurrió en el proceso"
        )));
    }
    
}
?>