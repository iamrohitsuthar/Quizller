<?php
session_start();
if(!isset($_SESSION["user"]))
{
  header("Location:../index.php");
}
include "../../db/config.php";

//Defining update checking variables
  $flag_settings=$flag_about=$flag_logo=$flag_social_settings=$flag_social_settings_add="default";

// UPDATING INFO
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
      echo "<script>console.log('ok');</script>";
      //Updating General settings
        if(isset($_POST['general_settings']))
        {

          $siteName = $_POST['site_name'];
          $siteEmail = $_POST['site_email'];
          $siteContactNumber = $_POST['site_contact_number'];
          $siteLocation = $_POST['site_location'];

          $sql = "UPDATE setting SET value = '$siteName' WHERE name = 'site_name'";
          $res = mysqli_query($conn,$sql);
            if(!$res) {echo "<script>console.log('".mysqli_error($conn)."');</script>";$flag_settings="false";}

          $sql = "UPDATE setting SET value = '$siteEmail' WHERE name = 'email'";
          $res = mysqli_query($conn,$sql);
            if(!$res) {echo "<script>console.log('".mysqli_error($conn)."');</script>";$flag_settings="false";}

          $sql = "UPDATE setting SET value = '$siteLocation' WHERE name = 'location'";
          $res = mysqli_query($conn,$sql);
            if(!$res) {echo "<script>console.log('".mysqli_error($conn)."');</script>";$flag_settings="false";}

          $sql = "UPDATE setting SET value = '$siteContactNumber' WHERE name = 'mobile_no'";
          $res = mysqli_query($conn,$sql);
            if(!$res) {echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";$flag_settings="false";}

          if($flag_settings!="false")
          {
            $flag_settings = "true";
          }
        }

      //Updating Site Logo
        if(isset($_POST['site_logo']))
        {
          $target_dir = "../../images/";
          $target_file = $target_dir . "logo" . str_replace("image/",".",$_FILES['logo_img']['type']);
          $uploadOk = 1;
          $file_type = str_replace("image/","",$_FILES['logo_img']['type']);
          $target_file_name = "logo." . $file_type;

          //checking if file is an image
          $check = getimagesize($_FILES["logo_img"]["tmp_name"]);
          if($check !== false) 
               { $uploadOk = 1;} 
          else 
               { $uploadOk = 0;}

          if($uploadOk == 0)
          {
            $flag_logo = "logonotimage";
          }
          else
          {
            if (move_uploaded_file($_FILES["logo_img"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["logo_img"]["name"]). " has been uploaded.";
                $flag_logo = "true";
                $sql = "UPDATE setting SET value = '$target_file_name' WHERE name = 'logo_url'";
                $res = mysqli_query($conn,$sql);
                  if(!$res) {echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";$flag_logo="false";}
            } else {
                //echo "Sorry, there was an error uploading your file.";
                $flag_logo = "false";
            }
          }


          // echo "<script>console.log(\"". strtolower(pathinfo($target_file,PATHINFO_EXTENSION)) ."\");</script>";
        }

      //Updating About Us
        if(isset($_POST['about_us']))
        {
          echo "<script>console.log('changing about us');</script>";
          $title = $_POST['about_title'];
          $description = $_POST['about_description'];
          $target_dir = "../../images/";
          $target_file = $target_dir . "aboutus" . str_replace("image/",".",$_FILES['about_img']['type']);
          $uploadOk = 1;
          $file_type = str_replace("image/","",$_FILES['about_img']['type']);

          //checking if file is an image
          $check = getimagesize($_FILES["about_img"]["tmp_name"]);
          if($check !== false) 
               { $uploadOk = 1;} 
          else 
               { $uploadOk = 0;}

          if($uploadOk == 0)
          {
            $flag_about = "aboutnotimage";
          }
          else
          {
            echo "<script>console.log('File is an image. Trying to upload it.');</script>";
            if (move_uploaded_file($_FILES["about_img"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["about_img"]["name"]). " has been uploaded.";
                echo "<script>console.log('Upload Successful.');</script>";
                $flag_about = "true";
            } else {
                //echo "Sorry, there was an error uploading your file.";
                echo "<script>console.log('Upload Failed.');</script>";
                $flag_about = "false";
            }
          }

          if($flag_about=="true")
          {
            echo "<script>console.log('Inserting in DB.');</script>";
            $sql = "UPDATE about_us SET title = '$title', description = '$description', image_url = 'images/aboutus.$file_type'";
            $res = mysqli_query($conn,$sql);
              if(!$res) {echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";$flag_about="false";echo "<script>console.log('Insert failed.');</script>";}
              else {$flag_about="true";echo "<script>console.log('Inserted.');</script>";}
          }

          // if($flag_about!="false")
          // {
          //   $flag_about = "true";
          // }

        }

      //Updating Social Settings
        if(isset($_POST['social_settings']))
        {
          
          $social_url=$_POST["social_url"];
          $sql="DELETE from social where url='$social_url'";
          $res=mysqli_query($conn,$sql);
          if(!$res)
          {$flag_social_settings="false";}
          if($flag_social_settings!="false")
          {
            $flag_social_settings = "true";
          }
        	
        }
        //adding social categories
        if(isset($_POST['social_settings_add']))
        {
            echo "<script>console.log(\"".'hi'."\");</script>";
            $category=$_POST["options"];
            $url=$_POST["url"];
            echo "<script>console.log(\"".$category."\");</script>";
            echo "<script>console.log(\"".$url."\");</script>";
            
            $sql="INSERT INTO social(name, url) VALUES('$category','$url')";
            $res=mysqli_query($conn,$sql);
            if(!$res){$flag_social_settings_add="false";}

            if($flag_social_settings_add!="false")
            {
              $flag_social_settings_add="true";
            }
            echo "<script>console.log(\"".$flag_social_settings_add."\");</script>";
            
        }
    }

// Getting site settings info
  $sql="SELECT * from setting";
  $result=mysqli_query($conn,$sql);
  while($main_settings=mysqli_fetch_assoc($result))
  {
    if($main_settings["name"]=="site_name") $site_name=$main_settings["value"];
    if($main_settings["name"]=="email") $email=$main_settings["value"];
    if($main_settings["name"]=="location") $location=$main_settings["value"];
    if($main_settings["name"]=="mobile_no") $mobileno=$main_settings["value"];
    // Getting site logo info
      if($main_settings["name"]=="logo_url") $logo_url=$main_settings["value"];
  }


// Getting about us info
    $sql="SELECT title,description,image_url from about_us";
    $result=mysqli_query($conn,$sql);
    $about=mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="robots" content="noindex">
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
            <a class="navbar-brand" href="#pablo">Website Settings</a>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="title">General Settings</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="general_settings">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">

                        <label>Website Name</label>
                        <div id="webname">
                          <input type="text" class="form-control" name="site_name" placeholder="Website Name" value="<?=$site_name?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Website Name</label>
                        <textarea rows="4" cols="80" class="form-control" name="site_name" placeholder="Company Address" value="Mike"><?=$site_name?></textarea>
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Website Contact Email</label>
                        <input type="text" class="form-control" name="site_email" placeholder="Website Name" value="<?=$email?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Contact Number</label>
                        <div class="row">
                          <div class="col-md-2 pr-1">
                            <input type="text" disabled="" class="form-control" placeholder="+91" value="+91">
                          </div>
                          <div class="col-md-10 pl-1">
                            <input type="number" name="site_contact_number" class="form-control" placeholder="Contact Number" value="<?=$mobileno?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                
                        <textarea id="general_settings" rows="4" cols="80" class="form-control" name="site_location" placeholder="Company Address" value="Mike"><?=$location?></textarea>
                     
                      </div>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round">Update Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Website Logo</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <input type="hidden" name="site_logo">
                  <div class="row center-element">
                    <div class="col-md-5">
                      <div class="form-group">
                          <label>Preview:</label>
                          <img id="logo_preview" class="logo-preview" src="../../images/<?=$logo_url?>" alt="img">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-5 pr-3">
                      <div class="form-group">
                          <input disabled="" id="logo_name" type="text" name="logo_name" class="form-control" placeholder="Image Name" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <input id="logo_img" type="file" accept="image/*" name="logo_img" required="" title="Please Select an Image to Upload">
                            <button style="margin:0" class="btn btn-primary btn-block btn-round">Browse</button>
                          </input>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round">Upload Image</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="title">About Us</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                  <input type="hidden" name="about_us">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Sub Title</label>
                        <input type="text" name="about_title" class="form-control" placeholder="Title" value="<?=$about["title"]?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea id="about_editor" rows="4" cols="80" name="about_description" class="form-control" placeholder="Description" value="Mike"><?=$about["description"];?></textarea>
                      </div>
                    </div>
                  </div>
                    <div class="row center-element py-2">
                    <div class="col-md-5">
                      <div class="form-group">
                          <img id="about_preview" src="../../<?=$about["image_url"]?>" alt="img">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-5 pr-3">
                      <div class="form-group">
                          <input id="about_name" disabled="" type="text" class="form-control" placeholder="Image Name" value="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <input id="about_img" type="file" accept="image/*" name="about_img" required="" title="Please select an image to upload">
                            <button style="margin:0" class="btn btn-primary btn-block btn-round">Browse</button>
                          </input>
                      </div>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round">Update Data</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="title" data-toggle="tooltip" title="The social network links that appear on the footer of the website.">Social Settings</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="hidden" name="social_settings">
                  <div id="elements">
                  	<?php
                  	// Getting social settings info
            				$social="SELECT * from social";
            				$social_result=mysqli_query($conn,$social);
            				while($social_row=mysqli_fetch_assoc($social_result))
            				{
            				?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-3">
                              <p class="py-2"><?=$social_row["name"]?></p>
                            </div>
                            <div class="col-md-8">
                              <input type="text" name="social_url" id="social_url" class="form-control" placeholder="<?=$social_row["name"]?> Url" value="<?=$social_row["url"]?>">
                            </div>
                            <div class="col-md-1 close_icon">
                            <div class="form-group">
                             <!-- <i id="close_icon" class="fa fa-close py-2"></i> -->
                              <button type="submit" class="fa fa-close py-2" style="background-color:transparent; border-color:transparent;"></button>
                         	</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                	   }
                    ?>
                  </div>
              	</form>
                   <hr/>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="social_settings_add">
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Create New</label>
                        <input type="text" id="url" name="url" class="form-control" required="" placeholder="example.com">
                      </div>
                    </div>
                    <div class="col-md-6 py-4">
                        <select id="options" name="options" class="btn-round" required style="width:100%;">
                              <option selected="true" value="" disabled="disabled">Select category</option>
                              <option value="facebook">Facebook</option>
                              <option value="instagram">Instagram</option>
                              <option value="tumblr">Tumblr</option>
                              <option value="twitter">Twitter</option>
                              <option value="linkedin">Linkedin</option>
                              <option value="google-plus">Google Plus</option>
                              <option value="youtube">Youtube</option>           
                        </select>
                    </div>
                  </div>
                  <div class="row center-element">
                    <div class="col-md-8">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block btn-round">Add</button>
                      </div>
                    </div>
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
  <script>
    $(document).ready(function() {
      $('#general_settings').jqte();
      $('#about_editor').jqte();
      
      $('#done').click(function (click)
      {
        click.preventDefault();
        var url = $('#url').val();
        var category = $("#options option:selected").text();
        if(url!="")
        {
          $('#elements').append('<div class="row"> <div class="col-md-12"> <div class="form-group"> <div class="row"> <div class="col-md-3"> <p class="py-2">'+category+'</p> </div> <div class="col-md-8"> <input type="text" class="form-control" value="'+url+'"> </div> <div class="col-md-1 close_icon"> <i id="close_icon" class="fa fa-close py-2"></i> </div> </div> </div> </div> </div>');
          $('#url').val('');
        }
      })

    });
    $(document).on('click','#close_icon',function(click){
      click.preventDefault();
      $(this).closest('.row').remove();
    }); 
  </script>

  <!-- Script to get the name of the file being uploaded -->
  <script type="text/javascript">
    document.getElementById('logo_img').onchange = function () {
      var name = document.getElementById('logo_img');
      var textinput = document.getElementById('logo_name');
      var image = document.getElementById('logo_preview');
      image.src = window.URL.createObjectURL(name.files.item(0));
      var type = (name.files.item(0).type).replace("image/",".");
      textinput.value =  "logo" + type;
    };

    document.getElementById('about_img').onchange = function () {
      var name = document.getElementById('about_img');
      var textinput = document.getElementById('about_name');
      var image = document.getElementById('about_preview');
      image.src = window.URL.createObjectURL(name.files.item(0));
      var type = (name.files.item(0).type).replace("image/",".");
      textinput.value =  "about" + type;
    }
  </script>


  <!-- Checking if Data was updated successfully -->
    <!-- Checked here as above, jquery is not defined to give notifications -->
    <?php

    //Checking if general settings updated successfully
      if($flag_settings=="true")
      {
        ?>

        <script type="text/javascript">
          $.notify({
            message: 'General Settings Updated Successfully' 
          },{
            type: 'success'
          });
        </script>

        <?php
      }
      else if($flag_settings=="default")
      {}
      else
      {
        ?>

          <script type="text/javascript">
            $.notify({
              message: 'There was an error updating general settings' 
            },{
              type: 'danger'
            });
          </script>

        <?php
      }

    //Checking if About Us updated successfully
      if($flag_about=="true")
      {
        ?>

        <script type="text/javascript">
          $.notify({
            message: 'About Us Updated Successfully' 
          },{
            type: 'success'
          });
        </script>

        <?php
      }
      else if($flag_about=="default")
      {}
      else
      {
        ?>

          <script type="text/javascript">
            $.notify({
              message: 'There was an error updating about us' 
            },{
              type: 'danger'
            });
          </script>

        <?php
      }

    //Checking if logo updated successfully
      if($flag_logo=="true")
      {
        ?>

        <script type="text/javascript">
          $.notify({
            message: 'Logo Updated Successfully' 
          },{
            type: 'success'
          });
        </script>

        <?php
      }
      else if($flag_logo=="default")
      {}
      else if($flag_logo=="logonotimage")
      {
        ?>

          <script type="text/javascript">
            $.notify({
              message: 'Logo is not an image' 
            },{
              type: 'danger'
            });
          </script>

        <?php
      }
      else
      {
        ?>

          <script type="text/javascript">
            $.notify({
              message: 'There was an error updating Logo' 
            },{
              type: 'danger'
            });
          </script>

        <?php
      }
     //Checking if social settings updated successfully
      if($flag_social_settings=="true")
      {
        ?>

        <script type="text/javascript">
          $.notify({
            message: 'Social Settings Updated Successfully' 
          },{
            type: 'success'
          });
        </script>

        <?php
      }
      else if($flag_social_settings=="default")
      {}
      else
      {
        ?>

          <script type="text/javascript">
            $.notify({
              message: 'There was an error updating social settings' 
            },{
              type: 'danger'
            });
          </script>

        <?php
      }
      //Checking if new social category added successfully
      if($flag_social_settings_add=="true")
      {
        ?>

        <script type="text/javascript">
          $.notify({
            message: 'Added Successfully' 
          },{
            type: 'success'
          });
        </script>

        <?php
      }
      else if($flag_social_settings_add=="default")
      {}
      else
      {
        ?>

          <script type="text/javascript">
            $.notify({
              message: 'There was an error updating social settings' 
            },{
              type: 'danger'
            });
          </script>

        <?php
      }
    ?>
</body>

</html>