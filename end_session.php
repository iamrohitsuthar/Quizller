<?php
    session_start();

    if($_POST['message'] == 1)
        echo "Aborted";
    else
        echo "Completed";

    session_destroy();   
?>