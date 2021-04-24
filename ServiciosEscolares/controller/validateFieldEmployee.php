<?php
require_once("../model/Connection.php");
$json = file_get_contents("php://input");
$jsonObject = json_decode($json);

switch ($jsonObject->field) {
    case 'txtName':
        validateEmployeeName($jsonObject->value);
        break;
    case "txtLastName":
        validateEmployeeLastName($jsonObject->value);
        break;
    case "txtEmail":
        validateEmployeeEmail($jsonObject->value);
        break;
    case "txtNumTarjet":
        validateEmployeeTarjetNumber($jsonObject->value);
        break;
    default:
        # code...
        break;
}
function validateEmployeeName($value){
    $regular_expresion = "/^[A-Za-z\\ \']+$/";
    if(!preg_match($regular_expresion,$value)){
        $return = array(
            'status' => 406,
            "message" => "El nombre no cumple con los requisitos"
        );
        http_response_code(406);
    }else{
        $return = array(
            'status' => 202,
            "message" => "ok"
        );

    }
    print_r(json_encode($return));
}
function validateEmployeeLastName($value){
    $regular_expresion = "/^[A-Za-z\\ \']+$/";
    if(!preg_match($regular_expresion,$value)){
        $return = array(
             'status' => 406,
            "message" => "El apellido no cumple con los requisitos"
        );
        http_response_code(406);
    }else{
        $return = array(
            'status' => 202,
            "message" => "ok"
        );

    }
    print_r(json_encode($return));
}
function validateEmployeeEmail($value){
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $return = array(
            'status' => 406,
            "message" => "El email no cumple con los requisitos"
        );
        http_response_code(406);
    }else{
        $return = array(
            'status' => 202,
            "message" => "ok"
        );
    }
    print_r(json_encode($return));
}
function validateEmployeeTarjetNumber($value){
    $conn=new Connection();
    if(!$conn->verifyTarjetNumber($value)){
        $return = array(
            'status' => 406,
            "message" => "El número de tarjeta ya existe"
        );
        http_response_code(406);
    }else{
        $return = array(
            'status' => 202,
            "message" => "ok"
        );
    }
    print_r(json_encode($return));
}