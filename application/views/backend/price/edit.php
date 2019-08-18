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


        Price


        <small> Edit</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Price - Edit</li>


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
                <div class="col-md-9"> <h3 class="box-title">Edit Price</h3></div>
                <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/price-management" class="btn pull-right btn-primary">Back</a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" autocomplete="off" action="<?php echo $base_url; ?>admin/price-management/edit/<?php echo base64_encode($details[0]['id']);?>" method="post" id="price_add" name="price_add" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">Airport Name</label>
                    <div class="col-md-9">
                     <select class="form-control" name="id_airport" id="id_airport">
                      <option value=''>Select Airport</option>
                     <?php foreach($airport_list as $key => $value) { ?>
                                <option value="<?php echo $value['id'];?>" <?php if($details[0]['id_airport']==$value['id']){echo "selected";}?>><?php echo $value['name'];?></option>
                       <?php } ?>         
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Vehicle Type</label>
                    <div class="col-md-9">
                    <select class="form-control" name="id_vehicletype" id="id_vehicletype" >
                      <option value=''>Select Vehicle</option>
                     <?php foreach($vehicle_list as $key => $value) { ?>
                                <option value="<?php echo $value['id'];?>" <?php if($details[0]['id_vehicletype']==$value['id']){echo "selected";}?>><?php echo $value['name'];?></option>
                       <?php } ?>         
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Zone</label>
                    <div class="col-md-9">
                    <select class="form-control" name="id_zone" id="id_zone" >
                      <option value=''>Select Zone</option>
                     <?php foreach($zone_list as $key => $value) { ?>
                                <option value="<?php echo $value['ID_Zone'];?>" <?php if($details[0]['id_zone']==$value['ID_Zone']){echo "selected";}?>><?php echo $value['Name'];?></option>
                       <?php } ?>         
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Flight Pickup</label>
                    <div class="col-md-9">
                    <select class="form-control" name="flight_pickup" id="flight_pickup">
                                <option value="">Selct Flight Pickup</option>
                                <option <?php if($details[0]['flight_pickup']==0){?>selected<?php } ?> value="0">Dropoff</option>
                                <option <?php if($details[0]['flight_pickup']==1){?>selected<?php } ?> value="1">Pickup</option>
                                
                              </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Customer Price</label>
                    <div class="col-md-9">
                    <input type="text" name="customer_price" id="customer_price" class="form-control" placeholder="Enter Customer Price" value="<?php echo $details[0]['customer_price'];?>" oninput="this.value=this.value.replace(/[^0-9\.]/g,'');">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Driver Price</label>
                    <div class="col-md-9">
                    <input type="text" name="driver_price" id="driver_price" class="form-control" placeholder="Enter Driver Price" value="<?php echo $details[0]['driver_price'];?>" oninput="this.value=this.value.replace(/[^0-9\.]/g,'');">
                    </div>
                </div>
                  <div class="form-group">
                              <label for="status" class="control-label col-md-3">Status</label>
                              <div class="col-md-9">
                                <select class="form-control" name="status" id="status" style="width:50%">
                                <option <?php if($details[0]['status']==1){?>selected<?php } ?> value="1">Active</option>
                                <option <?php if($details[0]['status']==0){?>selected<?php } ?> value="0">Inactive</option>
                                
                              </select>
                                
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
    $("#price_add").validate({
      errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            id_airport: {
                required: true,
            },
            id_vehicletype: {
                required: true,
            },
            id_zone: {
                required: true,
            },
            flight_pickup: {
                required: true,
            },
            customer_price: {
                required: true,
            },
            driver_price: {
                required: true,
            }
        },
        messages: {
            id_airport: {
                required: "Airport Name field is required"
            },
            id_vehicletype: {
                required: "Vehicle Type field is required",
            },
             id_zone: {
                required: "Zone field is required",
            },
            flight_pickup: {
                required: "Flight Pickup field is required",
            },
            customer_price: {
                required: "Customer Price field is required",
            },
            driver_price: {
                required: "Driver Price field is required",
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


