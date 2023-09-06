<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


$inputFileName = './SWEAT ver 0.8.xlsx';

$reader = new Xlsx();

$reader->setReadDataOnly(true);

$spreadsheet = $reader->load($inputFileName);

$sheetcount = $spreadsheet->getSheetCount();

$module='Module Profile';

for($i=0;$i<$sheetcount;$i++){
	$sheet = $spreadsheet->getSheet($i);
	if( $sheet->getCell('A1')->getValue() == $module){
		for($j=2;$j<9;$j++){
			print($sheet->getCell('A'.$j)->getValue().' ');
			print($sheet->getCell('B'.$j)->getValue());
			print('<br>');
			
		}
		print('<br>');
	}
}




// print_r($spreadsheet->getSheet(0)->getCell('B'.$j)->getValue());




?>