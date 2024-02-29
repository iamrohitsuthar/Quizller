<?php
	include '../database/config.php';
	session_start();

	$student_roll_number = $_POST['rollNumber'];
	$student_password	 = $_POST['password'];

	$sql1		= "select id from student_data where rollno = '$student_roll_number'";
	$result1	= mysqli_query($conn, $sql1);
	$row1		= mysqli_fetch_assoc($result1);
	$student_id = $row1["id"];

	$result = mysqli_query($conn, "Select id, test_id, rollno, score, status from students where rollno = '" . $student_id . "' and password = '" . $student_password . "' and status = 0 ");

	if (mysqli_num_rows($result) > 0)
	{

		while ($row	= mysqli_fetch_assoc($result))
			$info[] = $row;

		echo 'CREDS_OK';
		$_SESSION['student_details'] = json_encode($info);
	}
	else
	{
		echo json_encode("STUDENT_RECORD_NOT_FOUND");
	}

	mysqli_close($conn);
