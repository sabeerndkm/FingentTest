<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Employee Edit</h3>
        <?php echo form_open('employee/edit/'.$employee['employeeId']); ?>
        <div class="box-body">
          <div class="row clearfix">
           <div class="col-md-6">
            <label for="employeeCode" class="control-label">  <span class="text-danger">*</span> Employee Code</label>
             <div class="form-group">
              <input type="text" name="employeeCode" value="<?php echo ($this->input->post('employeeCode') ? $this->input->post('employeeCode') : $employee['employeeCode']); ?>" class="form-control" id="employeeCode" />
              <span class="text-danger"><?php echo form_error('employeeCode');?></span>
            </div>
          </div> 
          <div class="col-md-6">
           <label for="employeeName" class="control-label">  <span class="text-danger">*</span> Employee Name</label>
           <div class="form-group">
            <input type="text" name="employeeName" value="<?php echo ($this->input->post('employeeName') ? $this->input->post('employeeName') : $employee['employeeName']); ?>" class="form-control" id="employeeName" />
            <span class="text-danger"><?php echo form_error('employeeName');?></span>
          </div>
        </div> 
        <div class="col-md-6">
         <label for="employeeDepartment" class="control-label">  <span class="text-danger">*</span> Employee Department</label>
         <div class="form-group">
          <input type="text" name="employeeDepartment" value="<?php echo ($this->input->post('employeeDepartment') ? $this->input->post('employeeDepartment') : $employee['employeeDepartment']); ?>" class="form-control" id="employeeDepartment" />
          <span class="text-danger"><?php echo form_error('employeeDepartment');?></span>
        </div>
      </div> 
      <div class="col-md-6">
       <label for="employeeAge" class="control-label">  <span class="text-danger">*</span> Employee Age</label>
       <div class="form-group">
        <input type="number" name="employeeAge" value="<?php echo ($this->input->post('employeeAge') ? $this->input->post('employeeAge') : $employee['employeeAge']); ?>" class="form-control" id="employeeAge" />
        <span class="text-danger"><?php echo form_error('employeeAge');?></span>
      </div>
    </div> 
    <div class="col-md-6">
     <label for="experienceInOrganization" class="control-label">  <span class="text-danger">*</span> Experience In Organization</label>
     <div class="form-group">
      <input type="number" name="experienceInOrganization" value="<?php echo ($this->input->post('experienceInOrganization') ? $this->input->post('experienceInOrganization') : $employee['experienceInOrganization']); ?>" class="form-control" id="experienceInOrganization" />
      <span class="text-danger"><?php echo form_error('experienceInOrganization');?></span>
    </div>
  </div> 
  <div class="col-md-6">
    <label for="employeeId" class="control-label">  <span class="text-danger"></span> Employee Status</label>
    <div class="form-group">
      <select name="employeeStatus" class="form-control">
        <?php  
        $employeeStatus_values = array(
          'active'=>'Active', 
          'inactive'=>'Inactive', 
        );
        foreach($employeeStatus_values as   $value => $display_text)
        {
          $selected = ($value == $employee['employeeStatus'] ) ? ' selected="selected"' : "";
          echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
        } 
        ?>
      </select>
      <span class="text-danger"><?php echo form_error('employeeStatus');?></span>
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
