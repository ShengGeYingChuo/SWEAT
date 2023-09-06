<?php
$conn = new mysqli("localhost","root","","SWEAT");

$sql=$_GET["code"];
$prof=$_GET["prof"];
$type=$_GET["type"];

$start_date = new DateTime('2023-09-27');


$result=mysqli_query($conn,$sql);
$table="";

if($type==0){
	$table.="<section id='".$prof."' style=''>
	<h2 style='border-bottom:1px solid #1E1E1E;' ><strong>".$prof."</strong></h2><div style='display:flex;justify-content:right;' ><button type='button' onclick='del_prof(".'"'.$prof.'"'.")'>delete this program</button>"."<button type='button' onclick='prof_remove(".'"'.$prof.'"'.")'>hide</button></div></br>";
}else if($type==1){
	$table.="<section id='s_".$prof."' style=''>
	<h2 style='border-bottom:1px solid #1E1E1E;' ><strong>".$prof."</strong></h2><div style='display:flex;justify-content:right;' ><a href='#feedback' ><button onclick='s_h_feedback()' >Feedback</button></a><button type='button' onclick='del_mod(".'"'.$prof.'"'.")'>delete this module</button>"."<button type='button' onclick='prof_remove(".'"'.$prof.'"'.")'>hide</button>"."<button type='button' onclick='load_swd(".'"'.$prof.'","'.$prof.'"'.")'>student worklord distribution</button>"."<button type='button' onclick='log(".'"'.$prof.'"'.")'>log</button></div><div id='log'></div></br>";
}

while($row=mysqli_fetch_assoc($result)){
	if($type==0 || $type==1){
		$table.="<section id='".$row['code']."'><table id='t_".$row['code']."' style='margin-left:20px;margin-bottom:50px;margin-right:10px;width:90%;';>";
	}
	$table.="	<tr>
					<th rowspan='3'>".$row['code']."</th>
					<th colspan='6'>name</th>
					<th colspan='5'>co_odinator</th>
					<th colspan='2'>semester </th>
					<th>credits</th>
					<th>CA"."(%)"."</th>
					<th rowspan='4'>
						<button type='button' onclick='obj_unshow(".'"'.$row['code'].'"'.',"'.$prof.'"'.")'>hide</button><br />
						<button id='s_h_detail' type='button' onclick='s_h_detail(".'"'.$row['code'].'"'.',"'.$prof.'"'.")'>hrs detail</button><br />
						<button type='button' onclick='modify(".'"'.$row['code'].'"'.',"'.$prof.'"'.")'>modify</button>
						
					</th>
				</tr>
				<tr>";
	if($row['name']!==null){
		$table.="<td colspan='6'>".$row['name']."</td>";
	}else{
		$table.="<td colspan='6'></td>";
	}
	
	if($row['co_odinator']!==null){
		$table.="<td colspan='5'>".$row['co_odinator']."</td>";
	}else{
		$table.="<td colspan='5'></td>";
	}
		
	if($row['semester']!==null){
		$table.="<td colspan='2'>".$row['semester']."</td>";
	}else{
		$table.="<td colspan='2'></td>";
	}
		
	if($row['Credits']!==null){
		$table.="<td>".$row['Credits']."</td>";
	}else{
		$table.="<td></td>";
	}
	
	if($row['CA']!==null){
		$table.="<td>".$row['CA']."</td>";
	}else{
		$table.="<td></td>";
	}

	$table.="</tr>";
						
	if($row['Nb_of_Coursework']==0){
		$table.="<tr>
					<th colspan='14'>total coursework:</th><th>0</th>
				</tr>";
	}else{
		$cs=json_decode($row['Course_work']);


		#检测是否有无效数据，并修复
		for($i=0;$i<sizeof($cs);$i++){ 
			if(empty($cs[$i]->name) && empty($cs[$i]->weitghing) && empty($cs[$i]->expct_hrs) && empty($cs[$i]->DL_A) && empty($cs[$i]->DL_B)){
				unset($cs[$i]);
				$i--;
			}
		}
		$row['Nb_of_Coursework']=sizeof($cs);
		if(json_encode($cs)!=$row['Course_work']){#移除无效数据
			$sql="UPDATE module SET Nb_of_Coursework='".$row['Nb_of_Coursework']."', Course_work='".json_encode($cs)."' WHERE code='".$row['code']."';";
			mysqli_query($conn,$sql);
		}
		
		$table.="<tr>
					<th colspan='14'>total coursework:</th>
					<th id='nb_coursework'>".$row['Nb_of_Coursework']."</th>
				</tr>
					<th colspan='2'>Type</th>
					<th colspan='2'>Name</th>
					<th colspan='1'>Weitghing</th>
					<th colspan='1'>Expect_hrs</th>
					<th colspan='1'>Predict_hrs</th>
					<th colspan='1'>Extra_hrs</th>
					<th colspan='2'>Start Week for A</th>
					<th colspan='2'>Deadline Week for A</th>
					<th colspan='2'>Start Week for B</th>
					<th colspan='2'>Deadline Week for B</th>
				</tr>";
				
		
		for($i=0;$i<$row['Nb_of_Coursework'];$i++){
			$table.="<tr>";
			
			if(isset($cs[$i]->type) && !empty($cs[$i]->type)){
				$table.="<td colspan='2'>".$cs[$i]->type."</td>";
			}else{
				$table.="<td colspan='2'> </td>";
			}
			
			if(isset($cs[$i]->name) && !empty($cs[$i]->name)){
				$table.="<td colspan='2'>".$cs[$i]->name."</td>";
			}else{
				$table.="<td colspan='2'> </td>";
			}
				
			if(isset($cs[$i]->weitghing) && !empty($cs[$i]->weitghing)){
				$table.="<td colspan='1'>".$cs[$i]->weitghing."</td>";
			}else{
				$table.="<td colspan='1' </td>";
			}
				
			if(isset($cs[$i]->expct_hrs) && !empty($cs[$i]->expct_hrs)){
				$table.="<td colspan='1'>".$cs[$i]->expct_hrs."</td>";
			}else{
				$table.="<td colspan='1'> </td>";
			}
			
			if(isset($cs[$i]->predict_hrs) && !empty($cs[$i]->predict_hrs)){
				$table.="<td colspan='1'>".$cs[$i]->predict_hrs."</td>";
			}else{
				$table.="<td colspan='1'> </td>";
			}
			
			if(isset($cs[$i]->extra_hrs) && !empty($cs[$i]->extra_hrs)){
				$table.="<td colspan='1'>".$cs[$i]->extra_hrs."</td>";
			}else{
				$table.="<td colspan='1'> </td>";
			}
			
			if(isset($cs[$i]->SW_A) && !empty($cs[$i]->SW_A)){
				if(gettype($cs[$i]->SW_A)=="string"){
					$diff = $start_date->diff(new DateTime($cs[$i]->SW_A));
					$weeks = floor(($diff->days / 7)+1);
					$table.="<td>".$cs[$i]->SW_A."</td><td>(week ".$weeks.")</td>";
				}else{
					$table.="<td> </td><td>(week ".$cs[$i]->SW_A.")</td>";
				}
			}else{
				$table.="<td> </td><td> </td>";
			}
			
			if(isset($cs[$i]->DL_A) && !empty($cs[$i]->DL_A)){
				if(gettype($cs[$i]->DL_A)=="string"){
					$diff = $start_date->diff(new DateTime($cs[$i]->DL_A));
					$weeks = floor(($diff->days / 7)+1);
					$table.="<td>".$cs[$i]->DL_A."</td><td>(week ".$weeks.")</td>";
				}else{
					$table.="<td> </td><td>(week ".$cs[$i]->DL_A.")</td>";
				}
			}else{
				$table.="<td> </td><td> </td>";
			}
				
			if(isset($cs[$i]->SW_B) && !empty($cs[$i]->SW_B)){
				if(gettype($cs[$i]->SW_B)=="string"){
					$diff = $start_date->diff(new DateTime($cs[$i]->SW_B));
					$weeks = floor(($diff->days / 7)+1);
					$table.="<td >".$cs[$i]->SW_B."</td><td>(week ".$weeks.")</td>";
				}else{
					$table.="<td> </td><td>(week ".$cs[$i]->SW_B.")</td>";
				}
			}else{
				$table.="<td> </td><td> </td>";
			}
			
			if(isset($cs[$i]->DL_B) && !empty($cs[$i]->DL_B)){
				if(gettype($cs[$i]->DL_B)=="string"){
					$diff = $start_date->diff(new DateTime($cs[$i]->DL_B));
					$weeks = floor(($diff->days / 7)+1);
					$table.="<td >".$cs[$i]->DL_B."</td><td>(week ".$weeks.")</td>";
				}else{
					$table.="<td> </td><td>(week ".$cs[$i]->DL_B.")</td>";
				}
			}else{
				$table.="<td> </td><td> </td>";
			}
			
			$table.="<td></td>";
			$table.="</tr>";
		}
	}

	
	
	//===============================
	
	$table.="<tr class='detail' style='display:none'><th colspan='17' style='height:15px;'>  </th></tr><tr class='detail' style='display:none'><th></th>";
	for($i=1;$i<16;$i++){
		$table.="<th>week ".$i."</th>";
	}
	$table.="<th>total</th>";
	$table.="</tr><tr class='detail' style='display:none'><th>Contact hours</th>";
	$tmp=json_decode($row["contact_hrs"]);
	$t=0;
	for($i=0;$i<15;$i++){
		if(isset($tmp[$i]) && !empty($tmp[$i])){
			$table.="<td>".$tmp[$i]."</th>";
			$t+=$tmp[$i];
		}else{
			$table.="<td>0</td>";
		}
	}
	$table.="<td>$t</td>";
	
	$table.="</tr><tr class='detail' style='display:none'><th>predict study hours</th>";
	$tmp=json_decode($row["predict_hrs"]);
	$t=0;
	for($i=0;$i<15;$i++){
		if(isset($tmp[$i]) && !empty($tmp[$i])){
			$table.="<td>".$tmp[$i]."</th>";
			$t+=$tmp[$i];
		}else{
			$table.="<td>0</td>";
		}
	}
	$table.="<td>$t</td>";
	
	$table.="</tr><tr class='detail' style='display:none'><th>extra hours</th>";
	$tmp=json_decode($row["extra_hrs"]);
	$t=0;
	for($i=0;$i<15;$i++){
		if(isset($tmp[$i]) && !empty($tmp[$i])){
			$table.="<td>".$tmp[$i]."</th>";
			$t+=$tmp[$i];
		}else{
			$table.="<td>0</td>";
		}
	}
	$table.="<td>$t</td>";
	
	$table.="</tr><tr class='detail' style='display:none'><th rowspan='2'>CA predict hours</th>";
	
	$t=0;
	if(isset($row["CA_predict_time_A"])){
		$tmp=json_decode($row["CA_predict_time_A"]);
		//A
		for($i=0;$i<15;$i++){
			if(isset($tmp[$i]) && !empty($tmp[$i])){
				$table.="<td  style='background-color:cyan;'>".$tmp[$i]."</th>";
				$t+=$tmp[$i];
			}else{
				$table.="<td  style='background-color:cyan;'>0</td>";
			}
		}
		
	}else{
		for($i=0;$i<15;$i++){
			$table.="<td  style='background-color:cyan;'>0</td>";
		}
	}
	$table.="<td style='background-color:cyan;'>$t</td></tr><tr class='detail' style='display:none'>";
	
	//B
	$t=0;
	if(isset($row["CA_predict_time_B"])){
		$tmp=json_decode($row["CA_predict_time_B"]);
		for($i=0;$i<15;$i++){
			if(isset($tmp[$i]) && !empty($tmp[$i])){
				$table.="<td>".$tmp[$i]."</th>";
				$t+=$tmp[$i];
			}else{
				$table.="<td>0</td>";
			}
		}
	}else{
		for($i=0;$i<15;$i++){
			$table.="<td>0</td>";
		}
	}

	$table.="<td>$t</td></tr><tr class='detail' style='display:none'><th rowspan='2'>CA extra hours</th>";
	
	if(isset($row["CA_extra_time_A"])){
		$tmp=json_decode($row["CA_extra_time_A"]);
		//A
		$t=0;
		for($i=0;$i<15;$i++){
			if(isset($tmp[$i]) && !empty($tmp[$i])){
				$table.="<td  style='background-color:cyan;'>".$tmp[$i]."</th>";
				$t+=$tmp[$i];
			}else{
				$table.="<td  style='background-color:cyan;'>0</td>";
			}
		}
	}else{
		for($i=0;$i<15;$i++){
			$table.="<td  style='background-color:cyan;'>0</td>";
		}
	}
	
	$table.="<td style='background-color:cyan;'>$t</td></tr><tr class='detail' style='display:none'>";
	//B
	if(isset($row["CA_extra_time_B"])){
		$tmp=json_decode($row["CA_extra_time_B"]);
		$t=0;
		for($i=0;$i<15;$i++){
			if(isset($tmp[$i]) && !empty($tmp[$i])){
				$table.="<td>".$tmp[$i]."</th>";
				$t+=$tmp[$i];
			}else{
				$table.="<td>0</td>";
			}
		}
	}else{
		for($i=0;$i<15;$i++){
			$table.="<td>0</td>";
		}
	}
	
	
	$table.="<td>$t</td></tr><tr class='detail' style='display:none'><th rowspan='2'>total</th>";
	for($i=0;$i<16;$i++){
		$table.="<td style='background-color:cyan;'></td>";
	}
	$table.="</tr><tr class='detail' style='display:none'>";
	for($i=0;$i<16;$i++){
		$table.="<td></td>";
	}
	
	
	
	$table.="</tr><tr class='detail' style='display:none'><td colspan='17'> <button type='button' onclick='modify_t(".'"'.$row['code'].'"'.',"'.$prof.'"'.")'>modify</button><button type='button' style='display:none;' onclick='reload(".'"'.$row['code'].'"'.',"'.$prof.'"'.");'>cancel</button><button type='button' style='display:none;' onclick='upload_t(".'"'.$row['code'].'"'.',"'.$prof.'"'.");'>confirm & upload</button></td></tr></tr>";
	
	//Final exam week
	
	$table.="<tr><th colspan='14'>Final Exam Week:</th><th colspan='3'>".$row['Final_Exam_Week']."</th></tr>";

	if($type==1){
		$table.="</table><div id='shpw_".$row['code']."'></div><div id='SWD_".$row['code']."'></div><div id='detail'><div id='A_".$row['code']."'></div><div id='B_".$row['code']."'></div></div><div id='pain_score_".$row['code']."'></div></div></section>";
	}else if($type == 0){
		$table.="</table></section>";
	}
	
}

if($type=="1"){
	$table.="</section>";
}else if( $type=="0"){
	$table.="<div id='total_".$prof."_A'></div><div id='total_".$prof."_B'></div></section>";
}


echo $table;	

$conn->close();
?>