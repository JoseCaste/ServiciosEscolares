<?php
require_once("../model/Connection.php");
$json=file_get_contents("php://input");
$jsonObject=json_decode($json);
$conn= new Connection();
$names=explode(' ',$jsonObject->name);
if(!$jsonObject->restriction){
    if($conn->deleteEmployeeRestriction($jsonObject->tarjetNumber)){
        http_response_code(201);
        print_r(json_encode(array(
            'status'=>201,
            "message"=> "Se ha actualizado la restricción al empleado"
        )));
    }else{
        http_response_code(404);
        print_r(json_encode(array(
            'status'=>404,
            "message"=> "Algo ocurrió en el proceso"
        )));
    }
}else{
    if($conn->employeeRestriction($jsonObject->tarjetNumber)){
        if($conn->updateEmployeeRestriction($jsonObject->tarjetNumber,$jsonObject->restriction)){
            http_response_code(201);
        print_r(json_encode(array(
            'status'=>201,
            "message"=> "Se ha actualizado la restricción al empleado"
        )));
        }else{
            http_response_code(404);
        print_r(json_encode(array(
            'status'=>404,
            "message"=> "Algo ocurrió en el proceso"
        )));
        }
    }else{
        if($conn->setEmployeeRestriction($jsonObject->tarjetNumber,$names[0],$names[1],$jsonObject->date,$jsonObject->restriction)){
            http_response_code(201);
            print_r(json_encode(array(
                'status'=>201,
                "message"=> "Se ha agregado la restricción al empleado"
            )));
        }else{
            http_response_code(404);
            print_r(json_encode(array(
                'status'=>404,
                "message"=> "Algo ocurrió en el proceso"
            )));
        }
    }
    
}
