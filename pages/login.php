<!DOCTYPE html>
<html>
	<head>
		<title>Ateneo de Davao Online AVR Reservation Sign In</title>
	</head>
	<link rel="stylesheet" type="text/css" href="../css/addu_avr_login_stylesheet.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<body background="../images/IMG_20180510_145432.jpg">
		<?php
			session_start();
			$error = "";
			$_SESSION['isLoggedIn'] = false;
			
			if (isset($_POST['signin']))
			{	
				$servername = "localhost";
				$dbusername = "jjnasser";
				$dbpassword = "AdDU2201501226595";
				$dbname = "jjnasser_addu_avr_ors";
				$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
			
				$InputtedUsername = $_POST['username'];
				$InputtedUPassword = $_POST['password'];
		        $sql = "SELECT * FROM addu_teaching_faculty WHERE username = '$InputtedUsername'";
		        $result = $conn->query($sql);

		        if ($result->num_rows == 1) 
		        {
	        		$row = $result->fetch_assoc();

	        		if ($InputtedUPassword != $row['id'])
	        		{
	        			$error="Username and password Does not Match";
	        		}
	        		else 
	        		{
	        		   $_SESSION['firstname'] = $row['firstname'];
	        		   $_SESSION['lastname'] = $row['lastname'];
	        		   $_SESSION['id'] = $row['id'];
	        		   echo $row["id"];
	        		   $_SESSION['isLoggedIn'] = true;
	        		   header('Location: home.php');
	        		   
	        		}
	         	
	         	} 
	         	else 
	         	{
	            	$error="<br>"."User Does not Exist";
	         	}
         	}
		?>
		
		<form method="POST">
			<div id="div_site_logo">
					<img src="../images/AdDU-Seal-White-head32.png" height="50" width="350">
				</div>
			<div id="div_login">				
				<table id="div_login_content">
					<tr class="table_row">
						<td>AdDU Username:</td>
						<td><input type="text" name="username" class="textbox" size="30"></td>
					</tr>
					<br>
					<tr tr class="table_row">
						<td>Password:</td>
						<td><input type="password" name="password" class="textbox" size="30"></td>
					</tr>	
				</table>
				<div id="error_msg"><?php echo $error;?></div>
				<br>
				<button name="signin" id="btn_signin">Sign in</button>
			</div>			
		</form>
	</body>
</html>