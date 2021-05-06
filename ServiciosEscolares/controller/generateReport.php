<?php
require_once("../model/Connection.php");
$json = file_get_contents("php://input");
$jsonObject = json_decode($json);
$conn = new Connection();
if ($jsonObject->tarjetNumber != null) {
    if($jsonObject->init ==null && $jsonObject->end ==null){
        $array=$conn->getAllEmployeeReport($jsonObject->tarjetNumber);
    }else{
        $array = $conn->getEmployeeReportWithTarjetNumber($jsonObject->tarjetNumber, $jsonObject->init, $jsonObject->end);
    }
} else if($jsonObject->init !=null){
    $array = $conn->getEmployeeReport($jsonObject->init, $jsonObject->end);
}else{
    $array = $conn->employeesHistory();
}
if ($array != null) {
    http_response_code(200);
    print_r(json_encode(array(
        'status' => 200,
        "message" => $array
    )));
}else{
    http_response_code(404);
    print_r(json_encode(array(
        'status' => 404,
        "message" => "No hay registros para este empleado"
    )));
}
