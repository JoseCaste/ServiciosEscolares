<?php
require_once("../model/Connection.php");
function report($jsonObject)
{
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
    return $array;
}
?>