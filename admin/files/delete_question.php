<?php

include "../../database/config.php";
$question_id = $_POST['question_id'];
$test_id = $_POST['test_id'];

$sql = "DELETE from question_test_mapping where question_id = '$question_id' and test_id = '$test_id'";
mysqli_query($conn,$sql);

?>