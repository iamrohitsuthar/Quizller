<?php
    if(isset($_SESSION['test_ongoing']))
        header("Location: files/quiz.php");
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="iamrohitsuthar,Iamrohitsuthar,i am rohit suthar,Hi i am rohit suthar,Hi iamrohitsuthar,i am Rohit Suthar,I am RohitSuthar,mrrohitsuthar,rohit suthar,RohitSuthar,Rohit Suthar,rohitsuthar website,rohit suthar website,programmer,amravati,rohitsuthar,rohit suthar blog,Rohit Suthar,Rohit,Suthar,Rohit Karma,Suthar Rohit,iamrohitsuthar blog,iamrohitsuthar twitter,iamrohitsuthar instagram,iamrohitsuthar stackoverflow,iamrohitsuthar github,iamrohitsuthar linkedin,iamrohitsuthar website">
    <title>Quizller</title>
    <link rel="icon" type="image/png" href="admin/assets/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
</head>

<body>
    <!-- Header -->
    <header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="wrap_header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <img src="images/icons/logo.png" alt="IMG-LOGO">
                </a>

                <!-- Header Icon -->

            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="index.php" class="logo-mobile">
                <img src="images/icons/logo.png" alt="IMG-LOGO">
            </a>
        </div>
        </div>
    </header>

    <section>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="images/img-01.png" alt="IMG">
                    </div>
                    <div class="login100-form validate-form">
                    <span class="login100-form-title">
                        Student Login
                    </span>
                    
                    <div class="wrap-input100 validate-input">
                        <input class="input100" id="studentRollNumber" type="text" name="rollNumber"
                            placeholder="Roll Number" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </span>
                        <span class="error text-danger" id="empty_roll_number_field"></span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" id="studentPassword" type="password" name="password"
                            placeholder="Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <span class="error text-danger" id="empty_roll_password_field"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" onclick="login()">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {

            if (Cookies.get('last_question_was_answered') != undefined) {
                Cookies.remove('last_question_was_answered');
                Cookies.remove('last_question');
            }
            if (Cookies.get('test_submitted_status') != undefined)
                Cookies.remove('test_submitted_status');    
        });


        $('.js-tilt').tilt({
            scale: 1.1
        })

        // Define the login function to validate student login
        function login() {
            // Retrieve input field values
            var studentRollNumber = document.getElementById("studentRollNumber").value;
            var studentPassword = document.getElementById("studentPassword").value;

            // Check if username and password are provided
            if (!studentRollNumber || !studentPassword) {
                document.getElementById("empty_roll_number_field").innerText = "Rollno and password are required.";
                return false;
            }

            // Check if username is at least 4 characters long
            if (studentRollNumber.length < 4) {
                document.getElementById("empty_roll_number_field").innerText = "Rollno must be at least 4 characters long.";
                return false;
            } else {
                document.getElementById("empty_roll_number_field").innerText = "";
            }

            // Check if password is at least 6 characters long
            if (studentPassword.length < 6) {
                document.getElementById("empty_roll_password_field").innerText = "Password must be at least 6 characters long.";
                return false;
            } else {
                document.getElementById("empty_roll_password_field").innerText = "";
            }

            // If all validations pass, submit the form or perform login action
            return true;
        }
    </script>
</body>
</html>
