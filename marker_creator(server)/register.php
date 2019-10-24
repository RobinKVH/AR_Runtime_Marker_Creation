<?php
		//Server Connection Credentials
		$consevername = 'localhost:3307';
		$conusername = 'root';
		$conpassword = 'root';
		$condbname = 'marker_creator';
		//-----------------------------
		$connection = mysqli_connect($consevername, $conusername, $conpassword, $condbname);
		//checking connection
		if(mysqli_connect_errno())
		{
			echo "1: Connection Failed";
			exit();
		}

		$username = $_POST["username"];
		$password = $_POST["password"];

		//checking if username is unique
		$namecheckquery = "SELECT username FROM user WHERE username = '". $username ."';";
		$namecheck = mysqli_query($connection, $namecheckquery) or die("2: NameCheckQuery Failed");

		if(mysqli_num_rows($namecheck) > 0)
		{
			die("3: Non-unique Username");
		}

		//encrypt password
		$salt = "\$5\$rounds=1000\$" . "tyrellcorp" . $username . "\$";
		$hash = crypt($password, $salt);

		//add user to table
		$insertuserquery = "INSERT INTO user (username, hash, salt) VALUES ('".$username."','".$hash."', '".$salt."');";


		mysqli_query($connection, $insertuserquery) or die("4: Insertuserquery Failed");

		echo ("0");
		mysqli_close($connection);
?>