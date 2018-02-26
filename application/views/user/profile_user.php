<?php  
    $image=$this->session->userdata('user_image');
    $username=$this->session->userdata('username');
    $user_name=$this->session->userdata('user_name');
    $useraddress=$this->session->userdata('user_address');
    $userhp=$this->session->userdata('user_hp');
    $email=$this->session->userdata('user_email');
    $userbirth=$this->session->userdata('user_birth');
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer hide-sidebar sidebar-r2" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo "$user[user_name]"; ?></title>
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
  </style>
</head>

<body>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <?php  
    $this->load->view('include/nav');
    ?>
    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">

          <div class="container">

            <div class="cover profile">
              <!-- <div class="overlay overlay-full">
    <div class="v-top">
      <form id="formCover" action="<?php echo base_url("kelas/changeCover/$username"); ?>"  enctype="multipart/form-data" method="POST"">
        <input type="file" name="image_cover" id="fileCover" class="inputcover" multiple="" accept="image/*" />
      </form>
      <a href="#" class="btn btn-cover"><label id="inputfile-label" for="fileCover"><i class="fa fa-pencil"></i></label></a>
    </div>
  </div> -->
              <div class="wrapper">

                <div class="image">
                  <img src="<?php echo base_url("images/class/cover/default.jpg") ?>" alt="people" />
                </div>

                <ul class="friends">
                <?php  
                foreach ($class_member as $key => $value) {
                ?>
                  <li>
                    <a href="<?php echo base_url("kelas/view/$value[class_nickname]") ?>" title="<?php echo "$value[class_name]" ?>">
                      <img src="<?php echo base_url("images/class/profile/$value[class_image]") ?>" alt="people" class="img-responsive">
                    </a>
                  </li>
                <?php
                }
                ?>

              <!-- <div class="overlay overlay-full">
                <div class="v-top">
                  <form id="formCover" action="<?php echo base_url("user/changeCover/$username"); ?>"  enctype="multipart/form-data" method="POST"">
                    <input type="file" name="image_cover" id="fileCover" class="inputcover" multiple="" accept="image/*" />
                  </form>
                  <a href="#" class="btn btn-cover"><label id="inputfile-label" for="fileCover"><i class="fa fa-pencil"></i></label></a>
                </div>
              </div> -->
              </div>

              <div class="cover-info">
                <div class="avatar">
                  <img src="<?php echo base_url("images/user/$user[user_image]") ?>" alt="people" />
                </div>
                <div class="name"><a href="#"><?php 
                echo "$user[user_name]"; ?></a></div>
                <ul class="cover-nav">

                  <!-- <li><a href="user-public-timeline.html"><i class="fa fa-fw icon-ship-wheel"></i> Timeline</a></li>
                  <li><a href="user-public-profile.html"><i class="fa fa-fw icon-user-1"></i> Profile</a></li> -->

                </ul>
              </div>
            </div>
            

            <!-- About -->
            <div class="row">
              <div class="col-md-12" id="post">
                <div class="panel panel-default">
                      <div class="panel-heading panel-heading-gray">
                      <?php
                      if ($this->session->userdata('user_id')==$user['user_id']) {
                      ?>
                      <button data-toggle="tk-modal-demo" data-modal-options="slide-down" data-content-options="modal-lg" class="btn btn-white btn-xs pull-right"><i class="fa fa-pencil"></i></button>
                      <?php
                      }
                      ?>
                      
                        <i class="fa fa-fw icon-user-1"></i> Profiles
                      </div>
                      <div class="panel-body">
                        <ul class="list-unstyled profile-about margin-none">
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Name</span></div>
                              <div class="col-sm-8"><?php echo "$user[user_name]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Address</span></div>
                              <div class="col-sm-8"><?php echo "$user[user_address]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Handphone</span></div>
                              <div class="col-sm-8"><?php echo "$user[user_hp]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Email</span></div>
                              <div class="col-sm-8"><?php echo "$user[user_email]"; ?></div>
                            </div>
                          </li>
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Date Birth</span></div>
                              <div class="col-sm-8"><?php echo date("d M Y",strtotime($user['user_birth'])); ?></div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      </div>
                      <!-- /About -->
             </div>
            </div>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- // Footer -->
    <!-- Create the modal dynamically via Handlebars -->
            <script id="tk-modal-demo" type="text/x-handlebars-template">
              <div class="modal fade{{#if modalOptions}} {{ modalOptions }}{{/if}}" id="{{ id }}">
                <div class="modal-dialog{{#if dialogOptions}} {{ dialogOptions }}{{/if}}">
                  <div class="v-cell">
                    <div class="modal-content{{#if contentOptions}} {{ contentOptions }}{{/if}}">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Edit Profile</h4>
                      </div>
                        <form class="form-horizontal" role="form" action="<?php echo base_url("user/update/$username") ?>" method="post">
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="name" class="col-sm-3 control-label">Name</label>
                          <div class="col-sm-9">
                            <input name="user_name" type="text" class="form-control" id="name" placeholder="Type here.." value="<?php echo "$user[user_name]" ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Address</label>
                          <div class="col-sm-9">
                            <textarea name="user_address" class="form-control" rows="5" ><?php echo "$user[user_address]" ?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="Handphone" class="col-sm-3 control-label">Handphone</label>
                          <div class="col-sm-9">
                            <input name="user_hp" type="number" class="form-control" id="Handphone" placeholder="Type here.." value="<?php echo "$user[user_hp]" ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="Email" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                            <input name="user_email" value="<?php echo "$user[user_email]" ?>" type="Email" class="form-control" id="Email" placeholder="Type here..">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="date" class="col-sm-3 control-label">Date Birth</label>
                          <div class="col-sm-9">
                            <input name="user_birth" value="<?php echo "$user[user_birth]" ?>" type="date" class="form-control" id="date" placeholder="Type here..">
                          </div>
                        </div>
                        
                      
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

  </div>
  <!-- /st-container -->
  <?php  
  $this->load->view('include/js');
  ?>
</body>

</html>