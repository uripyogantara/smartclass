<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
  <?php
      $this->load->view('include/css');
    ?>
    <title>Smartclass</title>
</head>
<body>
	<div class="st-container">
    <?php
		$this->load->view('include/nav');
    ?>
    
	    <!-- content push wrapper -->
		<div class="st-pusher" id="content">
			<div class="st-content">
				<!-- extra div for emulating position:fixed of the menu -->
	        	<div class="st-content-inner">

	          		<div class="container-fluid">
	            		<div class="row">
	              			<div class="col-md-9" id="post">

							</div>
	        			</div>
	      			</div><!-- container-fluid -->
	    		</div><!-- /st-content-inner -->
	  		</div><!-- /st-content -->
		</div><!-- /st-pusher -->

	<?php
		$this->load->view('include/footer');
    ?>

	</div><!-- st-container -->

	<?php
		$this->load->view('include/js');
	?>
	<script>
		function doComment(i){
			var url= '<?php echo base_url("kelas/comment/"); ?>';
			var data= $('#formComment'+i).serialize();
			// alert(data);
			$.ajax({
				type: 'ajax',
				method: 'post',  
				url: url,
				data: data,
				dataType: 'json', 
				success: function(response){
					if (response.success) {
						$('#formComment'+i)[0].reset();
						showPost();
					}else{
						alert('error');
					}
				},
				error: function(){
					alert('could not comment');
				}
			});
		}
		function showPost(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url("welcome/viewPostHome") ?>',
				success: function(data){
					$('#post').html(data);
				},
				error: function(){
					alert('error');
				}
			}); 	
		}/*function show post*/
		$(document).ready(function(){
			showPost();
		 });/*document ready*/
	</script>
</body>
</html>