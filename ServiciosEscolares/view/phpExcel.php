<?php
session_start();
require_once("../../Classes/PHPExcel.php");
require_once("../model/Connection.php");
require_once("../../Classes/PHPExcel/IOFactory.php");
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../../Classes/template.xls");
$conn = new Connection();
$objPHPExcel->getProperties()
    ->setCreator("GaryDev")
    ->setLastModifiedBy("JoseDev")
    ->setTitle("Reporte de asistencia")
    ->setSubject("Asistencia")
    ->setDescription("Documento generado para la asistencia de empleados")
    ->setKeywords("Empleados")
    ->setCategory("Reporte");
//$array = $conn->employeesHistory();
if (isset($_SESSION['tarjetNumber']) != null) {
    if (isset($_SESSION['init']) == null && isset($_SESSION['end']) == null) {
        $array = $conn->getAllEmployeeReport($_SESSION['tarjetNumber']);
    } else {
        $array = $conn->getEmployeeReportWithTarjetNumber($_SESSION['tarjetNumber'], $_SESSION['init'], $_SESSION['end']);
    }
} else if (isset($_SESSION['init']) != null) {
    $array = $conn->getEmployeeReport($_SESSION['init'], $_SESSION['end']);
} else {
    $array = $conn->employeesHistory();
}

$row = 3;
foreach ($array as $value) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$row", $value->getTarjetNumber())
        ->setCellValue("B$row", $value->getName() . " " . $value->getLastName())
        ->setCellValue("C$row", $value->mail)
        ->setCellValue("D$row", $value->InJob)
        ->setCellValue("E$row",  $value->OutEat)
        ->setCellValue("F$row", $value->BackEat)
        ->setCellValue("G$row", $value->OutJob)
        ->setCellValue("H$row", $value->Date)
        ->setCellValue("I$row", $value->comments);
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);
    $row++;
}

$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="reporte.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
