<?php  
$image=$this->session->userdata('user_image');
$username=$this->session->userdata('username');
$user_name=$this->session->userdata('user_name');
$useraddress=$this->session->userdata('user_address');
$userhp=$this->session->userdata('user_hp');
$userbirth=$this->session->userdata('user_birth');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Smart Class</title>
	<?php  
	$this->load->view('include/css');
	?>
</head>
<body>
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
        <div class="collapse navbar-collapse" id="main-nav">
          
          

          <ul class="nav navbar-nav navbar-right">
            
            <!-- User -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>/images/user/<?php echo $image; ?>" alt="<?php echo "$username"; ?>" class="img-circle" width="40" /> <?php echo "$username"; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="user-private-profile.html">Profile</a></li>
                <li><a href="user-private-messages.html">Messages</a></li>
                <li><a href="<?php echo base_url('index.php/auth/logout') ?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->

      </div>
    </div>
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
                <h1 class="page-header">Formulir Tambah Kelas</h1>
            </div>
        	</div>
        <!-- ... Your content goes here ... -->
        <div class="panel panel-default">
            <div class="panel-body">
				<div class="col-md-4"></div>
				<div class="col-md-4">
		            
					<center>
						<h1><b>Profile Picture</b></h1>
						<img id="profile-picture" src="<?php echo base_url(); ?>/images/user/<?php echo $image; ?>" style="max-height: 200px;"></<br>
					</center>

					<form id="form-picture" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/editpicture" method="post">
						<div class="form-group">
							<input id="picture" type="file" class="form-control" name="picture" aria-describedby="pictureStatus"><br>
							
							<center><button type="submit" class="btn btn-primary" id="submit">Change Profile</button></center>
							<div align="right"><a href="<?php echo base_url(); ?>welcome/home">Skip</a></div>
						</div>
					</form>
				</div> <!-- col-md-4 -->
				<div class="col-md-4"></div>      	
            </div>
        </div>



          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
    <?php
      $this->load->view('include/footer');
    ?>
  </div> <!-- st-container -->

	
	<?php  
	$this->load->view('include/js');
	?>
	<script type="text/javascript">
		function readURLCover(input, placeToInsertImagePreview) {

	        if (input.files) {
	            var filesAmount = input.files.length;

	                var reader = new FileReader();

	                reader.onload = function(event) {
	                    $(placeToInsertImagePreview).attr('src',event.target.result);
	                    // $()
	                }

	                reader.readAsDataURL(input.files[0]);
	            
	        }

	    };

	    $("#picture").change(function(){
	        readURLCover(this,'#profile-picture');
	    });
	</script>
</body>
</html>