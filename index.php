<?php
	date_default_timezone_set("America/Toronto");
	echo "The time is " . date("Y/m/d h:i:sa");
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'db';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$intensity = '';
	$date = '';

	//query to get data from the table
	$sql = "SELECT * FROM `light` ORDER BY date DESC";
    $result = mysqli_query($mysqli, $sql);

	//loop through the returned data
	while ($row = mysqli_fetch_array($result)) {

		$intensity = $intensity . '"'. $row['intensity'].'",';
		$date = $date . '"'. $row['date'].'",';
	}

	$intensity = trim($intensity,",");
	$date = trim($date,",");
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
		<div class="container" style="width:100%; height:65vh;">	
	    	<h1>Light Sensor History</h1>
	    	<!--Set canvas for chart--> 
			<canvas id="canvas"></canvas>
		</div>
		<script>
			var ylabels =[<?php echo $intensity;?>];
			var xlabels =[<?php echo $date;?>];
			var config = {
				type: 'line',
				data: {
					datasets: [{
						label: 'Intensity',
		        		backgroundColor: 'transparent',
		          		borderColor:'rgba(255,99,132)',
						fill: false,
						data: [{
							x: xlabels[0],
							y: ylabels[0]
						},{
							x: xlabels[1],
							y: ylabels[1]
						}]
					}]
				},
				options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Time Point Data'
				},
				scales: {
					xAxes: [{
						type: 'time',
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Date'
						},
						ticks: {
							major: {
								fontStyle: 'bold',
								fontColor: '#FF0000'
							}
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'value'
						}
					}]
				}
			}
			}
			window.onload = function() {
				var ctx = document.getElementById('canvas').getContext('2d');
				window.myLine = new Chart(ctx, config);
			}
			for(var i = 0; i < xlabels.length; i++){
				config.data.datasets[0].data.push({
					x: xlabels[i],
					y: ylabels[i]
				})
				console.log(5 + 6);
			}
			window.myLine.update();
		</script>
	</body>
</html>