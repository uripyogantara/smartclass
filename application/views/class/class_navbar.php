<?php  
    $image=$this->session->userdata('user_image');
    $username=$this->session->userdata('username');
    $user_name=$this->session->userdata('user_name');
    $useraddress=$this->session->userdata('user_address');
    $userhp=$this->session->userdata('user_hp');
    $userbirth=$this->session->userdata('user_birth');
?>
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
          
          <form action="<?php echo base_url("kelas/search") ?>" method="get" class="navbar-form margin-none navbar-left hidden-xs ">
            <ul class="nav navbar-nav navbar-left">
            <!-- Search -->
            <div class="search-1">
              <div class="input-group">
                <span class="input-group-addon"><i class="icon-search"></i></span>
                <input type="text" name="keyword" class="form-control" placeholder="Search a friend">
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
            <img src="<?php echo base_url(); ?>/images/user/<?php echo $image; ?>" alt="people" class="img-circle" style="height: 100px;"/>
            <h4><?php echo "$user_name"; ?></h4>
          </div>
        </div>

        <h4 class="category">Menu</h4>
        <ul class="sidebar-menu">
            <li><a href="<?php echo base_url("welcome/addclass") ?>"><i class="fa fa-file-o"></i> <span>New Class</span></a></li>
            <li><a href="essential-buttons.html"><i class="fa fa-th"></i> <span>All Class</span></a></li>
            <!-- Sample 2 Level Collapse -->
              <li class="hasSubmenu">
                <a href="#submenu"><i class="fa fa-chevron-circle-down"></i> <span>Recent Class</span></a>
                <ul id="submenu">
                  <?php  
                        foreach ($all_class as $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url("kelas/view/$value[class_nickname]"); ?>" class=""><i class="fa fa-book fa-fw"></i> <span><?php echo "$value[class_nickname]"; ?></span></a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
              </li>
        </ul>
      </div>
    </div>