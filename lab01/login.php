<?php
	session_start();
	//Change these configs according to your MySQL server
	$servername = "localhost";
	$username = "lab01";
	$password = "Password123#@!";
	$database = "QLSV";
	$table = "user";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
		// Check connection
		if ($conn->connect_error) {
			$_SESSION['msg'] = "Connection failed";
		    //die("Connection failed: " . $conn->connect_error);
		}
		else{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$hash_pass = hash("sha256", $password);
			$isPass = 0;

			if(!preg_match("/'+/", $username)){ // prevent from sql injection which using ' letter

				$sql_command = "SELECT * FROM ".$table." WHERE username='".$username."' and password='".$hash_pass."'";

				$result = mysqli_query($conn, $sql_command);
				if (mysqli_num_rows($result) > 0){
					// mysqli_fetch_assoc($result) will return the first row
					$row = mysqli_fetch_assoc($result);
					$_SESSION['name'] = $row['username'];

					$isPass = 1;
				}

				mysqli_close($conn);
			}
			
			if(!$isPass)
			{
				$_SESSION['name'] = null;
				$_SESSION['msg'] = "Login failed";
			}
			
		}
?>
<html>
<head>
	<title>Simple Info Form</title>
	<style>
	    body{
	    	font-family: Arial
	    }
		.label {
			width: 10%;
			float: left;
		}
		.info{
			padding: 5px;
		}
		form{
			padding-left: 30px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php
	 	if ( isset($_SESSION['name']) )
		 	echo 'Welcome '.$_SESSION['name'];
		else{
			if ( isset($_SESSION['msg']) )
				echo $_SESSION['msg'];
		} 
	?>
</body>
</html>
