<!DOCTYPE html>


<html>


<?php echo $header;?>


<body class="hold-transition skin-blue sidebar-mini">


<div class="wrapper">





<?php echo $top_menu;?>


<?php echo $left_nav;?>





  <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">


    <!-- Content Header (Page header) -->


    <section class="content-header">


      <h1>


        Vehicle Type


        <small> Edit</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Vehicle Type - Edit</li>


      </ol>
      <?php if ($this->session->flashdata('sess_message')) { ?>
        <div  class="pull-left label label-success" style="margin-top: 2px; margin-left: 200px;font-size: 14px;"> 
            <?php echo $this->session->flashdata('sess_message'); ?>
        </div>
      <?php } elseif ($this->session->flashdata('err_message')) { ?>
          <div  class="pull-left label label-danger" style="margin-top: 2px; margin-left: 200px;font-size: 14px;"> 
              <?php echo $this->session->flashdata('err_message'); ?>
          </div>
      <?php } ?>

    </section>





    <!-- Main content -->


    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-md-9"> <h3 class="box-title">Edit Vehicle Type</h3></div>
                <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/vehicle-type" class="btn pull-right btn-primary">Back</a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" autocomplete="off" action="<?php echo $base_url; ?>admin/vehicle-type/edit/<?php echo base64_encode($details[0]['id']);?>" method="post" id="vehicle_type_edit" name="vehicle_type_edit" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">Name</label>
                    <div class="col-md-9">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?php echo $details[0]['name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Type</label>
                    <div class="col-md-9">
                    <input type="text" name="type" id="type" class="form-control" placeholder="Enter Type" value="<?php echo $details[0]['type'];?>" onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Passenger Capacity</label>
                    <div class="col-md-9">
                    <input type="text" name="capacity" id="capacity" class="form-control" placeholder="Enter Passenger Capacity" value="<?php echo $details[0]['capacity'];?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Case Capacity</label>
                    <div class="col-md-9">
                    <input type="text" name="case_capacity" id="case_capacity" class="form-control" placeholder="Enter Case Capacity" value="<?php echo $details[0]['case_capacity'];?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Notice Period</label>
                    <div class="col-md-9">
                    <input type="text" name="notice_period" id="notice_period" class="form-control" value="<?php echo $details[0]['notice_period'];?>" placeholder="Enter Notice Period" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Customer Price Per Mile</label>
                    <div class="col-md-9">
                    <input type="text" name="customer_pricepermile" id="customer_pricepermile" class="form-control" placeholder="Enter Customer Price Per Mile" value="<?php echo $details[0]['customer_pricepermile'];?>" oninput="this.value=this.value.replace(/[^0-9\.]/g,'');">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Driver Price Per Mile</label>
                    <div class="col-md-9">
                    <input type="text" name="driver_pricepermile" id="driver_pricepermile" class="form-control" placeholder="Enter Driver Price Per Mile" value="<?php echo $details[0]['driver_pricepermile'];?>" oninput="this.value=this.value.replace(/[^0-9\.]/g,'');">
                    </div>
                </div>
                  <div class="form-group">
                              <label for="status" class="control-label col-md-3">Status</label>
                              <div class="col-md-9">
                              <select class="form-control" name="status" id="status" style="width:50%">
                                <option <?php if($details[0]['status']==1){?>selected<?php } ?> value="1">Active</option>
                                <option <?php if($details[0]['status']==0){?>selected<?php } ?> value="0">Inactive</option>
                                
                              </select>
                              </div>
                            </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->


    <!-- /.content -->


  </div>


  <!-- /.content-wrapper -->





  <?php echo $footer_content;?>





</div>


<!-- ./wrapper -->





<?php echo $footer;?>
<style type="text/css">
    .customerror{
        color: red;
    }
    .input_with_eye{
    position: relative;
   }
  .input_with_eye .custom_button_eye{
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
   }
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#vehicle_type_edit").validate({
      errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            name: {
                required: true,
            },
            type: {
                required: true,
                //minlength: 2,
                //maxlength: 4
            },
            capacity: {
                required: true,
            },
            case_capacity: {
                required: true,
            },
            notice_period: {
                required: true,
            },
            customer_pricepermile: {
                required: true,
            },
            driver_pricepermile: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Name field is required"
            },
            type: {
                required: "Type field is required",
                //minlength: "Type should be atleast 2 characters",
                //maxlength: "Type should be maximum 4 characters"
            },
            capacity: {
                required: "Passenger Capacity field is required",
            },
            capacity: {
                required: "Case Capacity field is required",
            },
            notice_period: {
                required: "Notice Period field is required",
            },
            customer_pricepermile: {
                required: "Customer Price Per Mile field is required",
            },
            driver_pricepermile: {
                required: "Driver Price Per Mile field is required",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>

</body>


</html>


