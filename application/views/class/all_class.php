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
    .inputcover {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
    .image-cover{
      max-width: auto; max-height: 400px
    }
  </style>
  <title>All Class</title>
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
            <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">All Class</h1>
              </div>
            </div>
            <div class="row" data-toggle="isotope">
            <?php  
                // print_r($all_member);
                foreach ($all_class as $key => $value) {
                  
                ?>
              <div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="<?php echo base_url("images/class/profile/$value[class_image]") ?>" alt="people" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="<?php echo base_url("kelas/view/$value[class_nickname]") ?>"><?php echo "$value[class_name]";  ?></a></h4>
                        <!-- <div class="profile-icons">
                          <span><i class="fa fa-users"></i>  <?php echo "$type"; ?></span>
                        </div> -->
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <p class="common-friends">Member of the group :</p>
                    <div class="user-friend-list">
                      <?php  
                      foreach ($value['member'] as $class_member) {
                      ?>
                      <a href="<?php echo base_url("user/view/$class_member[user_username]") ?>" title="<?php echo "$class_member[user_name]" ?>">
                        <img src="<?php echo base_url("images/user/$class_member[user_image]") ?>" alt="nama kelas" class="img-circle" style="height: 35px; margin: 5px;" />
                      </a>

                      <?php
                      }
                      ?>
                    </div>
                  </div>
                  
                </div>
              </div>

              <?php
                }
                ?>
              
              </div>
            </div>

                  





              
             </div>
        </div>
        
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
  <script type="text/javascript">
    $('.remove').click(function(){
      var id=$(this).attr('data-id');
      swal({
        title: "Are You Sure?",
        text: "You will not able to recover this comment!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#26a69a",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function(){
        $.post(
          '<?php echo base_url("kelas/removemember") ?>',
          {id:id},
          function(returnedData){
            window.location.reload();
            console.log(returnedData);
        }).fail(function(){
          console.log("error");
        });
      });
    });
  </script>
</body>
</html>