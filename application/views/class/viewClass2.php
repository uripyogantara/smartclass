<?php
$image=$this->session->userdata('user_image');
$token=$this->uri->segment(3);
// print_r($post);
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-chosen.css') ?>">
    <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/chosen.jquery.js') ?>"></script> -->
</head>
<body>
    <!-- content push wrapper -->
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
                <h1 class="page-header"><?php echo "$class[class_name]"; ?></h1>
                <!-- <br> -->
            </div><!-- col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
				  <li id="list-pengumuman" class="active">Pengumuman</li>
				  <li id="list-materi"><a href="javascript:void(0);" id="materi-btn">Share Materi</a></li>
				  <li id="list-kelompok"><a a href="javascript:void(0);" id="kelompok-btn">Buat Kelompok</a></li>
				</ol>
                <!-- <br> -->
            </div><!-- col-lg-12 -->
        </div>
        <!-- ... Your content goes here ... -->
        <div class="row">
            <div class="col-md-12">

				<?php if($this->session->flashdata('error')){ ?>
		            <div class="alert alert-danger">
		                <a href="#" class="close" data-dismiss="alert">&times;</a>
		                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
		            </div>
		        <?php
		        }
		        ?>	
				<?php  
				if (isset($detail_class)){
				?>
					<div class="row">
						<div class="col-md-12" id="pengumuman">
							<span class="label label-primary">Pengumuman</span>
							<form id="formPengumuman" action="<?php echo base_url("kelas/post/$token"); ?>"  enctype="multipart/form-data" method="POST"">
								<textarea class="form-control" rows="4" placeholder="Tambah Post" name="post_text"></textarea>
								<input id="picture" type="file" class="form-control" name="picture[]" multiple="multiple" accept="image/*">
								<input type="hidden" name="class_id" value="<?php echo "$class[class_id]"; ?>">
								<input type="button" id="postPengumuman" name="submit" class="btn btn-primary pull-right" value="POST" >
							</form>
						</div>

						<div class="col-md-12" id="materi" style="display: none;">
							<span class="label label-primary">Share Materi</span>
							<form action="<?php echo base_url("kelas/materi/$token"); ?>"  enctype="multipart/form-data" method="POST">
								<textarea class="form-control" rows="4" placeholder="Tambah Post" name="post_text"></textarea>
								<input id="file" type="file" class="form-control" name="file" aria-describedby="fileStatus">
								<input type="hidden" name="class_id" value="<?php echo "$class[class_id]"; ?>">
								<input type="submit" name="submit" class="btn btn-primary pull-right" value="POST" >
							</form>
						</div>

						<div class="col-md-12" id="kelompok" style="display: none;">
							<span class="label label-primary">Kelompok</span>
							<form action="<?php echo base_url("kelas/kelompok/$token"); ?>"  enctype="multipart/form-data" method="POST" onsubmit="return doComment();">
								<input class="form-control" type="text" name="post_group_name" placeholder="Nama Kelompok">
								<input class="form-control" type="number" name="post_group_max" placeholder="Maksimal Group">
								<textarea class="form-control" rows="4" placeholder="Komentar" name="post_text"></textarea>
								<!-- <input id="picture" type="file" class="form-control" name="picture" aria-describedby="pictureStatus"> -->
								<input type="hidden" name="class_id" value="<?php echo "$class[class_id]"; ?>">
								<input type="submit" name="submit" class="btn btn-primary pull-right" value="POST" >
							</form>
						</div>
					</div>
						
					<br>
				<div id="content">
					
				</div>	
				
				<?php
				}else{
				?>
					<form action="<?php echo base_url("kelas/join/$class[class_token]") ?>" method="POST">
						<?php  
						if ($class['class_type']==2) {
						?>
							<input type="password" name="class_pw" placeholder="Password" class="form-control">
						<?php
						}
						?>
						<input type="submit" name="join" value="Join">
					</form>
					
				<?php
				}
				?>
            </div><!-- col-md-12 -->
        </div><!-- row -->
                
          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
<!-- <script>
	function doComment(i){
		var url= '<?php echo base_url("kelas/comment/$token"); ?>';
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
			url: '<?php echo base_url("kelas/viewPost/$token") ?>',
			success: function(data){
				$('#content').html(data);
			},
			error: function(){
				alert('error');
			}
		}); 	
	}/*function show post*/

	$(document).ready(function(){
		$('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });

		showPost();

		$('#postPengumuman').click(function(){
			var url= $('#formPengumuman').attr('action');
			var data= $('#formPengumuman').serialize();
			$.ajax({
				type: 'ajax',
				method: 'post',  
				url: url,
				data: data,
				dataType: 'json', 
				success: function(response){
					if (response.success) {
						$('#formPengumuman')[0].reset();
						showPost();
					}else{
						alert('error');
					}
				},
				error: function(){
					alert('could not add data');
				}
			});
		});

		$('#list-materi').click(function(){
			$('#materi').show();
			$('#kelompok').hide();
			$('#pengumuman').hide();

			var pengumuman="<a href='javascript:void(0);' id='pengumuman-btn'>Pengumuman</a>";
			var kelompok="<a href='javascript:void(0);' id='kelompok-btn'>Buat Kelompok</a>";
			$('#list-pengumuman').html(pengumuman);
			$('#list-kelompok').html(kelompok);
			$('#list-materi').html("Share Materi");
			$('#list-materi').prop("class","active");
		});
		
		$('#list-kelompok').click(function(){
			$('#materi').hide();
			$('#kelompok').show();
			$('#pengumuman').hide();

			var pengumuman="<a href='javascript:void(0);' id='pengumuman-btn'>Pengumuman</a>";
			var materi="<a href='javascript:void(0);' id='materi-btn'>Share Materi</a>";
			$('#list-pengumuman').html(pengumuman);
			$('#list-materi').html(materi);
			$('#list-kelompok').html("Buat Kelompok");
			$('#list-kelompok').prop("class","active");
		});

		$('#list-pengumuman').click(function(){
			$('#materi').hide();
			$('#kelompok').hide();
			$('#pengumuman').show();

			var kelompok="<a href='javascript:void(0);' id='kelompok-btn'>Buat Kelompok</a>";
			var materi="<a href='javascript:void(0);' id='materi-btn'>Share Materi</a>";
			$('#list-kelompok').html(kelompok);
			$('#list-materi').html(materi);
			$('#list-pengumuman').html("Pengumuman");
			$('#list-pengumuman').prop("class","active");
		});

	});/*document ready*/
</script> -->
</body>
</html>