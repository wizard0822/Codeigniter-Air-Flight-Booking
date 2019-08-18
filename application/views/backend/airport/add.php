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


        Airport


        <small> Add</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Airport - Add</li>


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
                <div class="col-md-9"> <h3 class="box-title">Add Airport</h3></div>
                <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/airport" class="btn pull-right btn-primary">Back</a></div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <form class="form-horizontal" autocomplete="off" action="<?php echo $base_url; ?>admin/airport/add" method="post" id="airport_add" name="airport_add" enctype="multipart/form-data" >
                <div class="box-body">
                 <div class="form-group">
                    <label for="type" class="control-label col-md-3">ICAO</label>
                    <div class="col-md-9">
                    <input type="text" name="ICAO" id="ICAO" class="form-control" placeholder="Enter ICAO" value="<?php echo $ICAO;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Type</label>
                    <div class="col-md-9">
                    <input type="text" name="type" id="type" class="form-control" placeholder="Enter Type" value="<?php echo $type;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Name</label>
                    <div class="col-md-9">
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $name;?>" placeholder="Enter Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Address</label>
                    <div class="col-md-9">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" value="<?php echo $address;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Latitude</label>
                    <div class="col-md-9">
                    <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Enter Latitude" value="<?php echo $latitude;?>" oninput="this.value=this.value.replace(/[^0-9\-\.]/g,'');">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Longitude</label>
                    <div class="col-md-9">
                    <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Enter Longitude" value="<?php echo $longitude;?>" oninput="this.value=this.value.replace(/[^0-9\-\.]/g,'');">
                    </div>
                </div>
                  <div class="form-group">
                              <label for="status" class="control-label col-md-3">Status</label>
                              <div class="col-md-9">
                              <select class="form-control" name="status" id="status" style="width:50%">
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                                
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
    $("#airport_add").validate({
      errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            ICAO: {
                required: true,
            },
            type: {
                required: true,
            },
            name: {
                required: true,
            },
            latitude: {
                required: true,
            },
            longitude: {
                required: true,
            },
            address: {
                required: true
            }
        },
        messages: {
            ICAO: {
                required: "ICAO field is required"
            },
            type: {
                required: "Type field is required",
            },
            name: {
                required: "Name field is required",
            },
            address: {
                required: "Address field is required",
            },
            latitude: {
                required: "Latitude field is required",
            },
            longitude: {
                required: "Longitude field is required",
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


