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
    .myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
  }

  .myImg:hover {opacity: 0.7;}
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
            <div class="row">
              <div class="col-md-9" id="post">
            <div class="panel panel-default">
                  <div class="panel-heading panel-heading-gray">
                    <!-- <div class="pull-right">
                      <a href="#" class="btn btn-primary btn-xs">Add <i class="fa fa-plus"></i></a>
                    </div> -->
                    <i class="fa fa-photo"></i> Photo
                  </div>
                  <div class="panel-body">
                    <ul class="img-grid">
                    <?php  
                foreach ($detail_post as $key => $value) {
                ?>
                      <li>
                        <a href="#">
                          <img style="height: 100px; margin: 5px;" src="<?php echo base_url("images/post/$value[detail_post_image]") ?>" alt="image" class="myImg" />
                        </a>
                      </li>
                      <?php
                }
                ?>
                    </ul>
                  </div>
                </div>
              </div>
                
                
                  





              

           <!-- <div class="col-md-3">
            <ul class="nav timeline-months">
              <li class="active"><a href="#october"><i class="fa fa-calendar fa-fw"></i>October</a></li>
              <li><a href="#september"><i class="fa fa-calendar fa-fw"></i>September</a></li>
              <li><a href="#august"><i class="fa fa-calendar fa-fw"></i>August</a></li>
              <li><a href="#july"><i class="fa fa-calendar fa-fw"></i>July</a></li>
              <li><a href="#june"><i class="fa fa-calendar fa-fw"></i>June</a></li>
              <li><a href="#may"><i class="fa fa-calendar fa-fw"></i>May</a></li>
            </ul>
          </div> -->
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
  <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 12%">
        <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <img id="modal-image" style="max-width: auto; max-height: 400px" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(".myImg").click(function(){
      var src=$(this).attr('src');
      $('#imageModal').modal('show');
      $('#modal-image').attr('src',src);
    });
</script>
</body>
</html>