<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	$reserveid = $_SESSION['id'];
	$servername = "localhost";
	$dbusername = "jjnasser";
	$dbpassword = "AdDU2201501226595";
	$dbname = "jjnasser_addu_avr_ors";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	$time = null;
	$date = null;
	$full_room_dates = array();//mao ni ang dates kung kanus.a full ang room

	if (isset($_POST['time']))
	{		
		$index = 0;	
		$sched= $_SESSION['sched'] = $time = (string)date("h:i:s",strtotime($_POST['time']));
		for($i=1; $i < 32 ; $i++)
			{ 
				$caldate = date("Y-m-d",mktime(0,0,0,date('m'),$i,date('Y')));
				$sql= "SELECT * FROM room_reservations WHERE date_reserved = '$caldate' AND start_time_use = '$sched'";
				$result = $conn->query($sql);
				if ($result->num_rows == 4)
				{
					$full_room_dates[$index] = $i;
					$index++;
				}
			}
		
		
		foreach ($full_room_dates as $value) {
			echo "<style>
				.date button[value='".$value."']
				{
					background-color: #ff615e;
					color: white;
				}

				.date button[value='".$value."']:hover
				{
					background-color: #ff615e;
					cursor: default;
					pointer-events: none;
				}
				</style>";
		}	

	}

	if (isset($_POST['date']))
	{		
		$_SESSION['sched'] = date('h:i A',strtotime($_POST['time']));	
		$_SESSION['date'] = $date = date("Y-m-d",mktime(0,0,0,date('m'),$_POST['date'],date('Y')));
		echo "Reserve a room on ". date("F ".$_POST['date'].", Y")." at ".$_SESSION['sched']."?<br>";
	}

	if (isset($_POST['isreserved'])) 
	{
		echo "Processing...";
		$time = date("H:i:s" , strtotime($_SESSION['sched']));
		$date = $_SESSION['date'];
		//echo $date;
		$rooms = array("A", "B", "C", "D");
		foreach ($rooms as $value) 
		{
		 	$sql = "SELECT * FROM room_reservations WHERE start_time_use = '$time' AND date_reserved = '$date' AND room = '$value'";
		   $result = $conn->query($sql);

		   if ($result->num_rows == 0) 
		   {
		   	$insertquery = " INSERT INTO `room_reservations`( `date_reserved`, `room`, `teacher_id`, `date_inquired`, `start_time_use`) VALUES ('$date','$value',$reserveid,SYSDATE(),'$time')";
		   	$insertresult = $conn->query($insertquery);
		   	break;
		   }
		}
	}

	
	
?>