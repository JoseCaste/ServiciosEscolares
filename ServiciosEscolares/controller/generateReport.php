<?php
require_once("./reportOperation.php");
$json = file_get_contents("php://input");
$jsonObject = json_decode($json);
$array=report($jsonObject);
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
        "message" => "No hay registros"
    )));
}
