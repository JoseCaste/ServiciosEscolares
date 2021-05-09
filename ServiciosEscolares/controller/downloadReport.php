<?php
session_start();
require_once("../model/Connection.php");
require_once("../../Classes/PHPExcel.php");
require_once("../../Classes/PHPExcel/IOFactory.php");
require_once("./reportOperation.php");
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../../Classes/template.xls");

$objPHPExcel->getProperties()
    ->setCreator("GaryDev")
    ->setLastModifiedBy("JoseDev")
    ->setTitle("Reporte de asistencia")
    ->setSubject("Asistencia")
    ->setDescription("Documento generado para la asistencia de empleados")
    ->setKeywords("Empleados")
    ->setCategory("Reporte");

$json = file_get_contents("php://input");
$jsonObject = json_decode($json);
$array = report($jsonObject);
if ($array != null) {
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
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

        $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));
    
        $sheet = $objPHPExcel->getActiveSheet();
        $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);
        /** @var PHPExcel_Cell $cell */
        foreach ($cellIterator as $cell) {
            $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
        }
    }
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="reporte.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    ob_start();
    $objWriter->save('php://output');
    $xlsData = ob_get_contents();
    ob_end_clean();
    http_response_code(200);
    print_r(json_encode(array(
        'status' => 200,
        "message" => "data:xls;base64," . base64_encode($xlsData)
    )));
} else {
    http_response_code(404);
    print_r(json_encode(array(
        'status' => 404,
        "message" => "No hay registros"
    )));
}
