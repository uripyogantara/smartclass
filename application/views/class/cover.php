
<div class="cover overlay cover-menu cover-image-full height-300-lg">


<?php  
$token=$this->uri->segment(3);
$tab=$this->uri->segment(2);
?>
  <ul class="cover-nav">
    <li <?php if ($tab=='view') { echo "class='active'";} ?>><a href="<?php echo base_url("kelas/view/$token") ?>"><i class="fa fa-clock-o"></i> <span>Timeline</span></a></li>
    <li <?php if ($tab=='about') { echo "class='active'";} ?> ><a href="<?php echo base_url("kelas/about/$token") ?>"><i class="fa fa-user"></i> <span>About</span></a></li>
    <li <?php if ($tab=='member') { echo "class='active'";} ?> ><a href="<?php echo base_url("kelas/member/$token") ?>"><i class="fa fa-group"></i><span> Member </span><small>(<?php echo "$count_member"; ?>)</small></a></li>
  <?php
    if (isset($detail_class)){
  ?>
    <li <?php if ($tab=='photos') { echo "class='active'";} ?> ><a href="<?php echo base_url("kelas/photos/$token") ?>"><i class="fa fa-camera"></i> <span>Photos</span> <small>(<?php echo "$count_photos"; ?>)</small></a></li>
  <?php  
  if ($detail_class['user_type']==0) {
  ?>
    <li><a href="#" class="leave" data-id="<?php echo "$detail_class[detail_class_id]" ?>"><i class="fa fa-sign-out" ></i> <span>Leave Group</span></a></li>
    <?php
  }else{
  ?>
    <li><a href="#" class="destroy" data-id="<?php echo "$detail_class[class_id]" ?>"><i class="fa fa-remove" ></i> <span>Destroy Group</span></a></li>
  <?php
  }
  ?>
  <?php
  }
  ?>
  </ul>
  <img src="<?php echo base_url("images/class/cover/$class[class_cover]") ?>" alt="cover" />

<?php  
if (isset($detail_class)){
?>
  <div class="overlay overlay-full">
    <div class="v-top">
      <form id="formCover" action="<?php echo base_url("kelas/changeCover/$token"); ?>"  enctype="multipart/form-data" method="POST"">
        <input type="file" name="image_cover" id="fileCover" class="inputcover" multiple="" accept="image/*" />
      </form>
      <a href="#" class="btn btn-cover"><label id="inputfile-label" for="fileCover"><i class="fa fa-pencil"></i></label></a>
    </div>
  </div>
<?php  
}
?>
</div>