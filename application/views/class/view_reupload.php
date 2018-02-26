<?php
$id_post=$this->uri->segment(4);
?>

<form id="reuploadForm" class="form-horizontal" role="form" enctype="multipart/form-data" method="POST"  action="<?php echo base_url("kelas/doReuploadTask/$id_post"); ?>">
	<div class="form-group">
    	<label for="inputtask" class="control-label">Nama Tugas</label>
    	<input type="file" class="form-control" id="task" name="task">   
    </div>
    <!-- <input type="submit" name="submit" value="submit"> -->
</form>


