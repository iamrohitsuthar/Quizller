<?php

include 'database/config.php';
$i = 20;
    
while($i < 38) {

    $sql1 = "INSERT INTO students (test_id,rollno,password,score,status) values(2,'$i','$i',0,0)";
    $result1 = mysqli_query($conn,$sql1);
    $i++;
}


?>