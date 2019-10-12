<?php
        session_start();
        include '../database/config.php';
        $testName = "";

        if(isset($_SESSION['student_details'])){
            $data = $_SESSION['student_details'];
            $student_data = json_decode($data);
            //print_r($data);

            foreach($student_data as $obj){
                $result = mysqli_query($conn, "Select * from tests where id = '".$obj->test_id."' and status_id IN (2)");
                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['test_id'] = $row['id'];
                        $testName = $row['name'];
                    }
                }     
            }

            echo $testName;
        }else{
            echo "Not Found";
        }

        mysqli_close($conn);?>