<?php

$conn = new mysqli("localhost","root","","SWEAT");

$modules=$_GET['modules'];

if($modules==0){
	$sql= "SELECT code,Nb_of_Coursework,Course_work from module";
}else{
	$modules=json_decode($modules);
	$sql= "SELECT code,Nb_of_Coursework,Course_work from module WHERE";
	for($i=0;$i<count($modules);$i++){
		$sql.=" code=".'"'.$modules[$i].'"';
		if($i+1<count($modules)){
			$sql.=" OR";
		}
	}
	
}


$start_date = new DateTime('2023-09-27');

$result=mysqli_query($conn,$sql);



$table = "<table style='margin-left:20px;margin-bottom:50px;margin-right:10px;width:90%'>
			<thead>
				<tr style='border:solid;'><th></th><th colspan='15'><h2>Coursework Calendar<h2><th></tr>
				<tr style='border:solid;'><th> </th><th>week 1</th><th>week 2</th><th>week 3</th><th>week 4</th><th>week 5</th><th>week 6</th><th>week 7</th><th>week 8</th><th>week 9</th><th>week 10</th><th>week 11</th><th>week 12</th><th>week 13</th><th>week 14</th><th>week 15</th></tr>
			</thead>
			<tbody>";

while($row=mysqli_fetch_assoc($result)){
	$table .= "<tr><td rowspan='2' style='border:solid; background-color:rgb(180,180,180);'>".$row['code']."</td>";
	$cs = json_decode($row['Course_work']);
	$ndl_a= array();
	$ndl_b= array();
	
	#get all cs group a
	for($i=0;$i<$row['Nb_of_Coursework'];$i++){
		if(isset($cs[$i]->DL_A) && !empty($cs[$i]->DL_A)){
			if(gettype($cs[$i]->DL_A)=="string"){
				$diff = $start_date->diff(new DateTime($cs[$i]->DL_A));
				$weeks = floor($diff->days / 7);
				array_push($ndl_a,$weeks);
			}else{
				array_push($ndl_a,$cs[$i]->DL_A);
			}
		}
		
	}
	for($i=1;$i<16;$i++){
		if(in_array($i,$ndl_a)){
			$table.="<td style='border:solid; background-color:rgb(210,210,210);'>";
			for($j=0;$j<count($ndl_a);$j++){
				if($ndl_a[$j]==$i){
					$table.="<p>".$cs[$j]->name."</p>";
				}
			}
			$table.="</td>";
			
		}else{
			$table.="<td style='border:solid;'></td>";
		}
	}
	
	
	$table.="</tr><tr>";
	
	
	
	#get all cs group b
	for($i=0;$i<$row['Nb_of_Coursework'];$i++){ 
		if(isset($cs[$i]->DL_B) && !empty($cs[$i]->DL_B)){
			if(gettype($cs[$i]->DL_B)=="string"){
				$diff = $start_date->diff(new DateTime($cs[$i]->DL_B));
				$weeks = floor($diff->days / 7);
				array_push($ndl_b,$weeks);
			}else{
				array_push($ndl_b,$cs[$i]->DL_B);
			}
		}
	}
	for($i=1;$i<16;$i++){
		if(in_array($i,$ndl_b)){
			$table.="<td style='border:solid; background-color:rgb(210,210,210);'>";
			for($j=0;$j<count($ndl_b);$j++){
				if($ndl_b[$j]==$i){
					$table.="<p>".$cs[$j]->name."</p>";
				}
			}
			$table.="</td>";
		}else{
			$table.="<td style='border:solid;'></td>";
		}
	}
	
	
	$table.="</tr>";
}

$table.="</tbody></table>";

echo $table;








?>