<?php
$username=$this->session->userdata('username');
$user_name=$this->session->userdata('user_name');
$email=$this->session->userdata('user_email');
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l1" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Smartclass</title>
  <style type="text/css">
    .deactive{
      opacity: 0.5;
    }
    .ava:hover {opacity: 1;}
    .inputfile {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
  </style>

<?php
      $this->load->view('include/css');
    ?>

</head>

<body>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">
     <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">SmartClass</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       
        <!-- /.navbar-collapse -->

      </div>
    </div>


      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">

          <div class="container-fluid">

            <div class="page-section">
              <div class="row">
                <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">


                  <div class="wizard-container wizard-1" id="wizard-demo-1">
                    <div data-scrollable-h>
                      <ul class="wiz-progress">
                        <li class="active">Personal Details</li>
                        <li>Profile Picture</li>
                        <li>Welcome</li>
                      </ul>
                    </div>
                    <form enctype="multipart/form-data" action="<?php echo base_url("user/editpicture") ?>" data-toggle="wizard" class="max-width-400 h-center" method="post">

                      <fieldset class="step">
                        <div class="page-section-heading">
                          <h2 class="text-h3 margin-v-0">Create your account</h2>
                          <h3 class="text-h4 margin-v-10 text-grey-400">This is a Personal Details form</h3>
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-address">Address :</label>
                          <input class="form-control" type="text" id="wiz-address" placeholder="Type Your Address" />
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-phone">Handphone :</label>
                          <input class="form-control" type="number" id="wiz-phone" placeholder="Type Your Number" />
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-date">Date :</label>
                          <input class="form-control" type="date" id="wiz-date" placeholder="Your birth" />
                        </div>
                        <div class="row">
                          <div class="col-xs-6">
                            <button type="button" class="wiz-prev btn btn-default">Previous</button>
                          </div>
                          <div class="col-xs-6 text-right">
                            <button id="btn-next1" type="button" class="wiz-next btn btn-primary" disabled="disabled">Next</button>
                          </div>
                        </div>
                      </fieldset>

                      <fieldset class="step">
                      <input type="file" name="picture" id="file" class="inputfile" multiple="" accept="image/*" />
                      <div class="row">
                        <?php
                          for ($i=1; $i <= 16 ; $i++) {
                        ?>
                            <div class="col-md-2" style="margin-bottom: 5px">
                              <a href="#">
                                <img data-image="<?php echo $i.".png" ?>" class="ava deactive img-circle" src="<?php echo base_url("images/user/$i.png") ?>" alt="people" width="50px" />
                              </a>
                            </div>
                        <?php
                            # code...
                          }
                        ?>
                        <div class="col-md-2" style="margin-bottom: 5px">
                          <a href="#">
                            <label id="inputfile-label" for="file"><img id="newImage" class="img-circle ava deactive" src="<?php echo base_url("images/user/17.png") ?>" alt="people" width="50px" />
                            </label>
                          </a>
                        </div>
                        

                      </div>
                      <br>
                        <button type="button" class="wiz-prev btn btn-default">Previous</button>
                        <button type="button" id="btn-next2" class="wiz-next btn btn-primary" disabled="disabled">Next</button>
                      </fieldset>

                      <fieldset class="step">
                        <div class="page-section-heading">
                          <h2 class="text-h3 margin-v-0">Welcome, <?php echo "$user_name"; ?></h2>
                          <h3 class="text-h4 margin-v-10 text-grey-400">Please check your personal account</h3>
                        </div>
                        <center><img id="imageTemp" src="" alt="people" class="img-circle" width="100px" style="margin-bottom: 20px" /></center>
                        <div class="form-group form-control-default">
                          <label for="wiz-username1">Username :</label>
                          <input class="form-control" type="text" id="wiz-username1" placeholder="Type Your Username" readonly="" value="<?php echo "$username" ?>" />
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-name1">name :</label>
                          <input class="form-control" type="tel" id="wiz-name" placeholder="Type Your Name" readonly="" value="<?php echo "$user_name"; ?>" />
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-address1">Address :</label>
                          <input name="user_address" class="form-control" type="tel" id="wiz-address1" placeholder="Type Your Address" readonly=""/>
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-phone1">Handphone :</label>
                          <input name="user_hp" class="form-control" type="number" id="wiz-phone1" placeholder="Type Your Number" readonly=""/>
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-email1">Email :</label>
                          <input name="user_email" class="form-control" type="Email" id="wiz-email1" placeholder="Type Your Email" readonly="" value="<?php echo $email; ?>" />
                        </div>
                        <div class="form-group form-control-default">
                          <label for="wiz-date1">Date :</label>
                          <input class="form-control" name="user_birth" type="date" id="wiz-date1" placeholder="Your birth" readonly=""/>
                        </div>
                        <div class="row">
                          <div class="col-xs-6">
                            <button type="button" class="wiz-prev btn btn-default">Previous</button>
                          </div>
                          <div class="col-xs-6 text-right">
                            <!-- <button type="Submit" class="btn btn-primary" >Submit</button> -->
                            <input id="user_image" type="hidden" name="user_image">
                            <input class="btn btn-primary" type="submit" name="submit" value="submit">
                          </div>
                        </div>
                      </fieldset>

                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
    <footer class="footer">
      <strong>ThemeKit</strong> v4.0.0 &copy; Copyright 2015
    </footer>
    <!-- // Footer -->

  </div>
  <!-- /st-container -->

 <?php
      $this->load->view('include/js');
    ?>
<script type="text/javascript">
  $(".wiz-next").click(function(){
    var address;
    var handphone;
    var date;
    address=$("#wiz-address").val();
    handphone=$("#wiz-phone").val();
    date=$("#wiz-date").val();
    
    $("#wiz-address1").val(address);
    $("#wiz-phone1").val(handphone);
    $("#wiz-date1").val(date);
  });

  $(".ava").click(function(){
    var src;
    var gambar;
    gambar=$(this).attr('data-image');
    src=$(this).attr('src');
    // alert(src);
    $('.ava').addClass('deactive');
    $(this).removeClass("deactive");
    $("#imageTemp").attr('src',src);
    $("#user_image").val(gambar);
    $("#btn-next2").removeAttr('disabled');
  });

  $(".inputfile").change(function(){
      // readURL(this,'div.gallery');
      if (this.files) {
          var filesAmount = this.files.length;

              var reader = new FileReader();

              reader.onload = function(event) {
                  $("#newImage").attr('src',event.target.result);
                  $("#imageTemp").attr('src',event.target.result);
              }

              reader.readAsDataURL(this.files[0]);
          
      }
  });

  $('#wiz-address').keyup(function(){
    validate();
    // alert("wkwk");
  });

  $('#wiz-phone').keyup(function(){
    validate();
  });

  $('#wiz-date').change(function(){
    validate();
  });

  function validate(){
    var address=$("#wiz-address").val();
    var phone=$("#wiz-phone").val();
    var date=$("#wiz-date").val();
    // alert(date);
    if (address!=''&&phone!=''&&date!='') {
      $("#btn-next1").removeAttr('disabled');

    }else{
      $("#btn-next1").attr('disabled','disabled');    

    }
  }
  $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });
</script>
</body>

</html>