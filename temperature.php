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
	$sql = "SELECT * FROM `temperature` ORDER BY currDate, currTime DESC";
    $result = mysqli_query($mysqli, $sql);

	//loop through the returned data
	while ($row = mysqli_fetch_array($result)) {
		$tempDate = date('Y-m-d H:i:s', strtotime("$row[currDate] $row[currTime]"));
		$intensity = $intensity . '"'. $row['currTemp'].'",';
		$date = $date . '"'. $tempDate.'",';
	}

	$intensity = trim($intensity,",");
	$date = trim($date,",");
?>

<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title>Sensor Display</title>

		<link rel="stylesheet" type="text/css" href="/css/styles.css">

	</head>
	<body>	   

		<div class="container" style="width:80%">
			<canvas id="canvas"></canvas>

        	<form action = "/index.php">
					<button id="addData" class="ripple">Home</button>
				</form>
		</div>
		<script>
			var today = new Date();
			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			var yestardate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate()-1);
			var time = (today.getHours()) + ":" + today.getMinutes() + ":" + today.getSeconds();
			var dateTime = date+' '+time;
			var yestardateTime = yestardate+' '+time;
			
			var ylabels =[<?php echo $intensity;?>];
			var xlabels =[<?php echo $date;?>];
			var config = {
				type: 'line',
				data: {
					datasets: [{
						pointRadius: 1,
						fill: false,
						lineTension: 0,
						borderWidth: 2,
						label: 'Intensity',
		        		backgroundColor: 'transparent',
		          		borderColor:'rgba(255,99,132)',
						fill: false,
						data: [{}]
					}]
				},
				options: {
				responsive: true,
				title: {
					display: true,
					text: dateTime
				},
				scales: {
					xAxes: [{
						type: 'time',
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Time'
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
							labelString: 'Intensity'
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
			}
			window.myLine.update();
			;
		</script>
	</body>
</html>