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
		<div class="container">	
	    <h1>Light Sensor History</h1>
	    
	    <!--Set canvas for chart--> 
			<canvas id="chart" style="width: 100%; height: 7	0vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

	    <!--script to fill chart with data--> 
			<script>
				var ctx = document.getElementById("chart").getContext('2d');
				var ylabels =[<?php echo $intensity;?>];
				var xlabels =[<?php echo $date;?>];
			  
    		var myChart = new Chart(ctx, {
        	type: 'line',
		      data: {
		    	  labels: xlabels,
		        datasets: 
		       	[{
		       		// filling data with points, Needs to be changed to a looped system
		      		data: [{
			      		x: xlabels[0],
		    				y: ylabels[0]},
		    			{
			         	x: xlabels[1],
		    				y: ylabels[1]},
		    			{
			          x: xlabels[2],
		    				y: ylabels[2]},
		    			{
			          x: xlabels[3],
		    				y: ylabels[3]},
		    			{
			          x: xlabels[4],
		    				y: ylabels[4]},
		    			{
			          x: xlabels[5],
		    				y: ylabels[6]},
		    			{
			          x: xlabels[7],
		    				y: ylabels[7]},
		    			{
			          x: xlabels[8],
		    				y: ylabels[8]},
		    			{
			          x: xlabels[9],
		    				y: ylabels[9]},
		    			{
			          x: xlabels[10],
		    				y: ylabels[10]},
		    			{
			          x: xlabels[11],
		    				y: ylabels[11]},
		    			{
			          x: xlabels[12],
		    				y: ylabels[12]},
		    			{
			          x: xlabels[13],
		    				y: ylabels[13]},
		    			{
			          x: xlabels[14],
		    				y: ylabels[14]},
		    			{
			          x: xlabels[15],
		    				y: ylabels[15]
		    			}],
							label: 'Light Intensity',
		          backgroundColor: 'transparent',
		          borderColor:'rgba(255,99,132)',
		          borderWidth: 3
						}]
		     	},
		      options: {
		      	scales: {
		        	xAxes: [{
		        		type: 'time',
		        		time: {
//									Range for data being displayed. Will be changed to 24hrs from current date
//		        			min: xlabels[10],
//		        			max: xlabels[0],
		        			displayFormats: 
		        			{
		        				second: 'MMM D h:mm:ss a'
		        			}
		        		},
		        	}]
		        }
		       }
		    });


			setTimeout(function(){
   				console.log("test")
			}, 5000);
			</script>
		</div>
	</body>
</html>