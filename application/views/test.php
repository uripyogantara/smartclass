<!DOCTYPE html>
<html>
<head>
	<title>Chosen</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-chosen.css') ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <link href="<?php echo base_url('assets/css/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/timeline.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/startmin.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/morris.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('assets/js/metisMenu.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/startmin.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/chosen.jquery.js') ?>"></script>
    <!-- <script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.min.js')?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/media/css/dataTables.bootstrap.min.css')?>"> -->
    
	<script type="text/javascript">
		$(document).ready(function(){
			$('.chosen-select').chosen();
	        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
		});
	</script>
</head>
<body>
	<div class="col-md-4"></div>
	<div id="content">
		<div class="post-content">
			<div class="col-md-4">
				<form action="<?php echo base_url("welcome/chosen"); ?>" method="POST">
					<select class="chosen-select" multiple="multiple" data-placeholder="Choose a Country"  name="chosen[]">
						<option value="satu">satu</option>
						<option value="dua">dua</option>
						<option value="tiga">tiga</option>
						<option value="empat">empat</option>
						<option value="lima">lima</option>
						<option value="enam">enam</option>
						<option value="tujuh">tujuh</option>
						<option value="delapan">delapan</option>
					</select>	
					<input type="submit" name="submit" value="submit" class="btn btn-primary">
				</form>	
			</div>
		</div>
	</div>
			
	<div class="col-md-4"></div>
</body>
</html>