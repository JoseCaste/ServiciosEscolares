<?php
session_start();
require_once("../model/Connection.php");
$conn = new Connection();
$json = file_get_contents("php://input");

$jsonObject = json_decode($json);

$name = $jsonObject->txtName;

$lastname =  $jsonObject->txtLastName;
$mail =  $jsonObject->txtEmail;
$tarjet_number =  $jsonObject->txtNumTarjet;

$regular_expresion = "/^[A-Za-z\\ \']+$/";
if ($conn->verifyTarjetNumber($tarjet_number)) {

    if (preg_match($regular_expresion, $name)) {
        if (preg_match($regular_expresion, $lastname)) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                if ($conn->addEmployee($name, $lastname, $mail, $tarjet_number)) {
                    
                    $return= array(
                        'status'=>200,
                        "message"=> "Empleado guardado"
                    );
                    http_response_code(200);
                    
                }
            } else {
                $return= array(
                    'status'=>400,
                    "message"=> "El email no es válido"
                );
                http_response_code(400);
            }
        } else {
            $return= array(
                'status'=>400,
                "message"=> "El apellido no es válido"
            );
            http_response_code(400);
        }
    } else {
        $return= array(
            'status'=>400,
            "message"=> "El nombre no es válido"
        );
        http_response_code(400);
    }
} else {
    $return= array(
        'status'=>400,
        "message"=> "El número de tarjeta ya existe"
    );
    http_response_code(400);
}
print_r(json_encode($return));

