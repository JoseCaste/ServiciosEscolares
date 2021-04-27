<?php
require_once("../model/Connection.php");
$url = "./report.csv";
$conn= new Connection();
$array=$conn->getEmployeeReport($jsonObject->init,$jsonObject->end);

$file_name = basename("./report.csv"); 
  
$info = pathinfo($file_name);

/*header("Content-Description: File Transfer"); 
                header("Content-Type: application/octet-stream"); 
                header(
                "Content-Disposition: attachment; filename=\""
                . $file_name . "\""); 
                readfile ("./report.csv");*/

                $tmp = tmpfile();
                if($array!=null){
                    $temp=tmpfile();
                    //$temp=fopen("report.csv","w");
                    fputcsv($temp,array("Tarjeta","Nombre","Correo","Entrada","Comida","Regreso","Salida","Fecha"));
                    foreach ($array as $value) {
                        $fields = array(
                        $value->getTarjetNumber(),
                        $value->getName()." ".
                        $value->getLastName(),
                        $value->mail,
                        $value->InJob,
                        $value->OutEat,
                        $value->BackEat,
                        $value->OutJob,
                        $value->Date
                    );
                        fputcsv($temp, $fields);
                    }
                    echo $temp;
                }