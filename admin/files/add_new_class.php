<?php
	include "../../database/config.php";
    $class_name = $_POST['class_name'];
    $starting_roll_number = $_POST['starting_roll_number'];
    $ending_roll_number = $_POST['ending_roll_number'];
    $class_id ;
    $sql = "INSERT INTO classes (name)
    VALUES ('".$class_name."')";

    if (mysqli_query($conn, $sql)) {
        $id = "SELECT id  FROM classes where name = '".$class_name."' limit 1";
        $result = mysqli_query($conn, $id);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $class_id =  $row['id'];
            }

            for ($x = $starting_roll_number; $x <= $ending_roll_number; $x++) {
                $insert_roll_numbers = "INSERT INTO student_data (rollno, class_id)
                VALUES ('".$x."', $class_id)";

                mysqli_query($conn, $insert_roll_numbers);
            }
            echo "Success";
        } else {
            echo "Failure";
        }
     
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>