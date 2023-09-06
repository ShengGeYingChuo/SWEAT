
<html>
	<head>
	
		<title>Highcharts 教程 | 菜鸟教程</title>
	</head>
	
	<body>
		<div id="container" style="width: 550px; height: 400px; margin: 0 auto"></div>

		<?php
		print "yes";
		$sql="SELECT * FROM modules WHERE code='c1' OR code='c2' OR code='c3'";
		echo strpos($sql,"OR");
		?>

	</body>
</html>



