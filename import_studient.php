<?php

class student{
	public $name="";
	public $actual_workload="";
}

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$inputFileName="./student data aero space 110.xlsx";

$reader = new Xlsx();
$reader->setReadDataOnly(true);

$spreadsheet = $reader->load($inputFileName);

$sheet = $spreadsheet->getSheet(0);

$cs_data=array();

// for($i=5;true;$i++){
	// $student_name = $sheet->getCell('A'.($i))->getValue();
	// if($student_name!=null){
		// $student=new student();
		// $student->actual_workload=array();
		// $student->name = $student_name;
		// for($j='B';$j<'Q';$j++){
			// Array_push($student->actual_workload,$sheet->getCell($j.$i)->getCalculatedValue());
		// }
		
		// var mode=array();
		// for($j=0;$j<50;$j++){
			
			
		// }
		
		
		// Array_push($cs_data["base"],$student);
	// }else{
		// break;
	// }
// }


for($i='B',$n=0;$i<'Q';$i++,$n++){
	$student = array();
	for($j=5;true;$j++){
		if($sheet->getCell($i.$j)->getCalculatedValue()!=""){
			Array_push($student,$sheet->getCell($i.$j)->getCalculatedValue());
		}else{
			break;
		}
	}
	Array_push($cs_data,$student);
	
	
}





echo json_encode($cs_data);


?>