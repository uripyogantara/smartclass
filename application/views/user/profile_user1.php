<?php
$image=$this->session->userdata('user_image');
$username=$this->session->userdata('username');
$user_name=$this->session->userdata('user_name');
$useraddress=$this->session->userdata('user_address');
$userhp=$this->session->userdata('user_hp');
$userbirth=$this->session->userdata('user_birth');
$token=$this->uri->segment(3);
// print_r($post);
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
  <?php
  $this->load->view('include/css');
  ?>
  <style type="text/css">
    .class-content{
      background-color: white; 
      /*margin-bottom: 10px;*/
      padding-top: 5px;
      border-bottom: 1px solid #ccc!important;
    }

    .class-image{
      border-radius: 50%;
      height: 100px;
      width: auto;
      padding-right: 10px;
      padding-top:  10px;
      padding-bottom: 10px;
      padding-left: 18px;

    }
  </style>
</head>
<body>

  <div class="st-container">
    <?php
    $this->load->view('include/nav');
    ?>
    
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">

          <div class="container-fluid">
            
          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div><!-- /st-pusher -->

    <?php
    $this->load->view('include/footer');
    ?>
  </div><!-- st-container -->
  <?php
  $this->load->view('include/js');
  ?>
</body>
</html>