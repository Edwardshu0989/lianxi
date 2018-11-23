<?php  
    require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("text.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
$row=$worksheet->getHighestRow();
$column=$worksheet->getHighestcolumn();
$dataArray = $spreadsheet->getActiveSheet()
    ->rangeToArray(
        'A1:'.$column.$row,     // The worksheet range that we want to retrieve
        NULL,        // Value that should be returned for empty cells
        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
        TRUE         // Should the array be indexed by cell row and cell column
    );
    $pdo=new pdo('mysql:host=127.0.0.1;dbname=else',"root","root");
    foreach ($dataArray as $key => $value) 
    {
        $pdo->exec("insert into tp_excel (ex_a,ex_b,ex_c,ex_d) value(".$value['A'].",".$value['B'].",".$value['C'].",".$value['D'].")");
    }