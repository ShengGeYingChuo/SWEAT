<?php
$conn = new mysqli("localhost","root","","SWEAT");

$sql=$_GET["code"];
$prof=$_GET["prof"];
$cancel=$_GET["cancel"];



$result=mysqli_query($conn,$sql);
$table="";

if($cancel!=1){
	$table.="<section id='".$prof."' style=''>
	<h2 style='border-bottom:1px solid #1E1E1E;' ><strong>".$prof."</strong></h2><div style='display:flex;justify-content:right;' ><button type='button' onclick='del_prof(".'"'.$prof.'"'.")'>delete this program</button>"."<button type='button' onclick='prof_remove(".'"'.$prof.'"'.")'>hide</button></div></br>";
}

while($row=mysqli_fetch_assoc($result)){
	$table.="<table id='".$row['code']."' style='margin-left:80px;margin-right:10px;width:85%;';>
				<tr>
					<th rowspan='".(4+$row['Nb_of_Coursework'])."'>".$row['code']."</th>
					<th>name</th>
					<th>co_odinator</th>
					<th>semester</th>
					<th>credits</th>
					<th>CA"."(%)"."</th>
					<th rowspan='".(4+$row['Nb_of_Coursework'])."'>
						<button type='button' onclick='obj_remove(".'"'.$row['code'].'"'.',"'.$prof.'"'.")'>hide</button><br/>
						<button type='button' onclick='modify(".'"'.$row['code'].'"'.',"'.$prof.'"'.")'>modify</button>
					</th>
				</tr>
				<tr>
					<td>".$row['name']."</td>
					<td>".$row['co_odinator']."</td>
					<td>".$row['semester']."</td>
					<td>".$row['Credits']."</td>
					<td>".$row['CA']."%"."</td>
				</tr>";
						
	if($row['Nb_of_Coursework']==NULL){
		$table.="<tr>
					<td colspan='6'>0 coursework founded</td>
				</tr>
			</table>";
	}else{
		$table.="<tr>
					<th colspan='4'>total coursework:</th>
					<th id='nb_coursework'>".$row['Nb_of_Coursework']."</th>
				</tr>
					<th> </th>
					<th>name</th>
					<th>weitghing</th>
					<th>expect_hrs</th>
					<th>DL_Week</th>
				</tr>";
		for($i=1;$i<=$row['Nb_of_Coursework'];$i++){
		$table.="<tr>
					<td> </td>
					<td id='C".$i."_name'>".$row['C'.$i.'_name']."</td>
					<td id='C".$i."_weitghing'>".$row['C'.$i.'_weitghing']."</td>
					<td id='C".$i."_expct_hrs'>".$row['C'.$i.'_expct_hrs']."</td>
					<td id='C".$i."_DL'>".$row['C'.$i.'_DL']."</td>
				</tr>";
		}
	}
	$table.="</table><br>";
}


if($cancel!=1){
	$table.="</section>";
}

echo $table;	

$conn->close();
?>