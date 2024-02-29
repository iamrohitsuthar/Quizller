<?php
	session_start();
	include '../database/config.php';
	$temp		  = $_SESSION['student_details'];
	$student_data = json_decode($temp);

	foreach ($student_data as $obj)
	{
		$student_id = $obj->id;
		$sql1		= "UPDATE students set status = 1 where id = '$student_id'";
		mysqli_query($conn, $sql1);
	}

	if ($_POST['message'] == 1)
	{
		echo "Aborted";
	}
	else
	{
		echo "Completed";
	}

	session_destroy();
