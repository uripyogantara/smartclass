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
  <title><?php echo "$class[class_name]"; ?></title>
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
            $this->load->view('class/cover');
            ?>

            <div class="row" data-toggle="isotope">
            <?php  
                // print_r($all_member);
                foreach ($all_member as $key => $value) {
                  if ($value['user_type']==1) {
                    $type='Admin';
                  }else{
                    $type='Member';
                  }
                ?>
              <div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="<?php echo base_url("images/user/$value[user_image]") ?>" alt="people" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="#"><?php echo "$value[user_name]";  ?></a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i>  <?php echo "$type"; ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <p class="common-friends">Member of the group :</p>
                    <div class="user-friend-list">
                      <?php  
                      foreach ($value['class_member'] as $class_member) {
                      ?>
                      <a href="<?php echo base_url("kelas/view/$class_member[class_nickname]") ?>" title="<?php echo "$class_member[class_name]" ?>">
                        <img src="<?php echo base_url("images/class/profile/$class_member[class_image]") ?>" alt="nama kelas" class="img-circle" style="height: 35px; margin: 5px;" />
                      </a>

                      <?php
                      }
                      ?>
                    </div>
                  </div>
                  <?php  
                  if ($value['user_type']==0 && $detail_class['user_type']==1) {
                  ?>
                    <div class="panel-footer">
                      <a href="#" data-id="<?php echo $value['detail_class_id'] ?>" class="remove btn btn-default btn-sm">Kick  <i class="fa fa-sign-out"></i></a>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              </div>

              <?php
                }
                ?>
              
              </div>
            </div>

                  





              
             </div>
           <div class="col-md-3">
            <ul class="nav timeline-months">
              <li class="active"><a href="#october"><i class="fa fa-calendar fa-fw"></i>October</a></li>
              <li><a href="#september"><i class="fa fa-calendar fa-fw"></i>September</a></li>
              <li><a href="#august"><i class="fa fa-calendar fa-fw"></i>August</a></li>
              <li><a href="#july"><i class="fa fa-calendar fa-fw"></i>July</a></li>
              <li><a href="#june"><i class="fa fa-calendar fa-fw"></i>June</a></li>
              <li><a href="#may"><i class="fa fa-calendar fa-fw"></i>May</a></li>
            </ul>
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
  <div class="modal fade" id="coverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content" >
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel" align="center">Change Cover</h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                  <button type="button" class="coverBtn btn btn-primary" id="btn-upload">Change</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <?php
    $this->load->view('include/js');
  ?>
  <script type="text/javascript">
    $('.remove').click(function(){
      var id=$(this).attr('data-id');
      swal({
        title: "Are You Sure?",
        text: "You will not able to recover this member!",
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