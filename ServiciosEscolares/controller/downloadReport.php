<?php
require_once("../model/Connection.php");
$conn = new Connection();
$json = file_get_contents("php://input");
$jsonObject = json_decode($json);
if ($jsonObject->tarjetNumber != null) {
    $array = $conn->getEmployeeReportWithTarjetNumber($jsonObject->tarjetNumber, $jsonObject->init, $jsonObject->end);
} else {
    $array = $conn->getEmployeeReport($jsonObject->init, $jsonObject->end);
}
if ($array != null) {
    
    $fiveMBs = 5 * 1024 * 1024;
    $fp = fopen("php://temp/maxmemory:$fiveMBs", 'r+');
    fputcsv($fp, array("Tarjeta", "Nombre", "Correo", "Entrada", "Comida", "Regreso", "Salida", "Fecha"));
    foreach ($array as $value) {
        $fields = array(
            $value->getTarjetNumber(),
            $value->getName() . " " .
                $value->getLastName(),
            $value->mail,
            $value->InJob,
            $value->OutEat,
            $value->BackEat,
            $value->OutJob,
            $value->Date
        );
        fputcsv($fp, $fields);
    }
    rewind($fp);
http_response_code(200);
print_r(json_encode(array(
    'status'=>200,
    "message"=> stream_get_contents($fp)
)));
}else{
    http_response_code(404);
    print_r(json_encode(array(
        'status' => 404,
        "message" => "No hay registros para este empleado"
    )));
}

//echo stream_get_contents($fp);
