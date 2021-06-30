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
                <h3 class="box-title">Employee Listing</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('employee/import'); ?>" class="btn btn-success btn-sm">Import Employee</a> 
                    <a href="<?php echo site_url('employee/add'); ?>" class="btn btn-success btn-sm">Add Employee</a> 
                </div>
            </div>
            <?php echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Employee Name</th>
                            <th>Employee Department</th>
                            <th>Employee Age</th>
                            <th>Experience In Organization</th>
                            <th>Employee Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=$noof_page+1; 
                        if(isset($employee) && $employee!=null)
                        {
                         foreach($employee as $e){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $e['employeeName']; ?><br><?php echo $e['employeeCode']; ?></td>
                                <td><?php echo $e['employeeDepartment']; ?></td>
                                <td><?php echo $e['employeeAge']; ?></td>
                                <td><?php echo $e['experienceInOrganization']; ?></td>
                                <td>
                                    <?php
                                    if($e['employeeStatus'] == 'active') {
                                        ?>
                                        <span class="text-success" ><b><?php echo ucfirst($e['employeeStatus']); ?></b></span>
                                        <?php
                                    }
                                    else {
                                      ?>
                                      <span class="text-danger" ><b><?php echo ucfirst($e['employeeStatus']); ?></b></span>
                                      <?php
                                  }
                                  ?>
                              </td>
                              <td>
                                <a href="<?php echo site_url('employee/edit/'.$e['employeeId']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                               <a onclick="return confirm('Are you sure you want to delete?')"
                               href="<?php echo site_url('employee/remove/'.$e['employeeId']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                                <a href="<?php echo site_url('employee/view_more/'.$e['employeeId']); ?>" class="btn btn-info btn-xs"><span class="fa fa-eye"></span> View more</a> 
                           </td>
                       </tr>
                   <?php }
               }
               ?>
           </tbody>
       </table>
       <div class="pull-right">
          <?php echo $this->pagination->create_links(); ?> 
      </div>
  </div>

</div>
</div>

</div>

