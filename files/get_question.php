<?php
        session_start();
        include '../database/config.php';
        if(!isset($_SESSION['test_id'])){
            header("Location: ../index.php");
        }
            $test_id = $_SESSION['test_id'];
    
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }else{

                if(!isset($_SESSION['question_IDS_fetched'])){
                    $result = mysqli_query($conn, "Select question_id from question_test_mapping where test_id = '".$test_id."' ");
                    if (mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)) {
                            $question_ids[] = $row;                   
                        }
                        $_SESSION['question_IDS_fetched'] = $question_ids;
                        $_SESSION['question_counter'] = 0;
                        getQuestion($conn,true);
                    }       
                }else{
                    if($_SESSION['question_counter'] >= sizeof($_SESSION['question_IDS_fetched'])){
                        echo 'QUESTION_SET_FINISHED';
                        exit();
                    }else{
                        getQuestion($conn, false);
                    }
                    
                    }                  
                       
            }

            
            function getQuestion($conn, $isFirst)
            {
                if($isFirst == true){
                    $question = mysqli_query($conn, "Select id, title, optionA, optionB, optionC, optionD, score from Questions where id = '".$_SESSION['question_IDS_fetched'][0]['question_id']."' ");
                    $_SESSION['question_counter']++;
                    fetchAndReturnQuestion($question);
                }else{
                    $question = mysqli_query($conn, "Select id, title, optionA, optionB, optionC, optionD, score from Questions where id = '".$_SESSION['question_IDS_fetched'][$_SESSION['question_counter']]['question_id']."' ");
                    $_SESSION['question_counter']++;
                    fetchAndReturnQuestion($question);
                }
            }

            function fetchAndReturnQuestion($question_id)
            {
                if (mysqli_num_rows($question_id) > 0){
                    while($row = mysqli_fetch_assoc($question_id)) {
                        $fetched_question = $row;
                    }
                    echo json_encode($fetched_question);
                }
            }

            mysqli_close($conn);
    ?>
