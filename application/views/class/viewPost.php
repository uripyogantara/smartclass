<?php
$user_id=$this->session->userdata('user_id');
$image=$this->session->userdata('user_image');
$username=$this->session->userdata('username');
$user_name=$this->session->userdata('user_name');
$useraddress=$this->session->userdata('user_address');
$userhp=$this->session->userdata('user_hp');
$userbirth=$this->session->userdata('user_birth');
$token=$this->uri->segment(3);
?>
<style type="text/css">
	.inputfile {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}

	.inputfileDoc {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}
	.image-input{
		max-height: 30px;
		width: auto;
		margin: 2px;
	}
	.myImg {
	    border-radius: 5px;
	    cursor: pointer;
	    transition: 0.3s;
	}

	.myImg:hover {opacity: 0.7;}
</style>
<ul class="timeline-list" id="post">
	<li class="media media-clearfix-xs">
		<div class="media-left">
			<div class="user-wrapper">
				<img src="<?php echo base_url(); ?>/images/user/<?php echo $image; ?>" alt="people" class="img-circle" width="80" />
				<div><a href="#"><?php echo "$user_name"; ?></a></div>
				<div class="date"><?php echo date('d-M'); ?> </div>
			</div>
		</div>

		<div class="media-body">
			<div class="media-body-wrapper">
				<div class="row">
					<div class="col-md-10 col-lg-8">
						<div class="panel panel-default share clearfix-xs">
							<ul class="nav nav-tabs">
							  <li role="presentation" id="pengumumanBtn" class="active"><a href="#">Post</a></li>
							  <li role="presentation" id="tugasBtn"><a href="#">Task</a></li>
							</ul>
							<div id="postContent1">
								<div class="panel-heading panel-heading-gray title">
									What&acute;s new
								</div>
								<div class="panel-body">
									<form id="formPengumuman" action="<?php echo base_url("kelas/post/$token"); ?>"  enctype="multipart/form-data" method="POST"">
										<textarea name="post_text" class="form-control share-text" rows="3" placeholder="Share your status..."></textarea>
										<input type="hidden" name="class_id" value="<?php echo "$class[class_id]"; ?>">
										<input type="file" name="picture[]" id="file" class="inputfile" multiple="" accept="image/*" />
										<input type="file" name="task" id="fileDoc" class="inputfileDoc" accept=".pdf,.doc,.docx,.ppt,.pptx" />
										<!-- <input type="submit" name="" value="submit"> -->
									</form>
									<div class="gallery"></div>
									<span class="fileDocName"></span>
								</div>
								<div class="panel-footer share-buttons">
									<a href="#"><label id="inputfile-label" for="file"><i class="fa fa-photo"></i></label></a>
									<a href="#"><label id="inputfile-label" for="fileDoc"><i class="fa fa-book"></i></label></a>

									<!-- <a href="#"><i class="fa fa-users"></i></a> -->
									<button type="button" id="postPengumuman" class="btn btn-primary btn-xs pull-right">Post</button>
									<!-- <input type="button" value="POST" name="" id="postPengumuman" class="btn btn-primary btn-xs pull-right"> -->
								</div>
							</div>
							<div id="postContent2" style="display: none;">
								<div class="panel-heading panel-heading-gray title">
									New Task
								</div>
								<div class="panel-body">
									<form id="formPostTask" action="<?php echo base_url("kelas/makeTask/$token"); ?>"  enctype="multipart/form-data" method="POST"">
										<input type="text" name="post_task_tittle" placeholder="Title" class="form-control share-text">
										<input class="form-control share-text" placeholder="Max Group" id="input-group" type="number" name="post_group_max" style="display: none;">
										<textarea name="post_text" class="form-control share-text" rows="3" placeholder="Description..." style="padding-left: 11px;"></textarea>
										<input type="datetime-local" min="2017-05-11T23:59" name="post_time_span" class="form-control share-text">
										<input type="hidden" name="class_id" value="<?php echo "$class[class_id]"; ?>">
										<label class="radio-inline">
										  <input type="radio" name="post_type" id="inlineRadio1" value="3" checked=""> Individual
										</label>
										<label class="radio-inline">
										  <input type="radio" name="post_type" id="inlineRadio2" value="4"> group
										</label>
										<!-- <input type="submit" name="submit" value="submit" class="btn btn-primary btn-xs pull-right"> -->
									</form>
								</div>
								<div class="panel-footer share-buttons">
									<button type="button" id="postTask" class="btn btn-primary btn-xs pull-right">Post</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div><!-- media-body-wraper -->
		</div><!-- media body -->
	</li>	
	<?php  
	foreach ($post as $value) {
		if ($value['countComment']==0) {
			$countComment="no comment";
		}else if ($value['countComment']==1) {
			$countComment="1 comment";
		}else{
			$countComment=$value['countComment']." comment";
		} 

		/*
		===================================================
			post kumpul tugas
		===================================================
		*/
		if ($value['post_type']==3 || $value['post_type']==4 ) {
			if ($value['post_type']==3) {
				$type="Individual";
			}else if ($value['post_type']==4) {
				$type="Group";
			}
	?>
			<li class="media media-clearfix-xs">
                <div class="media-left">
					<div class="user-wrapper">
						<div style="margin-top: 15px;"><a href="<?php echo base_url("user/view/$value[user_username]") ?>"><?php echo "$value[user_name]"; ?></a></div>
						<img src="<?php echo base_url(); ?>/images/user/<?php echo $value['user_image']; ?>" alt="people" class="img-circle" width="50" />
						<div class="date"><?php echo date("d M Y",strtotime($value['post_time'])); ?></div>
					</div>
				</div>
				<div class="media-body" id="may">
					<div class="media-body-wrapper">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default event">
                            <!-- judul tugas -->
		                            <?php  
									if ($user_id==$value['user_id']) {
									?>
			                            <div class="pull-right dropdown" data-show-hover="li" style="margin-right: 10px;">
											<a href="#" data-toggle="dropdown" class="toggle-button">
												<i class="fa fa-pencil"></i>
											</a>
											
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Edit</a></li>
												<li><a href="#" class="deletePost" data-id="<?php echo $value['post_id'] ?>">Delete</a></li>
											</ul>		
										</div>
									<?php
									}else if ($value['user_type']==1) {
									?>
										<div class="pull-right dropdown" data-show-hover="li" style="margin-right: 10px;">
											<a href="#" data-toggle="dropdown" class="toggle-button">
												<i class="fa fa-pencil"></i>
											</a>
											
											<ul class="dropdown-menu" role="menu">
												<li><a href="#" class="deletePost" data-id="<?php echo $value['post_id'] ?>">Delete</a></li>
											</ul>		
										</div>
									<?php
									}
									?>
									<div class="panel-heading title">
										<h4><?php echo "$value[post_task_tittle]"; ?></h4>
									</div>
	                            <!-- /judul tugas-->
		                            <div class="panel-heading title">
			                            <p><?php echo "$value[post_text]"; ?></p>
		                            </div>
	                              	<ul class="icon-list icon-list-block">
	                                	<!-- <li><i class="fa fa-user"></i> Ayu Wirdi </li> -->
	                                	<li><i class="fa fa-file-o"></i> <?php echo "$type"; ?></li>
	                                	<li><i class="fa fa-calendar-o"></i> <?php echo date("d M Y",strtotime($value['post_time_span'])); ?></li>
	                                	<li><i class="fa fa-clock-o"></i> <?php echo date("H:i",strtotime($value['post_time_span'])); ?></li>
	                                	<li><i class="fa fa-users"></i> <?php echo "$value[countTask]"; ?> Do task
		                                	<?php
		                                	if (date("Y-m-d H:i:s",strtotime($value['post_time_span']))<date('Y-m-d H:i:s')) {
		                                	?>
		                                		<a href="#"  class="btn btn-danger btn-stroke btn-xs pull-right">Task Closed</a>
		                                	<?php	
		                                	}else if (empty($value['task'])) {	# code...
		                                	?>
		                                		<a href="#"  class="kerjakan btn btn-primary btn-stroke btn-xs pull-right" data-id="<?php echo $value['post_id'] ?>">Do Task</a>
		                                	<?php
		                                	}else{
		                                	?>
		                                		<a href="#"  class="reupload btn btn-warning btn-stroke btn-xs pull-right" data-id="<?php echo $value['post_id'] ?>">Reupload</a>
		                                	<?php
		                                	}
		                                	if ($value['user_type']==1) {
		                                	?>
		                                		<a href="<?php echo base_url("kelas/downloadtask/$value[post_id]") ?>"  class="btn btn-primary btn-stroke btn-xs pull-right">Download</a>
		                                	<?php
		                                	}
		                                	?>
	                                	</li>
	                              	</ul>
									<?php  
									if (isset($value['member'])) {
									?>
										<ul class="img-grid">
											<?php
											foreach ($value['member'] as $member) {
											?>
												<li>
			                                  		<a href="<?php echo base_url("user/view/$member[user_username]") ?>" title="<?php echo "$member[user_name]" ?>">
			                                    	<img src="<?php echo base_url("images/user/$member[user_image]") ?>" alt="people" class="img-responsive" width="30"/>
			                                  		</a>
			                                	</li>
											<?php
											}
											?>
										</ul>
									<?php	
									}
									?>
									<div class="clearfix"></div>
	                            
									<div class="view-all-comments">
	                            		<a href="#">
	                              			<i class="fa fa-comments-o"></i> View all
	                            		</a>
	                            		<span><?php echo "$countComment"; ?></span>

	                          		</div>
									<ul class="comments">
										<?php  
										foreach ($value['comment'] as $comment) {
										?>
											<li class="media">
												<div class="media-left">
													<a href="<?php echo base_url("user/view/$comment[user_username]") ?>">
														<img src="<?php echo base_url(); ?>/images/user/<?php echo $comment['user_image']; ?>" class="media-object profile_picture">
													</a>
												</div>
												<div class="media-body">
													<?php
													if ($user_id==$comment['user_id']) {
													?>
														<div class="pull-right dropdown" data-show-hover="li">
															<a href="#" data-toggle="dropdown" class="toggle-button">
																<i class="fa fa-pencil"></i>
															</a>
														
															<ul class="dropdown-menu" role="menu">
																<li><a href="#">Edit</a></li>
																<li><a href="#" data-id="<?php echo $comment['comment_id'] ?>" class="deleteComment">Delete</a></li>
															</ul>
														</div>
													<?php
													}else if ($value['user_type']==1) {
													?>
														<div class="pull-right dropdown" data-show-hover="li">
															<a href="#" data-toggle="dropdown" class="toggle-button">
																<i class="fa fa-pencil"></i>
															</a>
														
															<ul class="dropdown-menu" role="menu">
																<li><a href="#" data-id="<?php echo $comment['comment_id'] ?>" class="deleteComment">Delete</a></li>
															</ul>
														</div>
													<?php
													}
													?>
													<a href="<?php echo base_url("user/view/$comment[user_username]") ?>" class="comment-author pull-left"><?php echo "$comment[user_name]"; ?></a>
													<span><?php echo "$comment[comment_text]"; ?></span>
													<div class="comment-date"><?php echo date("d M Y H:i",strtotime($comment['comment_time'])); ?></div>
												</div>
											</li>
											<!-- /komentar-->
											<?php  
										}
										?>
										<li class="comment-form">
											<form id="formComment<?php echo "$value[post_id]" ?>" method="post" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="doComment(<?php echo "$value[post_id]" ?>);">
												<div class="input-group">
													<span class="input-group-btn">
														<a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
													</span>
													<input type="text" class="form-control" name="comment_text"/>
													<input type="hidden" name="post_id" value="<?php echo $value['post_id'] ?>">
												</div>
											</form>
										</li>
									</ul><!-- comment -->
								</div><!-- panel-panel-default -->
							</div><!-- col-md-10 -->
						</div><!-- row -->
					</div><!-- media body wrapper -->
				</div><!-- media-body -->
            </li>
		<?php
		}else{
		?>
			<!-- postingan biasa-->
			<li class="media media-clearfix-xs">
				<div class="media-left">
					<div class="user-wrapper">
						<div style="margin-top: 15px;"><a href="<?php echo base_url("user/view/$value[user_username]") ?>"><?php echo "$value[user_name]"; ?></a></div>
						<img src="<?php echo base_url(); ?>/images/user/<?php echo $value['user_image']; ?>" alt="people" class="img-circle" width="50" />

						<div class="date"><?php echo date("d M Y",strtotime($value['post_time'])); ?></div>
					</div>
				</div>
				<div class="media-body">
					<div class="media-body-wrapper">
						<div class="panel panel-default">
							<?php
							if ($user_id==$value['user_id']) {
							?>
								<div class="pull-right dropdown" data-show-hover="li" style="margin-right: 10px;">
									<a href="#" data-toggle="dropdown" class="toggle-button">
										<i class="fa fa-pencil"></i>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Edit</a></li>
										<li><a href="#" class="deletePost" data-id="<?php echo $value['post_id'] ?>">Delete</a></li>
									</ul>
								</div>
							<?php
							}else if ($value['user_type']==1) {
							?>
								<div class="pull-right dropdown" data-show-hover="li" style="margin-right: 10px;">
									<a href="#" data-toggle="dropdown" class="toggle-button">
										<i class="fa fa-pencil"></i>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#" class="deletePost" data-id="<?php echo $value['post_id'] ?>">Delete</a></li>
									</ul>
								</div>
							<?php
							}
							?>
							<div class="panel-body">
								<p><?php echo "$value[post_text]"; ?></p>
								<?php
								if (isset($value['post_file'])) {
								?>
									<ul class="icon-list icon-list-block">
		                                <li><i class="fa fa-file-o"></i><a href="<?php echo base_url("materi/$value[post_file]") ?>"> Download</a></li>
	                                </ul>
                                <?php  
                            	}
								if (!empty($value['detailPost'])) {
								?>
									
									<div class="timeline-added-images">
		                            <!-- foto lebih dari satu-->
		                            <?php
		                            foreach ($value['detailPost'] as  $detailPost) {
		                            	# code...
		                            ?>
			                            <img class="myImg" src="<?php echo base_url("images/post/$detailPost[detail_post_image]") ?>" height="80" alt="photo" />
		                            <?php
		                            }
		                            ?>
		                              
		                            <!-- /foto lebih dari satu-->
		                            </div>
	                            <?php
								}
								?>
							</div><!-- panel-body -->
							<div class="view-all-comments">
								<a href="#">
									<i class="fa fa-comments-o"></i> View all
								</a>
								<span><?php echo "$countComment"; ?></span>
							</div>
							<ul class="comments">
								<?php  
								foreach ($value['comment'] as $comment) {
									?>
									<li class="media">
										<div class="media-left">
											<a href="<?php echo base_url("user/view/$comment[user_username]") ?>">
												<img src="<?php echo base_url(); ?>/images/user/<?php echo $comment['user_image']; ?>" class="media-object profile_picture">
											</a>
										</div>
										<div class="media-body">
											<?php
											if ($user_id==$comment['user_id']) {
											?>
												<div class="pull-right dropdown" data-show-hover="li">
													<a href="#" data-toggle="dropdown" class="toggle-button">
														<i class="fa fa-pencil"></i>
													</a>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#">Edit</a></li>
														<li><a href="#" data-id="<?php echo $comment['comment_id'] ?>" class="deleteComment">Delete</a></li>
													</ul>	
												</div>
											<?php
											}else if ($value['user_type']==1) {
											?>
												<div class="pull-right dropdown" data-show-hover="li">
													<a href="#" data-toggle="dropdown" class="toggle-button">
														<i class="fa fa-pencil"></i>
													</a>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#" data-id="<?php echo $comment['comment_id'] ?>" class="deleteComment">Delete</a></li>
													</ul>	
												</div>
											<?php
											}
											?>
											<a href="<?php echo base_url("user/view/$comment[user_username]") ?>" class="comment-author pull-left"><?php echo "$comment[user_name]"; ?></a>
											<span><?php echo "$comment[comment_text]"; ?></span>
											<div class="comment-date"><?php echo date("d M Y H:i",strtotime($comment['comment_time'])); ?></div>
										</div>
									</li>
									<!-- /komentar-->
									<?php  
								}
								?>


								<li class="comment-form">
									<form id="formComment<?php echo "$value[post_id]" ?>" method="post" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="doComment(<?php echo "$value[post_id]" ?>);">
										<div class="input-group">

											<span class="input-group-btn">
												<a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
											</span>


											<input type="text" class="form-control" name="comment_text"/>
											<input type="hidden" name="post_id" value="<?php echo $value['post_id'] ?>">
										</div>
									</form>
								</li>


							</ul><!-- comment -->
						</div><!-- panel-default -->
					</div><!-- media-body-wrapper -->
				</div><!-- media body -->
			</li>
			<!-- postingan grup-->
		<?php
		}
		?>
		<?php
	}
	?>
</ul>
<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="center">Upload Task</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="simpan btn btn-primary" id="delete-submit">Upload</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="center">Upload Task</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="simpan btn btn-primary" id="btn-upload">Upload</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reuploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel" align="center">Reupload Task</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="reuploadBtn btn btn-primary" id="btn-upload">Reupload</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 12%">
        <div class="modal-content">
            <div class="modal-body">
	            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	            <img id="modal-image" style="max-width: auto; max-height: 400px" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function readURL(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr({'src': event.target.result,'class':'image-input'}).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

	$(".inputfile").change(function(){
	    readURL(this,'div.gallery');
	});

	$(".inputfileDoc").change(function(){
	    var filename = this.value;
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }

	   $(".fileDocName").html(filename);
	});
	$(document).ready(function(){

		$('#postPengumuman').click(function(evt){
			evt.preventDefault();
			var url= $('#formPengumuman').attr('action');
			var formData = new FormData($('#formPengumuman')[0]);

			$.ajax({
				type: 'ajax',
				method: 'post',  
				url: url,
				data: formData,
				dataType: 'json', 
				processData: false,
		        contentType: false,
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

		$('#postTask').click(function(evt){
			evt.preventDefault();
			var url= $('#formPostTask').attr('action');
			var formData = new FormData($('#formPostTask')[0]);

			$.ajax({
				type: 'ajax',
				method: 'post',  
				url: url,
				data: formData,
				dataType: 'json', 
				processData: false,
		        contentType: false,
				success: function(response){
					if (response.success) {
						$('#formPostTask')[0].reset();
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

		$('.kerjakan').click(function(e){
			e.preventDefault();
			var id=$(this).attr('data-id');
			var url='<?php echo base_url("kelas/uploadtugas/$token"); ?>'+'/'+id
			$.ajax({
				type: 'ajax',
				url: url,
				success: function(data){
					$("#taskModal .modal-body").html(data);
				},
				error: function(){
					alert(url);
				}
			}); 	
			$('#taskModal').modal('show');
		});

		$('.simpan').click(function(e){
			
			e.preventDefault();
			var url= $('#taskForm').attr('action');
			var formData = new FormData($('#taskForm')[0]);

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: url,
				data: formData,
				dataType: 'json', 
				processData: false,
		        contentType: false,
				success: function(response){
					if (response.success) {
						$('#taskForm')[0].reset();
						$('#taskModal').modal('hide');
						showPost();
						swal("Congratulation", "Task Sucessfull Uploaded", "success");
					}else{
						alert('error');
					}
				},
				error: function(){
					alert('could not add data');
				}
			});
		});



		$('.reupload').click(function(e){
			e.preventDefault();
			var id=$(this).attr('data-id');
			var url='<?php echo base_url("kelas/reuploadtask/$token"); ?>'+'/'+id
			$.ajax({
				type: 'ajax',
				url: url,
				success: function(data){
					$("#reuploadModal .modal-body").html(data);
				},
				error: function(){
					alert(url);
				}
			}); 	
			$('#reuploadModal').modal('show');
		});

		$('.reuploadBtn').click(function(e){
			
			e.preventDefault();
			var url= $('#reuploadForm').attr('action');
			var formData = new FormData($('#reuploadForm')[0]);

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: url,
				data: formData,
				dataType: 'json', 
				processData: false,
		        contentType: false,
				success: function(response){
					if (response.success) {
						$('#reuploadForm')[0].reset();
						$('#reuploadModal').modal('hide');
						showPost();
						swal("Congratulation", "Task Sucessfull Reuploaded", "success");
					}else{
						alert('error');
					}
				},
				error: function(){
					alert('could not add data');
				}
			});
		});

		$(".myImg").click(function(){
			var src=$(this).attr('src');
			$('#imageModal').modal('show');
			$('#modal-image').attr('src',src);
		});

		$("#inlineRadio1").click(function(){
			$("#input-group").hide();
		});

		$("#inlineRadio2").click(function(){
			$("#input-group").show();
		});

		$(".deleteComment").click(function(){
			var id= $(this).attr('data-id');
			var url="<?php echo base_url('kelas/deleteComment'); ?>"+'/'+id;
			swal({
				title: "Are You Sure?",
				text: "You will not able to recover this comment!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#26a69a",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			},
			function(){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					dataType: 'json', 
					processData: false,
			        contentType: false,
					success: function(response){
						if (response.success) {
							showPost();
							swal("Deleted!","Your Comment has been deleted","success");
						}else{
							alert('error');
						}
					},
					error: function(){
						alert('could delete comment');
					}
				});
			});
		});

		$(".deletePost").click(function(){
			var id= $(this).attr('data-id');
			var url="<?php echo base_url('kelas/deletePost'); ?>"+'/'+id;
			swal({
				title: "Are You Sure?",
				text: "You will not be able to recover this post!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#26a69a",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			},
			function(){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					dataType: 'json', 
					processData: false,
			        contentType: false,
					success: function(response){
						if (response.success) {
							showPost();
							swal("Deleted!","Your Post has been deleted","success");
						}else{
							alert('error');
						}
					},
					error: function(){
						alert('could delete post');
					}
				});
			});
				
		});
		$("#tugasBtn").click(function(){
			$(this).addClass('active');
			$("#pengumumanBtn").removeClass('active');
			$("#postContent1").hide();
			$("#postContent2").show();
		});

		$("#pengumumanBtn").click(function(){
			$(this).addClass('active');
			$("#tugasBtn").removeClass('active');
			$("#postContent1").show();
			$("#postContent2").hide();
		});
	});/*document ready*/
	// Get the modal
	
	
</script>