<?php
require_once("../model/Connection.php");
require_once("../model/EmployeeRestrinction.php");
$json = file_get_contents("php://input");
/**if something else is wrong, employee has been modified to private field to public */
$jsonObject = json_decode($json);
$conn= new Connection();
$employee= $conn->getIncidents($jsonObject->tarjet_number);
if($employee != null){
    http_response_code(202);
    print_r( json_encode($employee));
}else{
        http_response_code(404);
        print_r(json_encode(array(
            'status'=>404,
            "message"=> "El empleado no existe"
        )));
    }
?>