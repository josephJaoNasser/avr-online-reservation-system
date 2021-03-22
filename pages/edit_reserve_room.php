<!DOCTYPE html>
<html>
	<head>
		<title>Ateneo de Davao Online AVR Reservation</title>
		<link rel="stylesheet" type="text/css" href="../css/reserve_rooms_stylesheet.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="../javascript/edit_reserve_rooms_javascript.js"></script>
	</head>
	<?php
		session_start();		
		$time = null;
		$rsv_date = null;		

		if (!$_SESSION['isLoggedIn'])
		{
			header("Location: login.php");
		}	

		if (isset($_GET['btn_logout']))
		{
			session_unset();
			header("Location: login.php");
		}

		if (isset($_GET['btn_back']))
		{
			header("Location: home.php");
			unset($_SESSION['selected_date']);
		}

		if (isset($_GET['selected_date']))
		{
			$date = date('m').'-'.$_GET['selected_date'].'-'.date('Y');
			echo "<script>
			$(document).ready(function()
			{				
				show_confirm();
			});
			</script>";

		}

		if(isset($_GET['btn_back_red']))
		{		 
			header("Location: home.php");
		}

		if(isset($_GET['btn_select_sched']))
		{
			$time = $_GET['select_time'];			
			//echo $time;
		}
		

		$full_room_dates = array();//mao ni ang dates kung kanus.a full ang room
		/*
			code na muselect kung unsa ang dates na full tapos istore sa array

			pseudo-code:
				foreach(date na full as $value)
				{
					$full_room_dates[] = date;
				}
		*/

		//$full_room_dates = array(25,3,2); //tester lang ni kung mugana ang code sa baba tangala lang ang slash para makita kung unsay mahitabo

		//code na himuon og red ang mga dates na fully booked ang avr
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
		
		//$date = date('Y-m-d',strtotime('May 8, 2018'));
		//echo $date;
	?>

	<body>
			<div id="window" class="popup_window">			
				Class Schedule:
				<select id="select_time" name="select_time">
					<option value="7:40 AM">7:40 AM</option>
					<option value="8:45 AM">8:45 AM</option>
					<option value="10:00 AM">10:00 AM</option>
					<option value="11:05 AM">11:05 AM</option>
					<option value="12:25 PM">12:25 PM</option>
					<option value="1:30 PM">1:30 PM</option>
					<option value="2:35 PM">2:35 PM</option>
					<option value="5:55 PM">5:55 PM</option>
					<option value="7:00 PM">7:00 PM</option>
					<option value="8:00 PM">8:00 PM</option>
				</select>
				<br><br>
				<button id="btn_select_sched" name="btn_select_sched" class="square_btn select_btn">Select a date</button>
				<button id="btn_back_red" name="btn_back_red" class="square_btn square_back_btn">Back</button>
			</div>
		<div id="black_window_bg"></div>
		<div id="confirm_rsv" class="popup_window">
			<div id="rsv_summary"></div>
			<br>
			<button id="mk_rsv" class="square_btn select_btn">Make Reservation</button>
			<button id="rsv_back" class="square_btn square_back_btn" onclick="hide_confirm()">Back</button>
		</div>		
			
		<form method="GET" name="main">	
			<button id="btn_back" name="btn_back"><</button>
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
			<br>			
		</form>
		<div id="calendar_header">
			MAY 2018
		</div>
		<div id="calendar">
				<table id="days_of_week">
					<tr>
						<td class="day">Sun</td>
						<td class="day">Mon</td>
						<td class="day">Tue</td>
						<td class="day">Wed</td>
						<td class="day">Thu</td>
						<td class="day">Fri</td>
						<td class="day">Sat</td>
					</tr>
					<tr>
						<td class="date"></td>
						<td class="date"></td>
						<td class="date"><button name="selected_date" id="selected_date" value="1">1</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="2">2</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="3">3</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="4">4</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="5">5</button></td>
					</tr>
					<tr>
						<td class="date">6</td>
						<td class="date"><button name="selected_date" id="selected_date" value="7">7</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="8">8</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="9">9</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="10">10</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="11">11</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="12">12</button></td>
					</tr>

					<tr>
						<td class="date">13</td>
						<td class="date"><button name="selected_date" id="selected_date" value="14">14</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="15">15</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="16">16</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="17">17</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="18">18</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="19">19</button></td>
					</tr>


					<tr>
						<td class="date">20</td>
						<td class="date"><button name="selected_date" id="selected_date" value="21">21</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="22">22</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="23">23</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="24">24</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="25">25</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="26">26</button></td>
					</tr>

					<tr>
						<td class="date">27</td>
						<td class="date"><button name="selected_date" id="selected_date" value="28">28</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="29">29</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="30">30</button></td>
						<td class="date"><button name="selected_date" id="selected_date" value="31">31</button></td>
						<td class="date"></td>
						<td class="date"></td>
					</tr>
				</table>
			</div>
	</body>
</html>