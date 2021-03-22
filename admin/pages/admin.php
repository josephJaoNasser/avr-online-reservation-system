<!DOCTYPE html>
<html>
	<head>
		<title>AdDU AVR Admin</title>
		<link rel="stylesheet" type="text/css" href="../css/admin_home.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	</head>
	<?php
		session_start();

		 $servername = "localhost";
		 $dbusername = "jjnasser";
		$dbpassword = "AdDU2201501226595";
		$dbname = "jjnasser_addu_avr_ors";
		 $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

		//$idchecker =  $idrow['id'];
		$user_id = $_SESSION['id'];
		$hasReservations = false;

		if (!$_SESSION['isLoggedIn'])
		{
			header("Location: admin_login.php");
		}

		if (isset($_POST['btn_logout']))
		{
			session_unset();
			header("Location: admin_login.php");
		}
	?>
	<body>
		<form method="POST">
			<div id="top_bar">
				<p id="site_label">AdDU AVR Admin</p>
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
	</body>
</html>