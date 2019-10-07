<?php
session_start();
if(!isset($_SESSION["user"]))
{
  header("Location:../index.php");
}
include "../../db/config.php";

// //Defining update checking variables
//   $flag_settings=$flag_about=$flag_logo=$flag_social_settings=$flag_social_settings_add="default";

// // UPDATING INFO
//     if($_SERVER['REQUEST_METHOD']=='POST')
//     {
//       echo "<script>console.log('ok');</script>";
//       //Updating General settings
//         if(isset($_POST['general_settings']))
//         {

//           $siteName = $_POST['site_name'];
//           $siteEmail = $_POST['site_email'];
//           $siteContactNumber = $_POST['site_contact_number'];
//           $siteLocation = $_POST['site_location'];

//           $sql = "UPDATE setting SET value = '$siteName' WHERE name = 'site_name'";
//           $res = mysqli_query($conn,$sql);
//             if(!$res) {echo "<script>console.log('".mysqli_error($conn)."');</script>";$flag_settings="false";}

//           $sql = "UPDATE setting SET value = '$siteEmail' WHERE name = 'email'";
//           $res = mysqli_query($conn,$sql);
//             if(!$res) {echo "<script>console.log('".mysqli_error($conn)."');</script>";$flag_settings="false";}

//           $sql = "UPDATE setting SET value = '$siteLocation' WHERE name = 'location'";
//           $res = mysqli_query($conn,$sql);
//             if(!$res) {echo "<script>console.log('".mysqli_error($conn)."');</script>";$flag_settings="false";}

//           $sql = "UPDATE setting SET value = '$siteContactNumber' WHERE name = 'mobile_no'";
//           $res = mysqli_query($conn,$sql);
//             if(!$res) {echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";$flag_settings="false";}

//           if($flag_settings!="false")
//           {
//             $flag_settings = "true";
//           }
//         }

//       //Updating Site Logo
//         if(isset($_POST['site_logo']))
//         {
//           $target_dir = "../../images/";
//           $target_file = $target_dir . "logo" . str_replace("image/",".",$_FILES['logo_img']['type']);
//           $uploadOk = 1;
//           $file_type = str_replace("image/","",$_FILES['logo_img']['type']);
//           $target_file_name = "logo." . $file_type;

//           //checking if file is an image
//           $check = getimagesize($_FILES["logo_img"]["tmp_name"]);
//           if($check !== false) 
//                { $uploadOk = 1;} 
//           else 
//                { $uploadOk = 0;}

//           if($uploadOk == 0)
//           {
//             $flag_logo = "logonotimage";
//           }
//           else
//           {
//             if (move_uploaded_file($_FILES["logo_img"]["tmp_name"], $target_file)) {
//                 //echo "The file ". basename( $_FILES["logo_img"]["name"]). " has been uploaded.";
//                 $flag_logo = "true";
//                 $sql = "UPDATE setting SET value = '$target_file_name' WHERE name = 'logo_url'";
//                 $res = mysqli_query($conn,$sql);
//                   if(!$res) {echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";$flag_logo="false";}
//             } else {
//                 //echo "Sorry, there was an error uploading your file.";
//                 $flag_logo = "false";
//             }
//           }


//           // echo "<script>console.log(\"". strtolower(pathinfo($target_file,PATHINFO_EXTENSION)) ."\");</script>";
//         }

//       //Updating About Us
//         if(isset($_POST['about_us']))
//         {
//           echo "<script>console.log('changing about us');</script>";
//           $title = $_POST['about_title'];
//           $description = $_POST['about_description'];
//           $target_dir = "../../images/";
//           $target_file = $target_dir . "aboutus" . str_replace("image/",".",$_FILES['about_img']['type']);
//           $uploadOk = 1;
//           $file_type = str_replace("image/","",$_FILES['about_img']['type']);

//           //checking if file is an image
//           $check = getimagesize($_FILES["about_img"]["tmp_name"]);
//           if($check !== false) 
//                { $uploadOk = 1;} 
//           else 
//                { $uploadOk = 0;}

//           if($uploadOk == 0)
//           {
//             $flag_about = "aboutnotimage";
//           }
//           else
//           {
//             echo "<script>console.log('File is an image. Trying to upload it.');</script>";
//             if (move_uploaded_file($_FILES["about_img"]["tmp_name"], $target_file)) {
//                 //echo "The file ". basename( $_FILES["about_img"]["name"]). " has been uploaded.";
//                 echo "<script>console.log('Upload Successful.');</script>";
//                 $flag_about = "true";
//             } else {
//                 //echo "Sorry, there was an error uploading your file.";
//                 echo "<script>console.log('Upload Failed.');</script>";
//                 $flag_about = "false";
//             }
//           }

//           if($flag_about=="true")
//           {
//             echo "<script>console.log('Inserting in DB.');</script>";
//             $sql = "UPDATE about_us SET title = '$title', description = '$description', image_url = 'images/aboutus.$file_type'";
//             $res = mysqli_query($conn,$sql);
//               if(!$res) {echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";$flag_about="false";echo "<script>console.log('Insert failed.');</script>";}
//               else {$flag_about="true";echo "<script>console.log('Inserted.');</script>";}
//           }

//           // if($flag_about!="false")
//           // {
//           //   $flag_about = "true";
//           // }

//         }

//       //Updating Social Settings
//         if(isset($_POST['social_settings']))
//         {
          
//           $social_url=$_POST["social_url"];
//           $sql="DELETE from social where url='$social_url'";
//           $res=mysqli_query($conn,$sql);
//           if(!$res)
//           {$flag_social_settings="false";}
//           if($flag_social_settings!="false")
//           {
//             $flag_social_settings = "true";
//           }
        	
//         }
//         //adding social categories
//         if(isset($_POST['social_settings_add']))
//         {
//             echo "<script>console.log(\"".'hi'."\");</script>";
//             $category=$_POST["options"];
//             $url=$_POST["url"];
//             echo "<script>console.log(\"".$category."\");</script>";
//             echo "<script>console.log(\"".$url."\");</script>";
            
//             $sql="INSERT INTO social(name, url) VALUES('$category','$url')";
//             $res=mysqli_query($conn,$sql);
//             if(!$res){$flag_social_settings_add="false";}

//             if($flag_social_settings_add!="false")
//             {
//               $flag_social_settings_add="true";
//             }
//             echo "<script>console.log(\"".$flag_social_settings_add."\");</script>";
            
//         }
//     }

// // Getting site settings info
//   $sql="SELECT * from setting";
//   $result=mysqli_query($conn,$sql);
//   while($main_settings=mysqli_fetch_assoc($result))
//   {
//     if($main_settings["name"]=="site_name") $site_name=$main_settings["value"];
//     if($main_settings["name"]=="email") $email=$main_settings["value"];
//     if($main_settings["name"]=="location") $location=$main_settings["value"];
//     if($main_settings["name"]=="mobile_no") $mobileno=$main_settings["value"];
//     // Getting site logo info
//       if($main_settings["name"]=="logo_url") $logo_url=$main_settings["value"];
//   }


// // Getting about us info
//     $sql="SELECT title,description,image_url from about_us";
//     $result=mysqli_query($conn,$sql);
//     $about=mysqli_fetch_assoc($result);

// ?>
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
  <link type="text/css" rel="stylesheet" href="http://jqueryte.com/css/jquery-te.css" charset="utf-8">
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <h5 class="title">Pending Quiz Tests</h5>
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-round" style="margin-top:0px;width:100px !important;float:right !important;">NEW</button>
                  </div>
                </div>  
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="general_settings"/>
                  <div id="no-data">
                    <center>
                      <img src="../assets/img/no-data.svg" height="400" width="400"/>
                      <center><h5>No Data</h5></center>
                    </center>
                  </div>

                </form>
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
  <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script>
</body>
</html>