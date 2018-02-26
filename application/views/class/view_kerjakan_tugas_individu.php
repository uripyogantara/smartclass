<?php
$id_post=$this->uri->segment(4);
?>

<form id="taskForm" class="form-horizontal" role="form" enctype="multipart/form-data" method="POST"  action="<?php echo base_url("kelas/doUploadTask/$id_post"); ?>">
	<div class="form-group">
    	<label for="inputtask" class="control-label">Tugas</label>
    	<input type="file" class="form-control" id="task" name="task">   
    	<!-- <input type="submit" name="submit" value="submit">  -->
    </div>
</form>


