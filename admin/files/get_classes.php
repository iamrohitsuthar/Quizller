<?php
    $info;
	include "../../database/config.php";
   
        $classes = "SELECT name FROM classes ";
        $result = mysqli_query($conn, $classes);
                
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $info[] = $row['name'];
            }
            echo json_encode($info);
        } else {
            echo "0 results";
        }

    mysqli_close($conn);
?>