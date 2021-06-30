<div class="row">
  <div class="col-md-12">
    <?php echo form_open('employee/add'); ?>
    <div class="col-md-6">
     <label for="employeeCode" class="control-label"> <span class="text-danger">*</span> Employee Code</label>
     <div class="form-group">
      <input type="text" name="employeeCode" value="<?php echo $this->input->post('employeeCode'); ?>" class="form-control " id="employeeCode" />
      <span class="text-danger"><?php echo form_error('employeeCode');?></span>
    </div>
  </div>
  <div class="col-md-6">
   <label for="employeeName" class="control-label"> <span class="text-danger">*</span> Employee Name</label>
   <div class="form-group">
    <input type="text" name="employeeName" value="<?php echo $this->input->post('employeeName'); ?>" class="form-control " id="employeeName" />
    <span class="text-danger"><?php echo form_error('employeeName');?></span>
  </div>
</div>
<div class="col-md-6">
 <label for="employeeDepartment" class="control-label"> <span class="text-danger">*</span> Employee Department</label>
 <div class="form-group">
  <input type="text" name="employeeDepartment" value="<?php echo $this->input->post('employeeDepartment'); ?>" class="form-control " id="employeeDepartment" />
  <span class="text-danger"><?php echo form_error('employeeDepartment');?></span>
</div>
</div>
<div class="col-md-6">
 <label for="employeeAge" class="control-label"> <span class="text-danger">*</span> Employee Age</label>
 <div class="form-group">
  <input type="number" name="employeeAge" value="<?php echo $this->input->post('employeeAge'); ?>" class="form-control " id="employeeAge" />
  <span class="text-danger"><?php echo form_error('employeeAge');?></span>
</div>
</div>
<div class="col-md-6">
 <label for="experienceInOrganization" class="control-label"> <span class="text-danger">*</span> Experience In Organization (Year)</label>
 <div class="form-group">
  <input type="number" step="any" name="experienceInOrganization" value="<?php echo $this->input->post('experienceInOrganization'); ?>" class="form-control " id="experienceInOrganization" />
  <span class="text-danger"><?php echo form_error('experienceInOrganization');?></span>
</div>
</div>
<div class="col-md-6">
  <label for="employeeStatus" class="control-label"> <span class="text-danger"></span>  Employee Status</label>
  <div class="form-group">
    <select name="employeeStatus" class="form-control">
      <?php 
      $employeeStatus_values = array(
       'active'=>'Active', 
       'inactive'=>'Inactive', 
     );

      foreach($employeeStatus_values as   $value => $display_text)
      {
        $selected = ($value == $this->input->post('employeeStatus')) ? ' selected="selected"' : "";
        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
      } 
      ?>
    </select>
    <span class="text-danger"><?php echo form_error('employeeStatus');?></span>
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
