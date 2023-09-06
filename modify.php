<?php
$conn = new mysqli("localhost","root","","SWEAT");

$sql=$_GET["sql"];
$type=$_GET["type"];
$code=$_GET["code"];

if($type=="'un'"){
	$log=mysqli_fetch_assoc(mysqli_query($conn,"SELECT log FROM module WHERE code=".'"'.$code.'"'.";"));
	$sql_log="UPDATE module SET log='".$log["log"]." <p>".date("Y-m-d H:i:s")."</p><p>".str_replace("'"," ",$sql)."</p><br />' WHERE code=".'"'.$code.'"'.";";
	mysqli_query($conn,$sql_log);
}
if($type=="log"){
	$sql_gl="SELECT log FROM module WHERE code=".'"'.$code.'"'.";";
	$result=mysqli_fetch_assoc(mysqli_query($conn,$sql_gl));
	echo $result["log"];
}

if($type=="ufb"){
	$fb=mysqli_fetch_assoc(mysqli_query($conn,"SELECT Feedback FROM module WHERE code=".'"'.$code.'"'.";"));
	if(!empty($fb["Feedback"])&&isset($fb["Feedback"])){
		$sql_fb="UPDATE module SET Feedback='".$fb["Feedback"]." <p>".date("Y-m-d H:i:s")."</p><p>".str_replace("'"," ",$sql)."</p><br />' WHERE code=".'"'.$code.'"'.";";
	}else{
		$sql_fb="UPDATE module SET Feedback=' <p>".date("Y-m-d H:i:s")."</p><p>".str_replace("'"," ",$sql)."</p><br />' WHERE code=".'"'.$code.'";';
	}
	echo ($code);
	mysqli_query($conn,$sql_fb);
}

if($type=="fb"){
	$sql_gl="SELECT Feedback FROM module WHERE".$code.";";
	$result=mysqli_fetch_assoc(mysqli_query($conn,$sql_gl));
	echo $result["Feedback"];
}


if($sql!="''"){
	$result=mysqli_query($conn,$sql);
	echo $result;
}

$conn->close();
?>