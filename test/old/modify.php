<?php
$conn = new mysqli("localhost","root","","SWEAT");

$sql=$_GET["code"];

$result=mysqli_query($conn,$sql);

echo $result;

$conn->close();
?>