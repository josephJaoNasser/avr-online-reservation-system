<?php
	session_start();
	$reserveid = $_SESSION['id'];
	$servername = "localhost";
	$dbusername = "jjnasser";
	$dbpassword = "AdDU2201501226595";
	$dbname = "jjnasser_addu_avr_ors";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	$time = null;
	$date = null;
	

	if (isset($_POST['time']))
	{
		$_SESSION['sched'] =$time = (string)date("h:i:s",strtotime($_POST['time']));	

	}

	if (isset($_POST['date']))
	{				
		$_SESSION['date'] = $date = date("Y-m-d",mktime(0,0,0,date('m'),$_POST['date'],date('Y')));
	}

	if (isset($time) && isset($date)) 
	{
		echo "Reserve a room on ". date("F ".$_POST['date'].", Y")." at ".date('h:i A',strtotime($time))."?<br>";
	}
	if (isset($_POST['editisreserved'])) 
	{
		$passedroom_id = $_SESSION['rsv_id'];
		echo "Processing...";
		$time = $_SESSION['sched'];
		$date = $_SESSION['date'];
		//echo $date;
		   	$updatequery = "UPDATE `room_reservations` SET `date_reserved`='$date',`start_time_use`='$time' WHERE id = $passedroom_id";
		   	$insertresult = $conn->query($updatequery);		   
		
	}

	
	
?>