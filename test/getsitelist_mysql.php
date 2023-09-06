
<?php
$conn = new mysqli("localhost","root","","SWEAT");

$p_list="";
$sql = "SELECT * FROM program;";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
	$array="";
	$modules=json_decode($row["modules"]);
	$nb=count($modules);
	for($i=0;$i<$nb;$i++){
		$array.='"'.$modules[$i]->module.'"';
		if($i+1<$nb){
			$array.=",";
		}
	}
	$p_list.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='clean();add([".'"'.$row['name'].'",'.$array."])' >".$row['name']."</button>";
}

$list="";
$y1="";
$y2="";
$y3="";
$y4="";


$sql = "SELECT code FROM module;";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	
	if($row['code'][-3]==1){
		$y1.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='add(".'"'.$row['code'].'"'.")' >".$row['code']."</button>";
	}else if($row['code'][-3]==2){
		$y2.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='add(".'"'.$row['code'].'"'.")' >".$row['code']."</button>";
	}else if($row['code'][-3]==3){
		$y3.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='add(".'"'.$row['code'].'"'.")' >".$row['code']."</button>";
	}else if($row['code'][-3]==4){
		$y4.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='add(".'"'.$row['code'].'"'.")' >".$row['code']."</button>";
	}
}
	$list.="<p style='border-bottom:1px solid #1E1E1E;width:200px;'><strong>Year 1</strong></p>".$y1;
	$list.="<p style='border-bottom:1px solid #1E1E1E;width:200px;'><strong>Year 2</strong></p>".$y2;
	$list.="<p style='border-bottom:1px solid #1E1E1E;width:200px;'><strong>Year 3</strong></p>".$y3;
	$list.="<p style='border-bottom:1px solid #1E1E1E;width:200px;'><strong>Master</strong></p>".$y4;

echo "<p style='border-bottom:1px solid #1E1E1E;'><strong>Program</strong></p>".$p_list."<p style='border-bottom:1px solid #1E1E1E;'><strong>Modules</strong></p>".$list."<br><br>";

$conn->close();
?>