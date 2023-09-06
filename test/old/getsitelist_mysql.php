
<?php
$conn = new mysqli("localhost","root","","SWEAT");

$p_list="";
$sql = "SELECT * FROM profiles;";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
	$array="";
	for($i=1,$mod=$row["module_$i"];$i<15&&$mod!=NULL;$i++,$mod=$row["module_$i"]){
		$array.='"'.$mod.'"';
		if($mod=$row["module_".($i+1)]!=NULL){
			$array.=",";
		}
	}
	$p_list.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='clean();add([".'"'.$row['name'].'",'.$array."])' >".$row['name']."</button>";
}

$list="";
$sql = "SELECT code FROM modules;";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	$list.="<button style='margin-right:10px;background-color:white;border-bottom:1px solid #1E1E1E;' type='button' onclick='add(".'"'.$row['code'].'"'.")' >".$row['code']."</button>";
}

echo "<p style='border-bottom:1px solid #1E1E1E;'><strong>Program</strong></p>".$p_list."<p style='border-bottom:1px solid #1E1E1E;'><strong>Modules</strong></p>".$list."<br><br>";

$conn->close();
?>