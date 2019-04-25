<?php
    // Connect to MySQL
    include("dbconnect.php");
	$sensor = $_GET['motionornot'];
	$SQL = "INSERT INTO motion (motion,event) VALUES ($sensor,now())";
	$con->query($SQL);
	if($sensor == "1"){
		//$SQL = "INSERT INTO motion (motion) VALUES ($sensor);";
		$SQL = "INSERT INTO starttime (motion,startTime) VALUES ($sensor,now());";
		mysqli_multi_query($con,$SQL);
		
	}
	else{
		//$SQL = "INSERT INTO motion (motion) VALUES ($sensor);";
		$SQL = "INSERT INTO stoptime (motion,stopTime) VALUES ($sensor,now());";
		$SQL .= "INSERT INTO activetime (activeTime) SELECT TIMEDIFF((SELECT stopTime from stoptime where id=(SELECT max(id) from stoptime)),(SELECT startTime from starttime where id=(SELECT max(id) from starttime)))";
		mysqli_multi_query($con,$SQL);
	} 
    header("Location: data_review.php");
?>
