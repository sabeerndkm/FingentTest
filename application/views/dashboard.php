<style>
.cent {
  margin-left: 12%!important;
  margin-right: 12%!important;
  width: 100%;
}

@media screen and (max-width:600px) {
  .cent {
    margin-left: 0!important;
    margin-right: 0!important;
}
}

@media (max-width: 1024px){
  .skin-blue .main-header .navbar {
    border-bottom: 2px solid #29adf5;
}

.cent {
    margin-right: 0%!important;
    margin-left:0%!important;
}
}

.row {
  width: 100%;
}

.box.box-info {
  border: 3px solid #00c0ef;
}

.crncy_cl {
  font-size:20px;
}
.inner h3 {
  overflow: hidden;
  font-size: 2em
}
@media screen and (max-width:600px) {
  .inner h3 {
    font-size: 1em
}
.crncy_cl {
    font-size:1em;
}
}

</style>
<div class=" ">
   <section class="content-header">
      <div class="col-lg-12">
         <h1>
           Dashboard
       </h1>
   </div>

</section>

<!-- Main content -->
<section class="content">
   <!-- Small boxes (Stat box) -->
   <div class="row">

     <div class="col-lg-12">
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-red">
           <div class="inner">
             <h3 class="re"><?php if (isset($employee_count) && $employee_count >= 0) {
                echo $employee_count;
            } else {
                echo "0";
            } ?></h3>
            <p class="re">Employees</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
      </div>

      <a href="<?php echo site_url('employee/index'); ?>" class="small-box-footer bgr">View More <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<!-- ./col -->
<div class="col-lg-3 col-xs-6">
   <!-- small box -->
   <div class="small-box bg-green">
     <div class="inner">
       <h3 class="bold font-weight-bold re"><?php
       if (isset($user_count) && $user_count >= 0) {
          echo $user_count;
      } else {
          echo "0";
      }        
  ?></h3>
  <p class="re">Users</p>
</div>
<div class="icon">
   <i class="fa fa-user-circle-o"></i>
</div>
<a href="<?php echo site_url('users/index');
?>" class="small-box-footer bgr">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

</div>

</div>

<!-- /.content -->
</div>
<script>
  var site_url = "<?php echo site_url(); ?>";

  $(document).ready(function() {
    <?php if($this->session->flashdata('alert_msg_noti')) { ?>
       $.notify({
         message: '<?php echo $this->session->flashdata('alert_msg_noti'); ?>' 
     },{
         allow_dismiss: true,
         placement: {
            from: "bottom",
            align: "left"
        },
        template: '<div data-notify="container" class="col-xs-11 col-sm-3" role="alert" style="border: none;">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="message">{2}</span>' +
        '</div>'
    });
   <?php } ?>
});

</script>