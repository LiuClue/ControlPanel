<?php
	date_default_timezone_set("America/Toronto");
	echo "The time is " . date("Y/m/d h:i:sa");
	/* Database connection settings */
	$host = '169.254.94.198'; 
	$user = 'root';
	$pass = 'password';
	$db = 'sysc';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);


	$mail = '';
	$status ='';


	//query to get data from the table
	$sql = "SELECT * FROM `user` WHERE houseID ='1' limit 1";
    $result = mysqli_query($mysqli, $sql);

	//loop through the returned data
	$row = mysqli_fetch_array($result);
	$status = $row['mailboxstate'];

	if ($status == 1){
		echo "<br><br> There is mail";
	}else
	{
		echo "<br><br> There is no mail";
	}

?>

<!DOCTYPE html>
<html>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sensor Display</title>

		<link rel="stylesheet" type="text/css" href="/css/styles.css">

	</head>
	<body>	   

		<div class="container" style="width:80%">
			<canvas id="canvas"></canvas>
			<form action = "/index.php">
					<button id="addData" class="ripple">Home</button>
				</form>
			</form>
		</div>
		<script>
		console.log("test");
		</script>
	</body>
</html>