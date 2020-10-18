
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
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
            <a class="navbar-brand" href="#pablo">View Data</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <!-- <?php include "navitem.php"; ?> -->
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
                    <h5 class="title">All Class and Students Data</h5>
                  </div>
                  <div class="col-md-2">
                    <select id="options" name="options" class="btn-round" required style="width:100%;">
                        <option id="" selected="true" value="" disabled="disabled">Select class</option>
                       
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button onclick = 'populateTable()' class="btn btn-primary btn-block btn-round" style="margin-top:0px;width:100px !important;float:right !important; onclick='getStudentsFromClass()' ">FIND</button>    
                  </div>
                </div>  
              </div>
              <div class="card-body">
                <!-- <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
                  <input type="hidden" name="general_settings"/>
                  <!-- table contact_table table-striped table-bordered -->
                    
                  <table id="roll_numbers_table">
                  <thead>
                      <tr>
                          <th data-field= "id">ID</th>
                          <th data-field="rollno">Roll Number</th>
                      </tr>
                  </thead>
              </table>
                <!-- </form> -->
              </div>
            </div>
          </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
</body>
<script>

var total_count;
  $( document ).ready(function() {
    $.ajax({
						type: 'POST',
						url: 'get_classes.php',
						success: function (response) {
              response.counter = 'foo';
              var opts = $.parseJSON(response);
                $.each(opts, function(i, d) {
                    $('#options').append('<option value="' + d + '">' + d + '</option>');
                });
						}
		});
  });

  function populateTable(){
    $.ajax({
						type: 'POST',
						url: 'get_student_from_class.php',
            data : {
              'class_name' : $('#options option:selected').val(),
            },
            datatype : 'json',
						success: function (response) {
              var jsondata = JSON.parse(response);
                $('#roll_numbers_table').bootstrapTable({
                  data:jsondata,
                });
          }
    });
  }
  
</script>
</html>