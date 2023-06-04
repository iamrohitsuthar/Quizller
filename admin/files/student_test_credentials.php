<?php
    include '../../database/config.php';
    include "../assets/vendor/fpdf/fpdf.php";

    session_start();
    if(!isset($_SESSION["user_id"]))
      header("Location:../index.php");
    $test_id = $_POST['test_id'];


   	if(isset($_POST['print'])) {
   		$test_id = $_POST['test_id'];

		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);

        $sql = "SELECT id,rollno,password from students where test_id = '$test_id' order by id ASC";
        $result = mysqli_query($conn,$sql);
        $i = 1;
        while($row = mysqli_fetch_assoc($result)) {
            $rollno_id = $row["rollno"];
            $sql1 = "SELECT * from student_data where id = $rollno_id";
            $result1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($result1);
        	$pdf->Cell(30,12,$row1["rollno"],1,0,"C");
        	if( $i%3 == 0 )
        		$pdf->MultiCell(30,12,$row["password"]."\n",1,"C");
        	else
    		{
    			$pdf->Cell(30,12,$row["password"]."\t",1,0,"C");
    			$pdf->Cell(5,12,"\t",0,0,"C");
    		}
        	$i++;
   		}
   		$pdf->Output();   	
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
            <a class="navbar-brand" href="#pablo">Student Test Credentials</a>
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
          <div class="col-md-12">
            <div class="card" style="min-height:400px;">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <h5 class="title">Students Test Credentials</h5>
                  </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-round" onclick="completed()" style="margin-top:0px;width:100px !important;float:right !important;">Print</button>
                  </div>
                </div>  
              </div>
              <div class="card-body" id="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="general_settings"/>
                    <table class="table contact_table table-striped table-bordered">
                        <thead class=" text-primary">
                        <th>
                            SERIAL ID
                        </th>
                        <th>
                            ROLL NUMBER
                        </th>
                        <th>
                            Password
                        </th>
                        </thead>
                        <tbody>  
                        <?php

                            $sql = "SELECT id,rollno,password from students where test_id = '$test_id' order by id ASC";
                            $result = mysqli_query($conn,$sql);
                            $i = 1;
                            while($row = mysqli_fetch_assoc($result)) {
                                $rollno_id = $row["rollno"];
                                $sql1 = "SELECT * from student_data where id = $rollno_id";
                                $result1 = mysqli_query($conn,$sql1);
                                $row1 = mysqli_fetch_assoc($result1);
                            ?>    
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $row1["rollno"];?>
                                    </td>     
                                    <td>
                                        <?= $row["password"];?>
                                    </td>     
                                </tr>
                        <?php
                            $i++;
                            }       
                        ?>                         
                        </tbody>
                    </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <form id="form-print" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" target='_blank'>
        <input type="hidden" name="print">
        <input type="hidden" name="test_id" value="<?= $test_id;?>">
      </form>
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
<script>
  function redirect_to_new_test() {
    window.location = "new_test.php";
  }

      function completed() {
      document.getElementById("form-print").submit();
    }

</script>
</html>