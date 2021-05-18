<?php
    //data to make csv (may be from database, form, etc)
    $dbdata = array(
                array("name"=>"name1", "phone"=>"1010101001"),
                array("name"=>"name2", "phone"=>"1010101002")
            );
 
    require_once("../../Classes/PHPExcel/IOFactory.php");
    require_once("../../Classes/PHPExcel.php");
    
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel(); 
    
    $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
    
    //fuente descarga libreria https://sourceforge.net/projects/tcpdf/
    // tcpdf folder
    //$rendererLibraryPath = dirname(__FILE__).'/tcpdf'; 
    $rendererLibraryPath = '../../Classes/tcpdf'; 
 
    echo $rendererLibraryPath;
    

    //setting column heading
    $objPHPExcel->getActiveSheet(0)->setCellValue('A1',"Name"); 
    $objPHPExcel->getActiveSheet(0)->setCellValue('B1',"Phone"); 
    
    //setting column body
    $i=2; //starting from row 2 bcz row 1 set to header
    foreach($dbdata as $data) {
        $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$i,$data['name']);
        $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$i,$data['phone']);
        $i++;
    }
    
    // Rename sheet
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
 
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
        
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
header('Content-Disposition: attachment;filename="01simple.pdf"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');
exit;
?>