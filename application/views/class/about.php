<?php
$image=$this->session->userdata('user_image');
$username=$this->session->userdata('username');
$user_name=$this->session->userdata('user_name');
$useraddress=$this->session->userdata('user_address');
$userhp=$this->session->userdata('user_hp');
$userbirth=$this->session->userdata('user_birth');
$token=$this->uri->segment(3);
// print_r($post);
if ($class['class_type']==1) {
  $type='Private Group';
}else{
  $type='Public Group';
}
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
            <div class="row">
              <div class="col-md-9" id="post">
                <div class="panel panel-default">
                      <div class="panel-heading panel-heading-gray">
                        <button data-toggle="tk-modal-demo" data-modal-options="slide-down" data-content-options="modal-lg" class="btn btn-white btn-xs pull-right"><i class="fa fa-pencil"></i></button>
                        <i class="fa fa-fw fa-info-circle"></i> About
                      </div>
                      <div class="panel-body">
                        <ul class="list-unstyled profile-about margin-none">
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Class Name</span></div>
                              <div class="col-sm-8"><?php echo "$class[class_name]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Class ID</span></div>
                              <div class="col-sm-8"><?php echo "$class[class_nickname]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Type</span></div>
                              <div class="col-sm-8"><?php echo "$type"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Created On</span></div>
                              <div class="col-sm-8"><?php echo date("d M Y",strtotime($class['created_at'])); ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Created By</span></div>
                              <div class="col-sm-8"><?php echo "$class[user_name]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Description</span></div>
                              <div class="col-sm-8"><?php echo "$class[class_info]"; ?></div>
                            </div>
                          </li>
                        </ul>
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

      <!-- Create the modal dynamically via Handlebars -->
            <script id="tk-modal-demo" type="text/x-handlebars-template">
              <div class="modal fade{{#if modalOptions}} {{ modalOptions }}{{/if}}" id="{{ id }}">
                <div class="modal-dialog{{#if dialogOptions}} {{ dialogOptions }}{{/if}}">
                  <div class="v-cell">
                    <div class="modal-content{{#if contentOptions}} {{ contentOptions }}{{/if}}">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Edit Class</h4>
                      </div>
                        <form class="form-horizontal" role="form" action="<?php echo base_url("kelas/updateClass/$token") ?>" method="post">
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="class_name" class="col-sm-3 control-label">Class Name</label>
                          <div class="col-sm-9">
                            <input name="class_name" type="text" class="form-control" id="class_name" placeholder="Type here.." value="<?php echo "$class[class_name]" ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="description" class="col-sm-3 control-label">Description</label>
                          <div class="col-sm-9">
                            <input name="class_info" type="text" class="form-control" id="description" placeholder="Type here.." value="<?php echo "$class[class_info]" ?>">
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label">Class Type</label>
                        <div class="col-sm-9">
                          <select name="class_type" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">
                              <!-- <option disabled selected value>-- Select an option --</option> -->
                              <option <?php if($class['class_type']==1){ echo "selected";} ?> value="1">Publik</option>
                              <option <?php if($class['class_type']==2){ echo "selected";} ?> value="2">Private</option>
                            </select>
                        </div>
                    </div>
                        <!-- <div class="form-group">
                          <label for="password" class="col-sm-3 control-label">Password</label>
                          <div class="col-sm-9">
                            <input name="description" type="text" class="form-control" id="passwod" placeholder="Type here.." value="" ?>">
                          </div>
                        </div> -->
                        
                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </script>

  <?php
      $this->load->view('include/footer');
    ?>
  </div><!-- st-container -->
  <?php
    $this->load->view('include/js');
  ?>
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
</body>
</html>