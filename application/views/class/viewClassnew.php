<?php
	$image=$this->session->userdata('user_image');
	$username=$this->session->userdata('username');
    $user_name=$this->session->userdata('user_name');
    $useraddress=$this->session->userdata('user_address');
    $userhp=$this->session->userdata('user_hp');
    $userbirth=$this->session->userdata('user_birth');
	$token=$this->uri->segment(3);
// print_r($post);
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
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

        <div class="cover overlay cover-menu cover-image-full height-300-lg">

              <ul class="cover-nav">
                <li class="active"><a href="#"><i class="fa fa-clock-o"></i> <span>Timeline</span></a></li>
                <li><a href="#"><i class="fa fa-user"></i> <span>About</span></a></li>
                <li><a href="#"><i class="fa fa-camera"></i> <span>Photos</span> <small>(102)</small></a></li>
                <li><a href="#"><i class="fa fa-group"></i><span> Member </span><small>(19)</small></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
              </ul>

              <img src="images/profile-cover.jpg" alt="cover" />
              <div class="overlay overlay-full">
                <div class="v-top">
                  <a href="#" class="btn btn-cover"><i class="fa fa-pencil"></i></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9">
                <ul class="timeline-list">
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
                              <div class="panel-heading panel-heading-gray title">
                                What&acute;s new
                              </div>
                              <div class="panel-body">
                                <textarea name="status" class="form-control share-text" rows="3" placeholder="Share your status..."></textarea>
                              </div>
                              <div class="panel-footer share-buttons">
                                <a href="#"><i class="fa fa-photo"></i></a>
                                <a href="#"><i class="fa fa-book"></i></a>
                                <a href="#"><i class="fa fa-users"></i></a>
                                <button type="submit" class="btn btn-primary btn-xs pull-right display-none" href="#">Post</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>

                    </div>
                  </li>
                  

                  <!-- postingan foto lebih dari 1-->
                  <li class="media media-clearfix-xs">
                    <div class="media-left">
                      <div class="user-wrapper">
                      	<!-- Foto orang yang ngepost-->
                        <img src="images/people/110/woman-9.jpg" alt="people" class="img-circle" width="80" />
                        <!-- /Foto orang yang ngepost-->

                        <!-- nama dan tanggal orang yang ngepost-->
                        <div><a href="#">Michelle D.</a></div>
                        <div class="date">11 OCT</div>
                        <!-- /nama dan tanggal orang yang ngepost-->
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="media-body-wrapper">
                        <div class="panel panel-default">

                          <div class="panel-body">
                            <p>Late Night Show Photos</p>
                            <div class="timeline-added-images">
                            <!-- foto lebih dari satu-->
                              <img src="images/social/100/1.jpg" width="80" alt="photo" />
                              <img src="images/social/100/2.jpg" width="80" alt="photo" />
                              <img src="images/social/100/3.jpg" width="80" alt="photo" />
                            <!-- /foto lebih dari satu-->
                            </div>
                          </div>
                          <div class="view-all-comments">
                            <a href="#">
                              <i class="fa fa-comments-o"></i> View all
                            </a>
                            <span>100000 comments</span>

                          </div>
                          <ul class="comments">
                            <!-- orang komentar-->
                            <li class="media">
                              <div class="media-left">
                                <a href="#">
                                  <img src="images/people/50/guy-5.jpg" class="media-object">
                                </a>
                              </div>
                              <div class="media-body">
                                <div class="pull-right dropdown" data-show-hover="li">
                                  <a href="#" data-toggle="dropdown" class="toggle-button">
                                    <i class="fa fa-pencil"></i>
                                  </a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                  </ul>
                                </div>
                                <a href="" class="comment-author pull-left">Bill D.</a>
                                <span>Hi Mary, Nice Party</span>
                                <div class="comment-date">21st September</div>
                              </div>
                            </li>
                            <!-- /orang komentar-->
                            

                            <li class="comment-form">
                              <div class="input-group">

                                <span class="input-group-btn">
                   <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                </span>

                                <input type="text" class="form-control" />

                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- /postingan lebih dari satu foto-->



                  <!-- postingan satu foto full-->
                  <li class="media media-clearfix-xs">
                    <div class="media-left">
                      <div class="user-wrapper">
                        <img src="images/people/110/guy-5.jpg" alt="people" class="img-circle" width="80" />
                        <div><a href="#">Smith G.</a></div>
                        <div class="date">03 OCT</div>
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="media-body-wrapper">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="panel panel-default">

                              <img src="images/place1-full.jpg" class="img-responsive">
                              <ul class="comments">
                              <!-- orang komentar-->
                                <li clas="media">
                                  <div class="media-left">
                                    <a href="">
                                      <img src="images/people/50/woman-5.jpg" class="media-object">
                                    </a>
                                  </div>
                                  <div class="media-body">
                                    <div class="pull-right dropdown" data-show-hover="li">
                                      <a href="#" data-toggle="dropdown" class="toggle-button">
                                        <i class="fa fa-pencil"></i>
                                      </a>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                      </ul>
                                    </div>
                                    <a href="" class="comment-author">Mary</a>
                                    <span>Wow</span>
                                    <div class="comment-date">2 days</div>
                                  </div>
                                </li>
                              <!-- /orang komentar-->
                                <li class="comment-form">
                                  <div class="input-group">

                                    <input type="text" class="form-control" />

                                    <span class="input-group-btn">
                   <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                </span>

                                  </div>
                                </li>
                              </ul>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- /postingan 1 foto full-->




                  
                  
                 
                  <!-- postingan tugas-->
                  <li class="media media-clearfix-xs">
                    <div class="media-left">
                      <div class="user-wrapper">
                        <img src="images/people/110/guy-5.jpg" alt="people" class="img-circle" width="80" />
                        <div class="date">11 MAY</div>
                      </div>
                    </div>
                    <div class="media-body" id="may">
                      <div class="media-body-wrapper">
                        <div class="row">
                          <div class="col-md-10 col-lg-8">
                            <div class="panel panel-default event">
                            <!-- judul tugas -->
                              <div class="panel-heading title">
                                <h4>TUGAS SOP ASD</h4>
                              </div>
                            <!-- /judul tugas-->
                            <div class="panel-heading title">
                            <p>Berikut ini adalah tugas yang diberikan oleh bu ayu. Jadi kerjakan sebaik2nya ya :)</p>
                            </div>
                              <ul class="icon-list icon-list-block">
                                <li><i class="fa fa-user"></i> Ayu Wirdi</li>
                                <li><i class="fa fa-file-o"></i> Individu</li>
                                <li><i class="fa fa-calendar-o"></i> 31st Oct 2017</li>
                                <li><i class="fa fa-clock-o"></i> 5:50 PM</li>
                                <li><i class="fa fa-users"></i> 9 Mengerjakan <a href="#" class="btn btn-primary btn-stroke btn-xs pull-right">Kerjakan</a></li>
                              </ul>
                              <ul class="img-grid">
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/guy-6.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/woman-3.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/guy-2.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/guy-9.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/woman-9.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li class="clearfix">
                                  <a href="#">
                                    <img src="images/people/110/guy-4.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/guy-1.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/woman-4.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                                <li>
                                  <a href="#">
                                    <img src="images/people/110/guy-6.jpg" alt="people" class="img-responsive" />
                                  </a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            
                              <div class="view-all-comments">
                            <a href="#">
                              <i class="fa fa-comments-o"></i> View all
                            </a>
                            <span>100000 comments</span>

                          </div>
                          <ul class="comments">
                            <!-- orang komentar-->
                            <li class="media">
                              <div class="media-left">
                                <a href="#">
                                  <img src="images/people/50/guy-5.jpg" class="media-object">
                                </a>
                              </div>
                              <div class="media-body">
                                <div class="pull-right dropdown" data-show-hover="li">
                                  <a href="#" data-toggle="dropdown" class="toggle-button">
                                    <i class="fa fa-pencil"></i>
                                  </a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                  </ul>
                                </div>
                                <a href="" class="comment-author pull-left">Bill D.</a>
                                <span>Hi Mary, Nice Party</span>
                                <div class="comment-date">21st September</div>
                              </div>
                            </li>
                            <!-- /orang komentar-->
                            

                            <li class="comment-form">
                              <div class="input-group">

                                <span class="input-group-btn">
                   <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                </span>

                                <input type="text" class="form-control" />

                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- /postingan tugas-->


                  <!-- postingan biasa-->
                  <li class="media media-clearfix-xs">
                    <div class="media-left">
                      <div class="user-wrapper">
                        <img src="images/people/110/woman-5.jpg" alt="people" class="img-circle" width="80" />

                        <div class="date">3 MAY</div>
                      </div>
                    </div>
                    <div class="media-body">
                      <div class="media-body-wrapper">
                        <div class="panel panel-default">

                          <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis perspiciatis praesentium quaerat repudiandae soluta? Cum doloribus esse et eum facilis impedit officiis omnis optio, placeat, quia quo reprehenderit sunt
                              velit? Asperiores cumque deserunt eveniet hic reprehenderit sit, ut voluptatum?</p>
                          </div>
                          <div class="view-all-comments">
                            <a href="#">
                              <i class="fa fa-comments-o"></i> View all
                            </a>
                            <span>10 comments</span>

                          </div>
                          <ul class="comments">
                            <li class="media">
                              <div class="media-left">
                                <a href="">
                                  <img src="images/people/50/guy-5.jpg" class="media-object">
                                </a>
                              </div>
                              <div class="media-body">
                                <div class="pull-right dropdown" data-show-hover="li">
                                  <a href="#" data-toggle="dropdown" class="toggle-button">
                                    <i class="fa fa-pencil"></i>
                                  </a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Edit</a></li>
                                    <li><a href="#">Delete</a></li>
                                  </ul>
                                </div>
                                <a href="" class="comment-author pull-left">Bill D.</a>
                                <span>Hi Mary, Nice Party</span>
                                <div class="comment-date">21st September</div>
                              </div>
                            </li>
                            <!-- /komentar-->
 
                            <li class="comment-form">
                              <div class="input-group">

                                <span class="input-group-btn">
                   <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                </span>

                                <input type="text" class="form-control" />

                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- postingan grup-->


                </ul>
              </div>
              <div class="col-md-3">
                <ul class="nav timeline-months">
                  <li><a href="#December"><i class="fa fa-calendar fa-fw"></i>December</a></li>
                  <li><a href="#November"><i class="fa fa-calendar fa-fw"></i>November</a></li>
                  <li><a href="#october"><i class="fa fa-calendar fa-fw"></i>October</a></li>
                  <li><a href="#september"><i class="fa fa-calendar fa-fw"></i>September</a></li>
                  <li><a href="#august"><i class="fa fa-calendar fa-fw"></i>August</a></li>
                  <li><a href="#july"><i class="fa fa-calendar fa-fw"></i>July</a></li>
                  <li class="active"><a href="#june"><i class="fa fa-calendar fa-fw"></i>June</a></li>
                  <li><a href="#may"><i class="fa fa-calendar fa-fw"></i>May</a></li>
                  <li><a href="#april"><i class="fa fa-calendar fa-fw"></i>April</a></li>
                  <li><a href="#march"><i class="fa fa-calendar fa-fw"></i>March</a></li>
                  <li><a href="#february"><i class="fa fa-calendar fa-fw"></i>February</a></li>
                  <li><a href="#january"><i class="fa fa-calendar fa-fw"></i>January</a></li>
                </ul>
              </div>
            </div>
                
          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
<script>
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
</script>
</body>
</html>