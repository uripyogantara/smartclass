<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
    <script>
    var colors = {
      "danger-color": "#e74c3c",
      "success-color": "#81b53e",
      "warning-color": "#f0ad4e",
      "inverse-color": "#2c3e50",
      "info-color": "#2d7cb5",
      "default-color": "#6e7882",
      "default-light-color": "#cfd9db",
      "purple-color": "#9D8AC7",
      "mustard-color": "#d4d171",
      "lightred-color": "#e15258",
      "body-bg": "#f6f6f6"
    };
    var config = {
      theme: "social-2",
      skins: {
        "default": {
          "primary-color": "#16ae9f"
        },
        "orange": {
          "primary-color": "#e74c3c"
        },
        "blue": {
          "primary-color": "#4687ce"
        },
        "purple": {
          "primary-color": "#af86b9"
        },
        "brown": {
          "primary-color": "#c3a961"
        },
        "default-nav-inverse": {
          "color-block": "#242424"
        }
      }
    };
    $('.leave').click(function(){
      var id=$(this).attr('data-id');
      swal({
        title: "Are You Sure?",
        text: "You will leave this class!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#26a69a",
        confirmButtonText: "Yes, Leave This Group!",
        closeOnConfirm: false
      },
      function(){
        $.post(
          '<?php echo base_url("kelas/removemember") ?>',
          {id:id},
          function(returnedData){
            window.location.reload();
            console.log(returnedData);
        }).fail(function(){
          console.log("error");
        });
      });
    });

    $('.destroy').click(function(){
      var id=$(this).attr('data-id');
      var href="<?php echo base_url(); ?>"
      swal({
        title: "Are You Sure?",
        text: "You will not able to recover this class!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#26a69a",
        confirmButtonText: "Yes, Destroy This Group!",
        closeOnConfirm: false
      },
      function(){
        $.post(
          '<?php echo base_url("kelas/destroyclass") ?>',
          {id:id},
          function(returnedData){
            $(location).attr('href', href);
            console.log(returnedData);
        }).fail(function(){
          console.log("error");
        });
      });
    });

    function readURLCover(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr({'src': event.target.result,'class':'image-cover'}).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[0]);
            
        }

    };

    $(".inputcover").change(function(){
        readURLCover(this,'#coverModal .modal-body');
        $("#coverModal").modal('show');
    });

    $(".coverBtn").click(function(e){
      e.preventDefault();
      var url=$("#formCover").attr('action');
      var formData= new FormData($("#formCover")[0]);

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
            $("#coverModal").modal('hide');
            swal({
              title: "Congratulation", 
              text: "Cover Telah diganti", 
              type: "success"
            },
            function(isConfirm){
              if (isConfirm) {
                window.location.reload();
              }
            }
            );
          }else{
            alert('error');
          }
        },
        error: function(){
          alert('cant change cover');
        }
      });
      
      // alert(url);
    });
  </script>
  <script src="<?php echo base_url(); ?>assets/js/vendor/all.js"></script>
  <script src="<?php echo base_url("assets/js/sweetalert.min.js") ?>"></script>
  <script src="<?php echo base_url(); ?>assets/js/app/app.js"></script>