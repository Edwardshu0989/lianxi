<?php  
    require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    $pdo=new pdo('mysql:host=127.0.0.1;dbname=else',"root","root");
    $data=$pdo->query("select * from tp_excel")->fetchAll(PDO::FETCH_ASSOC);
    $spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()
    ->fromArray(
        $data,  // The data to set
        NULL,        // Array values with this value will not be set
        'C3'         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );
    $writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');