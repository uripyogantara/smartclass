<!DOCTYPE html>
<html>
<head>
	<title>Smart Class</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Smart Class</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
           
        </ul>
    </nav>

	<div id="wrapper" class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
            
			<h3 align="center">Daftar</h3>
			<form id="addgroup" enctype="multipart/form-data" method="POST"  action="<?php echo base_url() ?>user/insert">
				<!-- input -->
				<div class="form-group">
					<input type="text" class="form-control" name="user_name" placeholder="Nama" required="required"></input>
				</div>

				<!-- input -->
				<div class="form-group">
					<input type="text" class="form-control" name="user_address" placeholder="Alamat" required="required"></input>
				</div>

				<!-- input -->
				<div class="form-group">
					<input type="number" class="form-control" name="user_hp" placeholder="Handphone" required="required"></input>
				</div>

				<!-- input -->
				<div class="form-group">
					<input type="email" class="form-control" name="user_email" placeholder="Email" required="required"></input>
				</div>

				<!-- input -->
				<div class="form-group">
					<input type="text" class="form-control" name="user_username" placeholder="username" required="required"></input>
				</div>

				<!-- input -->
				<div class="form-group">
					<input type="date" class="form-control" name="user_birth" required="required"></input>
				</div>

				<!-- input -->
				<div class="form-group">
					<input type="password" class="form-control" name="user_pw" placeholder="Password" required="required"></input>
				</div>

				<input id="submit" type="submit" name="submit" value="Tambah Class" class="btn btn-primary btn-block"></input>
			</form>
		</div> <!-- col-md-4 -->
		<div class="col-md-4"></div>
	</div><!-- wrapper container -->
</body>
</html>