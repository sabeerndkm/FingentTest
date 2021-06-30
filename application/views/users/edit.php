<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Users Edit</h3>
        <?php echo form_open('users/edit/'.$users['userId']); ?>
        <div class="box-body">
          <div class="row clearfix">
           <div class="col-md-6">
             <label for="username" class="control-label">  <span class="text-danger">*</span> Username</label>
             <div class="form-group">
              <input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $users['username']); ?>" class="form-control" id="username" />
              <span class="text-danger"><?php echo form_error('username');?></span>
            </div>
          </div> 
          <div class="col-md-6">
           <label for="password" class="control-label">  <span class="text-danger">*</span> Password</label>
           <div class="form-group">
            <input type="password" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $users['password']); ?>" class="form-control" id="password" />
            <span class="text-danger"><?php echo form_error('password');?></span>
          </div>
        </div> 
        <div class="col-md-6">
          <label for="userId" class="control-label">  <span class="text-danger"></span>  User Status</label>
          <div class="form-group">
            <select name="userStatus" class="form-control">
              <?php  
              $userStatus_values = array(
                'active'=>'Active', 
                'inactive'=>'Inactive', 
              );
              foreach($userStatus_values as   $value => $display_text)
              {
                $selected = ($value == $users['userStatus'] ) ? ' selected="selected"' : "";
                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
              } 
              ?>
            </select>
            <span class="text-danger"><?php echo form_error('userStatus');?></span>
          </div>
        </div> 
      </div>
    </div>
    <div class="box-footer" align="center">
      <button type="submit" class="btn btn-success">
        <i class="fa fa-check"></i> Update
      </button>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
</div>
</div>
