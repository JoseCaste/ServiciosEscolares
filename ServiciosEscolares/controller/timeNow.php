<?php
date_default_timezone_set('America/Mexico_city');
$json = file_get_contents("php://input");

$in= '13:59:59';
$out_eat='15:00:00';
$out_to_job='19:00:00';
$timestamp= time();
$date_time = date("H:i:s", $timestamp); //this time is when user puts her/his tarjet number to registrer
$jsonObject = json_decode($json);

if($date_time<= date('H:i:s',strtotime($in))){
    $return= array(
        'status'=>200,
        "message"=> "¿Está registrando su horario de entrada?"
    );
    http_response_code(200);
}else if($date_time<= date('H:i:s',strtotime($out_eat))){
    $return= array(
        'status'=>200,
        "message"=> "¿Está registrando su horario de comida?"
    );
    http_response_code(200);
}else if($date_time<= date('H:i:s',strtotime($out_to_job))){
    $return= array(
        'status'=>200,
        "message"=> "¿Está registrando su horario de salida?"
    );
    http_response_code(200);   
}
print_r(json_encode($return));
