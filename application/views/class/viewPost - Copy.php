<?php
$image=$this->session->userdata('user_image');
$token=$this->uri->segment(3);
// print_r($post);
?>
	<!--  -->
    <script type="text/javascript">
    	$(document).ready(function(){
			$('.chosen-select').chosen();
	        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
		});
    </script>
<?php  
foreach ($post as $value) {
?>
	<div class="post-content">
		<blockquote>
			<div class="row">
				<div class="col-md-1">
					<img src="<?php echo base_url(); ?>/images/user/<?php echo $value['user_image']; ?>" class="comment_picture">	
				</div>
				
				<h4><?php echo "$value[user_name]"; ?></h4>
			</div>
			<div class="row">
				<div class="col-md-5">
					<?php  
					echo "<h5>$value[post_text]</h5>";
					// echo "string";
					if (isset($value['post_file'])) {
						echo "<a href=".base_url("materi/$value[post_file]".">Download</a>");
					}
					?>
					
				</div>
			</div>
			<?php  
			foreach ($value['comment'] as $comment) {
			?>
				<blockquote>
					<div class="row">
						<div class="col-md-1">
							<img src="<?php echo base_url(); ?>/images/user/<?php echo $comment['user_image']; ?>" class="profile_picture">	
						</div>
						
						<h6><strong><?php echo "$comment[user_name]"; ?></strong></h6>
					</div>
					<div class="row">
						<div class="col-md-5">
							<?php  
							echo "<h6>$comment[comment_text]</h6>";
							?>
						</div>
					</div>		
				</blockquote>
			<?php
				# code...
			}
			?>
			<div class="row">
				<div class="col-md-1">
					<img src="<?php echo base_url(); ?>/images/user/<?php echo $image; ?>" class="profile_picture">	
				</div>
				<div class="col-md-6">
					
					<?php  
					if ($value['post_type']==3) {
					?>
						<form id="formComment<?php echo "$value[post_id]" ?>" action="<?php echo base_url("kelas/makeGroup/$token") ?>" method="POST">
							<div class="form-group">
								<select class="chosen-select" multiple="multiple" data-placeholder="Buat Kelompok"  name="group[]">
									<?php  
									foreach ($class_member as $user) {
									?>
										<option value="<?php echo "$user[user_id]" ?>"><?php echo "$user[user_name]"; ?></option>
									<?php
									}
									?>
								</select>
								<input type="hidden" name="post_id" value="<?php echo $value['post_id'] ?>">
							</div>
						</form>
					<?php
					}else{
					?>
						<form id="formComment<?php echo "$value[post_id]" ?>" method="post" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="doComment(<?php echo "$value[post_id]" ?>);">
							<div class="form-group">
								<input class="form-control" type="text" name="comment_text" placeholder="Komentar...">
								<input type="hidden" name="post_id" value="<?php echo $value['post_id'] ?>">
							</div>
						</form>
					<?php
					}
					?>
				</div><!-- col-md-6 -->
			</div><!-- row -->
				
		</blockquote>
	</div><!-- post content -->
<?php
}
?>