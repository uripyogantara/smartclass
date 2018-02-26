<?php
	$id_post=$this->uri->segment(4);
?>
<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="<?php echo base_url(); ?>assets/css/vendor/all.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/app/app.css" rel="stylesheet"> -->
	<form id="taskForm" class="form-horizontal" role="form" enctype="multipart/form-data" method="POST"  action="<?php echo base_url("kelas/doUploadTask/$id_post"); ?>">
		<div class="form-group">
	    	<label for="inputtask" class="control-label">Tugas</label>
	    	<input type="file" class="form-control" id="task" name="task">   
	    
	    </div>
	    <div class="form-group">
		    <label class="col-sm-3 control-label">Class Type</label>
		    <div class="col-sm-9">
		    	<select id="memberSelect" name="member_group[]" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5" multiple="">
		        	<?php
	    			foreach ($member as $key => $value) {
	    			?>
	    				<option value="<?php echo "$value[user_id]" ?>"><?php echo "$value[user_name]"; ?></option>	
	    			<?php
	    			}
	    			?>
		        	
		        </select>
		    </div>
		</div>
	</form>
	<!-- <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script> -->
  <!-- <script src="<?php echo base_url(); ?>assets/js/vendor/all.js"></script> -->

  <script src="<?php echo base_url(); ?>assets/js/app/app.js"></script>
<!-- </body>
</html> -->
