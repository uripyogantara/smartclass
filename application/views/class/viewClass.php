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
  <?php
      $this->load->view('include/css');
    ?>
  <style type="text/css">
    .inputcover {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
    .image-cover{
      max-width: auto; max-height: 400px
    }
  </style>
  <title><?php echo "$class[class_name]"; ?></title>
</head>
<body>

  <div class="st-container">
    <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">SmartClass</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
          
          <ul class="nav navbar-nav navbar-left">
            <form action="<?php echo base_url("kelas/search") ?>" method="get" class="navbar-form margin-none navbar-left hidden-xs ">
              <!-- Search -->
              <div class="search-1">
                <div class="input-group">
                  <span class="input-group-addon"><i class="icon-search"></i></span>
                  <input type="text" name="keyword" class="form-control" placeholder="Search. . .">
                </div>
              </div>
            </form>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            
            <!-- User -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>/images/user/<?php echo $image; ?>" alt="<?php echo "$username"; ?>" class="img-circle" width="40" /> <?php echo "$username"; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url("user/view/$username") ?>">Profile</a></li>
                <!-- <li><a href="user-private-messages.html">Messages</a></li> -->
                <li><a href="<?php echo base_url('index.php/auth/logout') ?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->

      </div>
    </div>

    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
      <div data-scrollable>
        <div class="sidebar-block">
          <div class="profile">
            <img src="<?php echo base_url("/images/class/profile/$class[class_image]"); ?>" alt="people" class="img-circle" style="height: 100px;"/>
            <h4><?php echo "$class[class_name]"; ?></h4>
          </div>
        </div>

        <h4 class="category">Menu</h4>
        <ul class="sidebar-menu">
            <li><a href="<?php echo base_url("welcome/addclass") ?>"><i class="fa fa-file-o"></i> <span>New Class</span></a></li>
            <li><a href="<?php echo base_url("kelas/allclass") ?>"><i class="fa fa-th"></i> <span>All Class</span></a></li>
            <!-- Sample 2 Level Collapse -->
              <li class="hasSubmenu">
                <a href="#submenu"><i class="fa fa-chevron-circle-down"></i> <span>Recent Class</span></a>
                <ul id="submenu">
                  <?php  
                        foreach ($all_class as $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url("kelas/view/$value[class_nickname]"); ?>" class=""><i class="fa fa-book fa-fw"></i> <span><?php echo "$value[class_name]"; ?></span></a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
              </li>
        </ul>
      </div>
    </div>
    
    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">

          <div class="container-fluid">

            <?php  
            $this->load->view('class/cover');
            if (isset($detail_class)){
            ?>
            <div class="row">
              <div class="col-md-9" id="post">
                
                  





              
             </div>
           <!-- <div class="col-md-3">
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
          </div> -->
        </div>
        <?php
        }else{
        ?>
          <div class="row">
              <div class="col-md-9">
                <div class="panel panel-default">
                      <div class="panel-heading panel-heading-gray">
                        <i class="fa fa-fw fa-info-circle"></i> Join Group
                      </div>
                      <div class="panel-body">
                      <form action="<?php echo base_url("kelas/join/$class[class_token]") ?>" method="POST">
                        <?php  
                        if ($class['class_type']==2) {
                        ?>
                        <ul class="list-unstyled profile-about margin-none">
                          <li class="padding-v-5">
                            <div class="row">
                              <div class="col-sm-4"><span class="text-muted">Password</span></div>
                              <div class="col-sm-8"><input type="password" name="class_pw" placeholder="Type a password" class="form-control"></div>
                            </div>
                          </li>
                          <?php
                          }
                          ?>
                          <button id="addCLass" type="submit" name="join" value="Join" class="btn btn-primary">Join</button>
                        </ul>
                        </form>
                      </div>
                    </div>
                    </div>
                    </div>
          
        <?php
        }
        ?>
        
      </div>

    </div>
    <!-- /st-content-inner -->

  </div>
  <!-- /st-content -->

  </div><!-- /st-pusher -->

  <?php
      $this->load->view('include/footer');
    ?>
  </div><!-- st-container -->
  <div class="modal fade" id="coverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content" >
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel" align="center">Change Cover</h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                  <button type="button" class="coverBtn btn btn-primary" id="btn-upload">Change</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <?php
        $this->load->view('include/js');
  ?>


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
				$('#post').html(data);
			},
			error: function(){
				alert('error');
			}
		}); 	
	}/*function show post*/
  
	$(document).ready(function(){
		// $('.chosen-select').chosen();
  //   $('.chosen-select-deselect').chosen({ allow_single_deselect: true });

	    showPost();


	 });/*document ready*/
</script>
<?php  
  if (!empty($this->session->flashdata('success'))) {
?>
    <script type="text/javascript">
      swal("Congratulation", "Group Berhasil Ditambahkan", "success");
    </script>
<?php
  }else if(!empty($this->session->flashdata('error'))){
?>
    <script type="text/javascript">
      swal("Error", "Password Salah", "error");
    </script>
<?php
  }
?>
</body>
</html>