<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");

include '../../database/config.php';
if(isset($_POST['new_test'])) {
  $test_name = $_POST['test_name'];
  $test_subject = $_POST['subject_name'];
  $test_date = $_POST['test_date'];
  $total_questions = $_POST['total_questions'];
  $test_status = $_POST['test_status'];
  $test_class = $_POST['test_class'];
  $status_id = $class_id = -1;

  //getting status id
  $status_sql = "SELECT id from status where name LIKE '%$test_status%'";
  $status = mysqli_query($conn,$status_sql);
  if(mysqli_num_rows($status) > 0) {
    $status_row = mysqli_fetch_assoc($status);
    $status_id = $status_row["id"];
  }
  //getting class id
  $class_sql = "SELECT id from classes where name LIKE '%$test_class%'";
  $class_result = mysqli_query($conn,$class_sql);
  if(mysqli_num_rows($class_result) > 0) {
    $class_row = mysqli_fetch_assoc($class_result);
    $class_id = $class_row["id"];
  }

  function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  $teacher_id = $_SESSION["user_id"];
  //creating new test
  $sql = "INSERT INTO tests(teacher_id, name, date, status_id, subject, total_questions,class_id) VALUES('$teacher_id','$test_name','$test_date','$status_id','$test_subject','$total_questions','$class_id')";
  $result = mysqli_query($conn,$sql);
  $test_id = mysqli_insert_id($conn);
  if($result) {
    //creating student entry in students table for the test
    $sql1 = "select id from student_data where class_id = '$class_id'";
    $result1 = mysqli_query($conn,$sql1);
    $temp = 8 - strlen($test_id);
    while($row1 = mysqli_fetch_assoc($result1)) {
      $rollno = $row1["id"];
      $random = generateRandomString($temp);
      $random = $random . $test_id;
      $sql2 = "INSERT INTO students(test_id,rollno,password,score,status) VALUES ('$test_id','$rollno','$random',0,0)";
      $result2 = mysqli_query($conn,$sql2);
      if($result2) {
        header("Location:dashboard.php");
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <title>
    <?=ucfirst(basename($_SERVER['PHP_SELF'], ".php"));?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- <link type="text/css" rel="stylesheet" href="http://jqueryte.com/css/jquery-te.css" charset="utf-8"> -->
  <link href="../assets/css/main.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <!-- sidebar -->
    <?php
      include "sidebar.php";
    ?>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard Basic Settings</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <?php include "navitem.php"; ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>

      <div class="content" style="min-height: auto;">
        <div class="row">
          <div class="col-md-2"></div>  
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Create New Test</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="new_test">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Test name (title)</label>
                          <input type="text" class="form-control" name="test_name" placeholder="Test name" required/>
                      </div>
                      <div class="form-group">
                        <label>Subject name</label>
                          <input type="text" class="form-control" name="subject_name" placeholder="Subject name" required/>
                      </div>
                      <div class="form-group">
                        <label>Test date</label>
                          <input type="date" class="form-control" name="test_date" placeholder="Test Date" required/>
                      </div>
                      <div class="form-group">
                        <label>Total Questions count</label>
                          <input type="number" class="form-control" name="total_questions" placeholder="Total Questions count" required/>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <select id="options" name="test_status" class="btn-round" required style="width:100%;">
                                  <option selected="true" value="" disabled="disabled">Select test status</option>
                                  <?php

                                      $sql = "select * from status where id IN(1,2)";
                                      $result = mysqli_query($conn,$sql);
                                      while($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                        <option value="<?= $row["name"];?>"><?= $row["name"];?></option>

                                        <?php
                                      }
                                      ?>                                 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="options" name="test_class" class="btn-round" required style="width:100%;">
                                  <option selected="true" value="" disabled="disabled">Select class for test</option>
                                  <?php

                                      $sql = "select * from classes";
                                      $result = mysqli_query($conn,$sql);
                                      while($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                        <option value="<?= $row["name"];?>"><?= $row["name"];?></option>

                                        <?php
                                      }
                                    ?>          
                                </select>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round">CREATE TEST</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
      <!-- footer -->
      <?php
        include "footer.php";
      ?>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>
</html>