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
                <h3 class="box-title">Users  Listing</h3>
                <div class="box-tools">
                    <a href="<?php echo site_url('users/add'); ?>" class="btn btn-success btn-sm">Add User</a> 
                </div>
            </div>
            <?php echo $this->session->flashdata('alert_msg');?>
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Username</th>
                            <th>User Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=$noof_page+1; 
                        if(isset($users) && $users!=null)
                        {
                           foreach($users as $u) { 
                            if($u['username'] != 'admin@gmail.com') {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $u['username']; ?></td>
                                <td>
                                    <?php
                                    if($u['userStatus'] == 'active') {
                                        ?>
                                        <span class="text-success" ><b><?php echo ucfirst($u['userStatus']); ?></b></span>
                                        <?php
                                    }
                                    else {
                                      ?>
                                      <span class="text-danger" ><b><?php echo ucfirst($u['userStatus']); ?></b></span>
                                      <?php
                                  }
                                  ?>
                              </td>
                              <td>
                                <?php
                                if($this->session->userdata(SESSION_ADMIN_NAME) == 'admin@gmail.com' || $this->session->userdata(SESSION_ADMIN_NAME) == $u['username']) {
                                    ?>
                                    <a href="<?php echo site_url('users/edit/'.$u['userId']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                                    <a onclick="return confirm('Are you sure you want to delete?')"
                                    href="<?php echo site_url('users/remove/'.$u['userId']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                                    <!-- <a href="<?php echo site_url('users/view_more/'.$u['userId']); ?>" class="btn btn-info btn-xs"><span class="fa fa-eye"></span> View more</a>  -->
                                <?php } else {
                                      ?>
                                      <span class="text-danger" ><b>No Action available</b></span>
                                      <?php
                                  } ?>
                            </td>
                        </tr>
                    <?php } }

                }else{
                  echo 'No data found';
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

