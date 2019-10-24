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

		//pulling credentials from database
		$logincheckquery = "SELECT username, hash, salt FROM user WHERE username = '". $username ."';";
		$infocheck = mysqli_query($connection, $logincheckquery) or die("5: LoginCheckQuery Failed");

		//checking username
		if(mysqli_num_rows($infocheck) != 1)
		{
			die("6: Username Issue");
		}

		//checking password
		$existinginfo = mysqli_fetch_assoc($infocheck);
		$saltbase = $existinginfo["salt"];
		$hashbase = $existinginfo["hash"];

		$loginhash = crypt($password, $saltbase);
		if($hashbase != $loginhash)
		{
			die("7: Password Issue");
		}
		echo("0");

?>