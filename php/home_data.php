<?php
session_start();
		$user_id = $_SESSION['id'];
		$reservation_id = null;
		 $servername = "localhost";
		 $dbusername = "jjnasser";
	$dbpassword = "AdDU2201501226595";
	$dbname = "jjnasser_addu_avr_ors";
		 $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
		 $deleteitems = array();

if(isset($_POST['editisclick']))
{
	 $sql = "SELECT * FROM room_reservations WHERE teacher_id = $user_id";
		 $result = $conn->query($sql);

	while ($rowforroom=$result->fetch_assoc())
	 {
		echo "<li style='padding: 5px; list-style-type: none; font-size: 20px;'><input type='checkbox' name='selected_rsv[]' id='selected_rsv' class='check' value='".$rowforroom['id']."'> ".date('F j, l',strtotime($rowforroom['date_reserved']))." at ".date('h:i A',strtotime($rowforroom['start_time_use'])). ",	 AVR-" . $rowforroom['room'] . "<button style='float:right;' value='".$rowforroom['id']."' id='btn_edit_item' name='btn_edit_item' class='square_btn' onclick = 'edit_items()'><img src='../images/pencil-256x256.png' height='25' width='25'></button></li><br>";
	}
	//echo "<button id='test' name='test' onclick = 'testing()'>TESTING</button>";

}




/*
if(isset($_POST['items']))
{
	$items = array();
	$items = json_decode(stripslashes($_POST['items']));
	foreach ($items as $value)
	{
		$sql = "DELETE * FROM room_reservations WHERE id = $value";
		 $result = $conn->query($sql);
	}
	header("Location: home.php");
}*/
?>