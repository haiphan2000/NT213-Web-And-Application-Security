<?php
	session_start();
	// Change these configs according to your MySQL server
	$servername = "localhost";
	$username = "lab01";
	$password = "Password123#@!";
	$database = "QLSV"; 		 
	$table = "SINHVIEN";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
	// Check connection
	if ($conn->connect_error) {
		$_SESSION['msg'] = "Connection failed";
	    	#die("Connection failed: " . $conn->connect_error);
	}
	else {
		// 2 ways to get fields in form, the later is more secure
		// $name = $_POST['name'];
		// $name = mysqli_real_escape_string($conn, $_POST['name']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);   
                $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$dob = mysqli_real_escape_string($conn, $_POST['dob']);
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$note = mysqli_real_escape_string($conn, $_POST['note']);

		// Create SQL command to insert data to database
		$sql_command = "INSERT INTO $table VALUES(N'$student_id', N'$name', N'$email', N'$phone','$dob', N'$gender', N'$address', N'$note')";
		if (mysqli_query($conn, $sql_command))
			$_SESSION['msg'] = "New record created successfully";
		else
			$_SESSION['msg'] = mysqli_error($conn);
		mysqli_close($conn);
	}
?>
<html>
<head>
	<title>Form Submit Confirmation</title>
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
		if (isset($_SESSION['msg']))
			echo $_SESSION['msg'];
	?>
</body>
</html>
