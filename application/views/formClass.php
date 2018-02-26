<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
  <title>SmartClass</title>
  <?php
      $this->load->view('include/css');
  ?>
</head>
<body>
    
  <div class="st-container">
    <?php
      $this->load->view('include/nav');
    ?>
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
                <h1 class="page-header">Create New Class</h1>
            </div>
        	</div>
        <!-- ... Your content goes here ... -->
        <div class="panel panel-default">
            <div class="panel-body">
            	<form id="classForm" class="form-horizontal" role="form" enctype="multipart/form-data" method="POST"  action="<?php echo base_url() ?>kelas/insert">
                    <div class="form-group">
                    	<label for="inputgroupname" class="col-sm-3 control-label">Group Name</label>
                        <div class="col-sm-9">
                        	<input type="text" class="form-control" id="class_name" name="class_name" placeholder="Type here..">
                        </div>
                    </div>
                    <div class="form-group">
                    	<label for="inputgroupname" class="col-sm-3 control-label">Nick Name</label>
                        <div class="col-sm-9">
                        	<input type="text" class="form-control" id="class_nickname" name="class_nickname" placeholder="Type here..">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Class Type</label>
                        <div class="col-sm-9">
                        	<select name="class_type" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">
                            	<option disabled selected value>-- Select an option --</option>
                            	<option value="1">Publik</option>
								<option value="2">Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label for="inputgroupname" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                        	<div class="input-group">
                              	<span class="input-group-addon"><i class="fa fa-key"></i></span>
                            	<input type="password" name="class_pw" id="class_pw" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" name="class_info"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label for="inputgroupname" class="col-sm-3 control-label">Class Image</label>
                        <div class="col-sm-9">
                        	<input type="file" class="form-control" id="class_image" name="class_image">
                        </div>
                    </div>
                    <div class="form-group margin-none">
                        <div class="col-sm-offset-3 col-sm-9">
                    	    <button id="addCLass" type="submit" name="submit" value="Create Group" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
    <?php
      $this->load->view('include/footer');
    ?>
  </div> <!-- st-container -->
  <?php
      $this->load->view('include/js');
    ?>
  <script type="text/javascript">
    $('#addCLass').click(function(e){
      e.preventDefault();
      var url= $('#classForm').attr('action');
      var formData= new FormData($('#classForm')[0]);
      var href= "<?php echo base_url('kelas/view');?>"+'/'+$('#class_nickname').val();
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
            $(location).attr('href', href);
          }else{
            swal('Gagal','Nick Name Sudah Digunakan','error');
          }
        },
        error: function(xhr, textStatus, error){
          console.log(xhr.statusText);
          console.log(textStatus);
          console.log(error);
        }
      });
    });
  </script>
</body>
</html>