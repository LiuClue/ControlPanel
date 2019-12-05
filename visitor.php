<?php
	date_default_timezone_set("America/Toronto");
	echo "The time is " . date("Y/m/d h:i:sa");
	/* Database connection settings */
	$host = '169.254.94.198'; 
	$user = 'root';
	$pass = 'password';
	$db = 'sysc';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$intensity = '';
	$date = '';

	//query to get data from the table
	$sql = "SELECT * FROM `visitor` ORDER BY  currDate, currTime limit 20";
    $result = mysqli_query($mysqli, $sql);

?>

<!DOCTYPE html>
<html>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title>Sensor Display</title>

		<link rel="stylesheet" type="text/css" href="/css/styles.css">

	</head>
	<body>	   
	<table>
    <tr><td></td><td>Date</td><td>Time</td></tr>
    <?php
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr><td>"
                . "Visitor Detected" . "</td><td>"
                . $row['currDate'] . "</td><td>"
                . $row['currTime'] . "</td></tr>";
        }
    ?>
</table>
        	<form action = "/index.php">
					<button id="addData" class="ripple">Home</button>
				</form>
		<div class="container" style="width:80%">
			<canvas id="canvas"></canvas>
		</div>
	</body>
</html>