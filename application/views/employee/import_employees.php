 <!-- DataTables -->
 <link rel="stylesheet" href="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/css/dataTables.bootstrap.min.css">
 <!-- DataTables -->
 <script src="<?php echo base_url('resources/plugins/datatables.net');  ?>/js/jquery.dataTables.min.js"></script>
 <script src="<?php echo base_url('resources/plugins/datatables.net-bs');  ?>/js/dataTables.bootstrap.min.js"></script>
 <script>
    $(function () {
        $('#example1').DataTable()
    })
</script>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Upload Employee details</h3>
                <div class="box-tools">

                </div>
            </div>
            <?php echo $this->session->flashdata('alert_msg');?>
            <form method="post" id="import_form1" action="<?php echo site_url('employee/import'); ?>" enctype="multipart/form-data">
             <div class="box-body">
                <p>
                    <label>Select CSV File</label>
                    <input type="file" name="file" id="file" required accept=".xls, .xlsx, .csv" />
                </p>
                <span class="text-danger"><b><?php echo form_error('csv_file');?></b></span>
                <br/>
                <h4 class="text-danger">Note:</h4>
                <ul class="text-danger">
                    <li> Supported Formats : xls, xlsx. (Max 5MB)</li>
                    <li> Before fill or enter details to Excel sheet, Set the Category ID column to text format.</li>
                    <li>File should contain minimum of 5 columns and maximum of 20 rows.</li>
                    <li>A sample sheet is attached here. Please click on<a target="_blank" href="<?php echo site_url('employee/sample_sheet'); ?>"> Download <i class="fa fa-download"></i></a> and use this Excel sheet to fill the employee details.</li>
                </ul>

                <div class="col-md-12">
                    <label class="control-label"><span class="text-danger">*</span> Are you used the Sample sheet?</label>
                    <div class="form-group">
                        <div class="col-md-3">
                            <input type="radio" name="sample_sheet_used" id="option-1" class="sample_sheet_used" value="Yes" <?php echo ($this->input->post('sample_sheet_used') == "Yes" ? 'checked="checked"' : ''); ?> required>
                            <label for="option-1" class="option option-1">
                                <span class="text-success"> Yes</span>
                            </label>
                        </div>
                        <div class="col-md-3">
                           <input type="radio" name="sample_sheet_used" id="option-2" class="sample_sheet_used" value="No" <?php echo ($this->input->post('sample_sheet_used') == "No" ? 'checked="checked"' : ''); ?> required>
                           <label for="option-2" class="option option-2">
                               <span class="text-danger"> No</span>
                           </label>
                       </div>
                   </div> 
               </div>
               <div class="col-md-12" id="no_section">
                 <div class="form-group">
                  <label class="control-label">  <span class="text-danger">*</span> Enter the Column Numbers in CSV File</label>
              </div>

              <div class="form-group">
                  <div class="col-md-2">
                      <label for="employeeCode" class="control-label">  <span class="text-danger"></span> Employee Code</label>
                      <input type="text" name="employeeCode" value="<?php echo ($this->input->post('employeeCode') ? $this->input->post('employeeCode') : ""); ?>" class="form-control"  />
                      <span class="text-danger"><?php echo form_error('employeeCode');?></span>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-2">
                      <label for="employeeName" class="control-label">  <span class="text-danger"></span> Employee Name</label>
                      <input type="text" name="employeeName" value="<?php echo ($this->input->post('employeeName') ? $this->input->post('employeeName') : ""); ?>" class="form-control"  />
                      <span class="text-danger"><?php echo form_error('employeeName');?></span>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-2">
                      <label for="employeeDepartment" class="control-label">  <span class="text-danger"></span> Employee Department</label>
                      <input type="text" name="employeeDepartment" value="<?php echo ($this->input->post('employeeDepartment') ? $this->input->post('employeeDepartment') : ""); ?>" class="form-control"  />
                      <span class="text-danger"><?php echo form_error('employeeDepartment');?></span>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-2">
                      <label for="employeeAge" class="control-label">  <span class="text-danger"></span> Employee DOB</label>
                      <input type="text" name="employeeAge" value="<?php echo ($this->input->post('employeeAge') ? $this->input->post('employeeAge') : ""); ?>" class="form-control"  />
                      <span class="text-danger"><?php echo form_error('employeeAge');?></span>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-2">
                      <label for="experienceInOrganization" class="control-label">  <span class="text-danger"></span> Employee Joining Date</label>
                      <input type="text" name="experienceInOrganization" value="<?php echo ($this->input->post('experienceInOrganization') ? $this->input->post('experienceInOrganization') : ""); ?>" class="form-control"  />
                      <span class="text-danger"><?php echo form_error('experienceInOrganization');?></span>
                  </div>
              </div>
          </div>
      </div>
      <div class="box-footer" align="center">
        <input type="submit" name="import" value="Import" class="btn btn-success" />
    </div>
</form>

</div>
</div>

</div>
<script>
    $(document).ready(function(){
        <?php
        if($this->input->post('sample_sheet_used') == "No") {
            ?>
            $("#no_section").show();
            <?php
        } else {
            ?>
            $("#no_section").hide();
            <?php 
        }
        ?>
        $(".sample_sheet_used").click(function(e) {
            var sheet_val = $(this).val();
            if(sheet_val == "No") {
                $("#no_section").show();
            } else {
                $("#no_section").hide();
            }
        });
    });
</script>

