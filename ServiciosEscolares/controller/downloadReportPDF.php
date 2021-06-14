<?php
    require_once("../model/Connection.php");
    //require_once("../../ServiciosEscolares/view/");
    require_once("../../Classes/PHPExcel/IOFactory.php");
    require_once("../controller/reportOperation.php");
    $objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load("../../Classes/template.xls");
    $tarjet_number = $_GET['tarjet_number'];
    $init = $_GET['date'];
    $end = $_GET['dateEnd'];
    $jsonObject= new stdClass();
    $jsonObject->tarjetNumber=$tarjet_number;
    $jsonObject->init=$init;
    $jsonObject->end=$end;

    $conn= new Connection();
    $array = report($jsonObject);
 
    require_once("../../Classes/PHPExcel/IOFactory.php");
    require_once("../../Classes/PHPExcel.php");
    $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
    $rendererLibraryPath = '../../Classes/tcpdf'; 
    $row = 9;
    foreach ($array as $value) {
        $objPHPExcel->getActiveSheet()->getStyle("A$row:I$row")->getFont()->setSize(9);
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
    // Rename sheet
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
 
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $objPHPExcel->getActiveSheet()->removeColumn('J','K','L');
    
    $objPHPExcel->setActiveSheetIndex(0);
    $activeSheet = $objPHPExcel->getActiveSheet();
    $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setWorksheet($activeSheet);
        $activeSheet->getColumnDimension('E')->setWidth(50);
        $activeSheet->getRowDimension(2)->setRowHeight(80);
        $objDrawing->setOffsetX(10)->setOffsetY(10);
        $objDrawing->setPath('./logo_unam_.jpg');
        $objDrawing->setWidth(80)->setHeight(80);
if (!PHPExcel_Settings::setPdfRenderer(
 $rendererName,
 $rendererLibraryPath
 )) {
 die(
 'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
 '<br />' .
 'at the top of this script as appropriate for your directory structure'
 );
}
 
 
// Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="Reporte.pdf"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
?>