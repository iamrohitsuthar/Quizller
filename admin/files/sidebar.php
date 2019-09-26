<?php
/*getting active page name*/
$activePage = basename($_SERVER['PHP_SELF'], ".php");
$sql="SELECT * from setting";
$result=mysqli_query($conn,$sql);
while($main_settings=mysqli_fetch_assoc($result))
{
 if($main_settings["name"]=="site_name") $site_name=$main_settings["value"];
 if($main_settings["name"]=="logo_url") $logo_url=$main_settings["value"];
}
?>
 <div class="sidebar" data-color="orange">
      <div class="logo" style="padding:unset;">
        <a href="settings.php" class="simple-text logo-mini" style="width:100px;padding-left:10px;">
            <img src="../assets/img/logo.png"/>
         </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?=($activePage=='settings')? 'active': ''; ?>">
            <a href="./settings.php">
              <i class="now-ui-icons design_app"></i>
              <p>Website Settings</p>
            </a>
          </li>
          <li class="<?=($activePage=='slider' || $activePage=='editslider' || $activePage=='newslider')? 'active': ''; ?>">
            <a href="./slider.php">
              <i class="now-ui-icons education_atom"></i>
              <p>Slider Settings</p>
            </a>
          </li>
          <li class="<?=($activePage=='services' || $activePage=='editsubservice' || $activePage=='newsubservice')? 'active': ''; ?>">
            <a href="./services.php">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Services</p>
            </a>
          </li>
          <li class="<?=($activePage=='contactemails')? 'active': ''; ?>">
            <a href="./contactemails.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Contact Emails</p>
            </a>
          </li>
          <li class="<?=($activePage=='map')? 'active': ''; ?>">
            <a href="./map.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>Maps</p>
            </a>
          </li>
        </ul>
      </div>
    </div>