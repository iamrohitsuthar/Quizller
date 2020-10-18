<?php
session_start();
if(!isset($_SESSION["user_id"]))
  header("Location:../index.php");
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

  <!--php code to redirect to the test details php after successfull question add-->
    <?php
      include '../../database/config.php';
      $test_id = $_POST['test_id'];
    ?>
    <form id="form-completed" method="POST" action="test_details.php">
        <input type="hidden" name="test_id" value="<?= $test_id;?>">
    </form>
    <script>
        function completed() {
          document.getElementById("form-completed").submit();
        }
    </script>
    <?php
      if(isset($_POST['add_question'])) {
        echo "<script>console.log('".$test_id."');</script>";
        echo "<script>console.log('here');</script>";
        $title = $_POST['title'];
        $op_a = $_POST['op_a'];
        $op_b = $_POST['op_b'];
        $op_c = $_POST['op_c'];
        $op_d = $_POST['op_d'];
        $op_correct = $_POST['op_correct'];
        $score = $_POST['score'];

        $op_correct_text = "";

        if($op_correct == "A" || $op_correct == "a") {
          $op_correct_text = "a";
        }
        else if($op_correct == "B" || $op_correct == "b") {
          $op_correct_text = "b";
        }
        else if($op_correct == "C" || $op_correct == "c") {
          $op_correct_text = "c";
        }
        else if($op_correct == "D" || $op_correct == "d") {
          $op_correct_text = "d";
        }
        echo "<script>console.log('".$title."');</script>";
        echo "<script>console.log('".$op_a."');</script>";
        echo "<script>console.log('".$op_b."');</script>";
        echo "<script>console.log('".$op_c."');</script>";
        echo "<script>console.log('".$op_d."');</script>";
        echo "<script>console.log('".$op_correct_text."');</script>";
        echo "<script>console.log('".$score."');</script>";
        
        
        $sql = "INSERT INTO Questions(title,optionA,optionB,optionC,optionD,correctAns,score) values('$title','$op_a','$op_b','$op_c','$op_d','$op_correct_text','$score')";
        $result = mysqli_query($conn,$sql);
        echo "<script>console.log('done 1');</script>";
        if($result) {
          echo "<script>console.log('done 2');</script>";
          $question_id = mysqli_insert_id($conn);
          $sql1 = "INSERT INTO question_test_mapping VALUES('$question_id','$test_id')";
          mysqli_query($conn,$sql1);
          $sql2 = "INSERT INTO score(test_id, question_id, correct_count, wrong_count) VALUES('$test_id','$question_id',0,0)";
          mysqli_query($conn,$sql2);
          echo '<script type="text/javascript">',
        'completed();',
        '</script>';
        }
      }
    ?>

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
            <a class="navbar-brand" href="#pablo">Add New Question</a>
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
                <h5 class="title">Add New Question</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="add_question">
                  <input type="hidden" name="test_id" value="<?= $test_id;?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Question title</label>
                          <input type="text" class="form-control" name="title" placeholder="Question title" required/>
                      </div>
                      <div class="form-group">
                        <label>Option (A)</label>
                          <input type="text" class="form-control" name="op_a" placeholder="Option (A)" required/>
                      </div>
                      <div class="form-group">
                        <label>Option (B)</label>
                          <input type="text" class="form-control" name="op_b" placeholder="Option (B)" required/>
                      </div>
                      <div class="form-group">
                        <label>Option (C)</label>
                          <input type="text" class="form-control" name="op_c" placeholder="Option (C)" required/>
                      </div>
                      <div class="form-group">
                        <label>Option (D)</label>
                          <input type="text" class="form-control" name="op_d" placeholder="Option (D)" required/>
                      </div>
                      <div class="form-group">
                        <label>Correct Option (A/B/C/D)</label>
                          <input type="text" class="form-control" name="op_correct" placeholder="Correct Option" required/>
                      </div>
                      <div class="form-group">
                        <label>Score</label>
                          <input type="text" class="form-control" name="score" placeholder="Score" required/>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round">ADD QUESTION</button>
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