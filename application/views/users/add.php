<div class="row">
  <div class="col-md-12">
    <?php echo form_open('users/add'); ?>
    <div class="col-md-6">
     <label for="username" class="control-label"> <span class="text-danger">*</span> Username</label>
     <div class="form-group">
      <input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control " id="username" />
      <span class="text-danger"><?php echo form_error('username');?></span>
    </div>
  </div>
  <div class="col-md-6">
   <label for="password" class="control-label"> <span class="text-danger">*</span> Password</label>
   <div class="form-group">
    <input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control " id="password" />
    <span class="text-danger"><?php echo form_error('password');?></span>
  </div>
</div>
<div class="col-md-6">
  <label for="userStatus" class="control-label"> <span class="text-danger"></span>  User Status</label>
  <div class="form-group">
    <select name="userStatus" class="form-control">
      <?php 
      $userStatus_values = array(
       'active'=>'Active', 
       'inactive'=>'Inactive', 
     );
      foreach($userStatus_values as   $value => $display_text)
      {
        $selected = ($value == $this->input->post('userStatus')) ? ' selected="selected"' : "";
        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
      } 
      ?>
    </select>
    <span class="text-danger"><?php echo form_error('userStatus');?></span>
  </div>
</div>
</div>
<div class="col-md-12" align="center">
 <label for=" " class="control-label"> </label>
 <div class="form-group">
   <button type="submit" class="btn btn-success">  
     <i class="fa fa-check"></i> Save 
   </button> 
 </div>
</div>
<?php echo form_close(); ?>
</div>
