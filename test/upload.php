
<?php
$dbhost ='localhost';
$dbuser ='root';
$dbpwd ='';



// connection to database
$conn = new mysqli($dbhost,$dbuser,$dbpwd);
if($conn->connect_error){
	die('connection aborted: ' .mysql_error($conn));
}else{
	echo "=======connection success.======= <br>";
}


// create a new database
	// define new database
$sql_db = "CREATE DATABASE IF NOT EXISTS SWEAT";
if($conn->query($sql_db)===TRUE){
	echo "=======create new database success.=======<br>";
}else{
	echo "create new database fail or already exist.<br>";
}

//select database
mysqli_select_db( $conn, 'SWEAT' );

// create a new module table
	// define new module table
$sql_table = "CREATE TABLE IF NOT EXISTS modules(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(7) ,
	name VARCHAR(50),
	co_odinator VARCHAR(50),
	semester INT UNSIGNED,
	Credits DOUBLE UNSIGNED ,
	CA INT UNSIGNED ,
	Nb_of_Coursework INT UNSIGNED ,
";
for($i=1;$i<10;$i++){
	$sql_table .= "
		C$i"."_name VARCHAR(50),
		C$i"."_weitghing INT,
		C$i"."_expct_hrs DOUBLE UNSIGNED,
		C$i"."_DL INT UNSIGNED
	";
	if($i<9){
		$sql_table .=",";
	}
}
$sql_table .=");";


	// set new module table
$conn->query($sql_table);
echo "=======create new module table success.=======<br>";


// create a new profile table
	// define new profile table
$sql_table = "CREATE TABLE IF NOT EXISTS profiles(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
";
for($i=1;$i<15;$i++){
	$sql_table.="module_".$i." VARCHAR(10)";
	if($i<14){
		$sql_table.=",";
	}
}
$sql_table.=");";


	// set new profile table
$conn->query($sql_table);
echo "=======create new profile table success.=======<br>";




// upload data

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


$inputFileName = './SWEAT ver 0.8.xlsx';

$reader = new Xlsx();
$reader->setReadDataOnly(true);

$spreadsheet = $reader->load($inputFileName);

$sheetcount = $spreadsheet->getSheetCount();//number of sheet

$module='Module Profile';
$semester ='Semester Profile';

$sql_data="INSERT INTO modules VALUES";

$count=0;


for($i=0;$i<$sheetcount;$i++){
	$sheet = $spreadsheet->getSheet($i);

	if( $sheet->getCell('A1')->getValue() == $module){
		$sql_data="INSERT INTO modules (code,name,co_odinator,semester,credits,CA,Nb_of_Coursework";
		
		//found real number of coursework
		$cw_nb = 0; 
		$test = $sheet->getCell('B9')->getValue();
		while($test != null){
			$cw_nb++;
			$test = $sheet->getCell('B'.(9+$cw_nb))->getValue();
		}
		
		for($j=1;$j<=$cw_nb;$j++){
			$sql_data.=",C".$j."_name,C".$j."_weitghing,C".$j."_expct_hrs,C".$j."_DL";
		}
		
		$sql_data.=") VALUES (";
		// module code
		$sql_data.='"'.$sheet->getCell('A2')->getValue();
		$sql_data.=$sheet->getCell('B2')->getValue().'"'.",";
		// module name...
		for($j=3;$j<5;$j++){
			if($sheet->getCell('B'.$j)->getValue() == null){
				$sql_data.="null";
			}else{
				$sql_data.='"'.$sheet->getCell('B'.$j)->getValue().'"';
			}
			$sql_data.=",";
		}
		for($j=5;$j<9;$j++){
			if($sheet->getCell('B'.$j)->getValue() == null){
				$sql_data.="null";
			}else{
				$sql_data.=$sheet->getCell('B'.$j)->getCalculatedValue();
			}
			if($j<8){
				$sql_data.=",";
			}
		}
		
		// component
		
		for($k=9;$k<$cw_nb+9;$k++){
			$sql_data.=",".'"'.$sheet->getCell('C'.$k)->getValue().'"';
			$sql_data.=",".$sheet->getCell('B'.$k)->getCalculatedValue();
			$sql_data .=",".((Double)$sheet->getCell('B6')->getCalculatedValue()*(Double)$sheet->getCell('B'.$k)->getCalculatedValue()/10);
			$sql_data.=",".$sheet->getCell('G'.$k)->getCalculatedValue();
		}
		$sql_data.=");";
		
		//upset data
		$conn->query($sql_data);
		$count++;
		
	}else if( $sheet->getCell('A1')->getValue() == $semester){
		$data="";
		$data.='"'.$sheet->getCell('B2')->getValue()."_Y".$sheet->getCell('B3')->getValue()."_sem".$sheet->getCell("B5")->getValue().'"';
		$code=$sheet->getCell("E3")->getValue();
		for($j=3;$code!=""&&$code!="Total";$j++,$code=$sheet->getCell("E".$j)){
			$data.=",";
			$data.='"'.$code.'"';
		}
		
		$sql_data="INSERT INTO profiles (name,";
		for($k=1;$k<=($j-3);$k++){
			$sql_data.="module_".$k;
			if($k<($j-3)){
				$sql_data.=",";
			}
		}
		$sql_data.=") VALUES (".$data.");";
		
		
		

		$conn->query($sql_data);
	}
}
echo "=======upload module data success.=======<br>";


$conn->close();
?>