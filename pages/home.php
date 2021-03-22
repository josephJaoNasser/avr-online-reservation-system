<!DOCTYPE html>
<html>
	<head>
		<title>Ateneo de Davao University Audio Visual Room Online Reservation</title>

		<link rel="stylesheet" type="text/css" href="../css/addu_avr_home_stylesheet.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="../javascript/javascript_home.js"></script>

	</head>
	<!--PHP STUFF -->
	<?php
		session_start();

		 $servername = "localhost";
		 $dbusername = "jjnasser";
		$dbpassword = "AdDU2201501226595";
		$dbname = "jjnasser_addu_avr_ors";
		 $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

		$msgNoReservations ="";
		//$idchecker =  $idrow['id'];
		$user_id = $_SESSION['id'];
		$hasReservations = false;

		if (!$_SESSION['isLoggedIn'])
		{
			header("Location: login.php");
		}

		if (isset($_POST['btn_logout']))
		{
			session_unset();
			header("Location: login.php");
		}
		if (isset($_POST['btn_reserve_room']))
		{
			header("Location: reserve_rooms.php");
		}	
		//Room

		 $sql = "SELECT id, date_reserved, room, teacher_id, DATE_FORMAT(start_time_use, '%h:%i %p') as start_time_use FROM `room_reservations` WHERE teacher_id = $user_id";
		 	$result = $conn->query($sql);
		 //Equipment
		 $sqlforequipment = "SELECT * FROM equipment_reservations WHERE teacher_id = $user_id";
		 	$resultforequipment = $conn->query($sqlforequipment);
		 
		if($result->num_rows > 0)
		{
			$hasReservations = true;
		}
		else if ($resultforequipment->num_rows > 0)
		{
			$hasReservations = true;
		}

		if ($hasReservations)
		{
			echo "<script>
				$(document).ready(function()
				{
					show_rsv_list();

				});
			</script>";
		}
		else
		{
			$msgNoReservations = "No Reservations...";
			echo "<script>
				$(document).ready(function()
				{
					lbl_no_rsv_fadeIn();
				});
			</script>";
		}
		if(isset($_POST['btn_confirm_delete']))
		{//to run PHP script on submit
	
			foreach ($_POST['selected_rsv'] as $value)
			{
				 $sql = "DELETE FROM room_reservations WHERE id = $value";
		 			$result = $conn->query($sql);

				header("location: home.php");
			}				
		}
		if (isset($_POST['btn_edit_item'])) 
		{
			$_SESSION['rsv_id'] = $_POST['btn_edit_item'];
			header("location:edit_reserve_room.php");
		}
	
	?>
	<body >
		<form method="POST">
			<div id="edit_item_list" class="popup_window">
				<div id="btn_hide_edit" onclick="hide_edit()">X</div><span id="edit_items_label">Edit Items</span>
				<div class="square_btn" id="btn_delete" onclick="show_confirm_delete()"><img src="../images/bin.png" height="20" width="20"></div>
				<br><br><hr><br>
				<div id="itemlist"></div>				
				<div id="black_bg"></div>
				<div id="confirm_delete" class="popup_window">
					Delete selected items?<br><br><button class="square_btn" id="btn_confirm_delete" name="btn_confirm_delete">Delete</button>
					<div class="square_btn" id="btn_cancel_delete" onclick="hide_confirm_delete()">Cancel</div>
				</div>
				<div id="div_select_items_msg">
					Please select items to delete...<br><br>
					<div class="square_btn" id="btn_okay">Okay</div>
				</div>
			</div>
		</form>
		<form method="POST">
			<div id="top_bar">	
				<img src="../images/AdDU-Seal-White-head32.png" style="float:left;" height="50" width="350">
				<div id="div_btn_logout">			
					<button name="btn_logout" id="btn_logout">Log Out</button>
				</div>
			</div>
			<div id="loginId">
				<div id="profile_picture"></div>
				<p id="account_name">
					<?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?>
				</p>				
			</div>
		</form>
			<div id="first_content">				
				<div id="div_my_reservations" class="section_div">
					My Reservations:
					<button id="btn_edit_rsv_items" class="square_btn">Edit Items...</button><br><br>				
					<form method="POST">
					<div id="div_reservation_list">
						<ul>
						<?php						
							if ($resultforequipment->num_rows>0)
							{
								while ($rowforequipment=$resultforequipment->fetch_assoc()) {
									echo "<li style='padding: 5px; list-style-type: none;'>". date("F j",strtotime($rowforequipment['date_reserved'])). "	" . $rowforequipment['equipment_name'] . "	" . date('h:i A',strtotime($rowforequipment['time_returned'])) . "</li>";
								}
								echo "<hr>";
							}

							if ($result->num_rows>0)
							{
								while ($rowforroom=$result->fetch_assoc()) {
									echo "<li style='padding: 5px; list-style-type: none;'>".date('F j, l',strtotime($rowforroom['date_reserved']))." at ".
									date('h:i A',strtotime($rowforroom['start_time_use'])). ",	 
									AVR-" . $rowforroom['room'] . "</li><br>";
								}
							}
					
						?>
						</ul>
					</div>
					</form>
					<br><br>
					<span id="no_reservations"><?php echo $msgNoReservations ?></span>
				</div>
			<form method="POST">
				<div id="div_start_reserve" class="section_div">
					<div id="div_btn_rsv">
						<div id="div_btn_rsv_room">
							<button name="btn_reserve_room" id="btn_reserve_room" class="btn_rsv"><img src="../images/tv.png" height="120" width="120"></button><br>
							<p class="lbl_rsv">Reserve a room</p>	
						</div>
						<div id="div_btn_rsv_equipment">
							<button name="btn_reserve_equipment" id="btn_reserve_equipment" class="btn_rsv"><img src="../images/Projector-icon.png" height="120" width="120"></button>
							<p class="lbl_rsv">Reserve equipment</p>	
						</div>
					</div>					
				</div>
			</div>				
		</form>
			
	</body>
</html>