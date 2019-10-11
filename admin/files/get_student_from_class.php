<?php
    $id;
    $roll_numbers;
    $counter = 0;
	include "../../database/config.php";
   
        $classes = "SELECT id FROM classes where name = '".$_POST['class_name']."' limit 1 ";
        $result = mysqli_query($conn, $classes);
                
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $id  = $row['id'];
            }
            
        } else {
            echo "0 results";
        }

        $roll = "SELECT rollno FROM student_data where class_id = '".$id."' ";
        $re = mysqli_query($conn, $roll);
        $arr = array();
        $arr1 = array();
        if (mysqli_num_rows($re) > 0) {
            // output data of each row
            $i = 1;
            while($row = mysqli_fetch_assoc($re)) {
                $arr["id"] = $i;
                $arr["rollno"] = $row["rollno"];
                $arr1[] = $arr;
                $i++;
            }
            
            echo json_encode($arr1);
        } else {
            echo "0 results";
        }

    mysqli_close($conn);
?>