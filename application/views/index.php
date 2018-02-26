<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Smart Class  || Login and Register Page</title>
	<link href="<?php echo base_url("assets/css/sweetalert.css") ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/cssopen/index.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/cssopen/animate.min.css" />
	<style type="text/css">
		.disable-btn{
			opacity: 0.5;
		}
	</style>
	
</head>
<body>




	<!-- <div class="preloader"><img src="<?php echo base_url(); ?>assets/cssopen/icons/loader.gif" alt="Preloader image"></div>			 -->
	<div id="large-header" class="large-header">
		<canvas id="demo-canvas"></canvas>
	</div>

	<div class="global-main-container">
		<div class="site_logo"><span class="helper"></span><img src="<?php echo base_url(); ?>assets/cssopen/icons/sm.png" /></div>
		<div class="tyy">
			<div class="white typed">Manage Your Class, with our Social Media</div><div class="typed-cursor">|</div>
		</div>
		<?php if($this->session->flashdata('success')){ ?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
		</div>
		<?php 
	}else if ($this->session->flashdata('danger')) {?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
	</div>
	<?php
}
?>


<form id="loginForm" method="post" action="<?php echo base_url() ?>index.php/auth/login" name="login" onsubmit="return validasi();">
	<div class="login">
		
		<div class="input-global">
			<!-- <input style="display:none"> -->
			<input type="text" id="ssr" name="user_username" class="input-style background-general" placeholder="Username">
			<span class="bar"></span>
		</div>
		<div class="input-global">
			<!-- <input name="passcode" style="display:none"> -->
			<input type="password" id="ssr" name="user_pw" class="input-style background-general" placeholder="Password">
			<span class="bar"></span>
		</div>
		<div class="input-global_remember"><input type="checkbox" name="remember" id="rememberl" class="rememberme"><label for="rememberl" class="remlab">Remember me</label></div>
		<div class="input-global">
			<div class="test">
				<div class="MaterialTouch md-ripple">
					<input type="submit" id="login" type="submit" value="Login" name="submit" class="login_btn background-login" />
				</div>
			</div>
		</div>
		
		<div class="input-global">
			<div class="link_btn left sign_up">REGISTER</div>
			<div class="link_btn right"><a href="forgot.php">FORGOT PASSWORD</a></div>
		</div>
	</div>
</form>


</div>
<div class="sidebar">
	<div class="sidebar-content">
		<div class="global-main-container">
			<div class="site_logo"><span class="helper"></span><img src="<?php echo base_url(); ?>assets/cssopen/icons/sm.png" /></div>
			<form method="post" action="<?php echo base_url() ?>user/insert" name="reg" id="signup">
				<div class="login">
					<div class="input-global">
						<input style="display:none">
						<input type="text" name="user_name" id="user_name" class="input-style background-general" placeholder="Name">
						<span class="bar"></span>
					</div>

					<div class="input-global">
						<input type="text" name="user_email" id="user_email" class="input-style background-general" placeholder="Email" required="email">
						<span class="bar"></span>
					</div>

					<div class="input-global">
						<input type="text" name="user_username" id="user_username" class="input-style background-general" placeholder="Username">
						<span class="bar"></span>
					</div>

					<div class="input-global">
						<input type="password" name="password" id="password" class="input-style background-general" placeholder="Password">
						<span class="bar"></span>
					</div>
					<div class="input-global">
						<div class="test">
							<div class="MaterialTouch md-ripple">
								<button disabled=""  type="submit" id="register" class="login_btn background-login disable-btn">Register</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jsopen/typewriter.js"></script>
<script src="<?php echo base_url(); ?>assets/jsopen/bubble.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/jsopen/rAF.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/jsopen/jquery.validate.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/jsopen/login.js" type="text/javascript"></script>  
	<script src="<?php echo base_url(); ?>assets/jsopen/loginsignup.js" type="text/javascript"></script> 
	<script src="<?php echo base_url(); ?>assets/jsopen/md.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('.preloader').addClass('animated fadeOut').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.preloader').hide();
			});
			$(".typed").typewriter({
				speed: 60
			});	
		});
	</script>
	<?php
      $this->load->view('include/js');
    ?>
	<script type="text/javascript">
		$(document).ready(function() {
		  $(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });
		});
		$('#login').click(function(e){
			e.preventDefault();
			var url= $('#loginForm').attr('action');
			var formData = $('#loginForm').serialize();
			// var username= $('#ssr').val();
			$.ajax({
				type: 'ajax',
				method: 'post',
				url: url,
				data: formData,
				dataType: 'json',

				success: function(response){
					if (response.success){
						window.location.reload();
					}else{
						swal("Gagal", "Login Gagal", "error");
					}
				},
				error: function(){
					alert('ajax error');
				}
			});
			// alert(formData);
		});

		$("#user_name").keyup(function(e){
			validation();
			// alert("wkwk");
		});

		$("#user_email").keyup(function(e){
			validation();
		});

		$("#user_username").keyup(function(e){
			validation();
		});

		$("#password").keyup(function(e){
			validation();
		});

		// $("#register").click(function(e){
		// 	e.preventDefault();
		// 	var url= $('#signup').attr('action');
		// 	var formData= new FormData($('#signup')[0]);
		// 	var href= "<?php echo base_url('welcome/setpicture');?>";
		// 	$.ajax({
		// 		type: 'ajax',
		// 		method: 'post',  
		// 		url: url,
		// 		data: formData,
		// 		dataType: 'json', 
		// 		processData: false,
		// 		contentType: false,
		// 		success: function(response){
		// 		  if (response.success) {
		// 		    $(location).attr('href', href);
		// 		    alert(href);
		// 		  }else{
		// 		    swal('Gagal',"cek username atau email",'error');
		// 		  }
		// 		},
		// 		error: function(xhr, textStatus, error){
		// 		  console.log(xhr.statusText);
		// 		  console.log(textStatus);
		// 		  console.log(error);
		// 		}
		// 	});
		// });

		function validation(){
			var name=$("#user_name").val();
			var email=$("#user_email").val();
			var username=$("#user_username").val();
			var password=$("#password").val();

			if (name!=''&&email!=''&&username!=''&&password!='') {
				$("#register").removeClass('disable-btn');
				$("#register").removeAttr('disabled');
			}else{
				$("#register").addClass('disable-btn');
				$("#register").attr('disabled');
			}
			// alert("wkwk");
		}


	</script>
</body>
</html>