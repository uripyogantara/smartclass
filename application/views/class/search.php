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
  <title>Search</title>
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
            <?php  
              // print_r($kelas);
              foreach ($kelas as $key => $value) {
            ?>
              <div class="class-content" >
                <div class="row">
                  <div class="col-md-1">
                    <img class="class-image" src="<?php echo base_url("images/class/profile/$value[class_image]") ?>"  >
                  </div>
                  <div class="col-md-8" style="margin-left: 35px;margin-top: 16px;">
                    <div class="row">
                      <div class="col-md-12">
                        <span style="font-size: 14px;"><a href="<?php echo base_url("kelas/view/$value[class_nickname]") ?>"><b><?php echo "$value[class_name]"; ?></b></a></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <span style="color: #ccc; font-size: 12px;"><?php echo "$value[class_type_name]"; ?> Class</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <span style="color: #ccc; font-size: 12px;"><?php echo "$value[jumlah]"; ?> Member</span>
                      </div>
                    </div>
                  </div>
                  <!-- 
                  <?php echo "$value[class_name]"; ?><br>
                  <?php echo "$value[class_name]"; ?><br> -->
                </div>
                
              </div>
            <?php
              }
            ?>
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