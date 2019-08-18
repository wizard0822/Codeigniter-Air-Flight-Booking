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


        <small>List</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Vehicle Type List</li>


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
                <div class="col-md-9"> <h3 class="box-title">All Vehicle Type List</h3></div>
                 <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/vehicle-type/add" class="btn pull-right btn-primary">Add</a></div> 
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Passenger Capacity</th>
                  <th>Case Capacity</th>
                  <th>Notice Period</th>
                  <th>Customer Price Per Mile</th>
                  <th>Driver Price Per Mile</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                  <?php foreach ($list as $key => $value) {?>
                  <tr>
                   <td>
                    <?php echo $value['id'];?>
                    </td>
                    <td>
                    <?php echo $value['name'];?>
                    </td>
                   <td>
                    <?php echo $value['type'];?>
                    </td>
                   <td><?php echo $value['capacity'];?></td>
                   <td><?php echo $value['case_capacity'];?></td>
                   <td><?php echo $value['notice_period'];?></td>
                    <td><?php echo $value['customer_pricepermile'];?></td>
                    <td><?php echo $value['driver_pricepermile'];?></td>
                    <td>
                    <?php if($value['status']==1) { ?>
                      <a href="<?php echo $base_url;?>admin/vehicle_type/inactivate/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to change this active?');">
                      <span class="label label-sm label-success"> Active </span>
                      </a>
                      <?php } else{ ?>
                      <a href="<?php echo $base_url;?>admin/vehicle_type/activate/<?php echo base64_encode($value['id']); ?>"  class="confirmBox  btn btn-mini hidden-phone hidden-tablet"  onclick="return confirm('Are you sure you want to change this inactive?');">
                      <span class="label label-sm label-danger"> Inactive </span>
                      </a>
                      <?php } ?>
                    </td>
                    
                     <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url;?>admin/vehicle-type/edit/<?php echo base64_encode($value['id']); ?>">Edit</a></li>
                          <li><a  class="confirmBox"  onclick="return confirm('Are you sure to delete the vehicle type?');" href="<?php echo $base_url;?>admin/vehicle_type/delete/<?php echo base64_encode($value['id']); ?>">Delete</a></li>
                          
                        </ul>
                      </div>
                    </td> 
                    </tr>
                  <?php } ?>
                
                
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Display Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>active</th> -->
                  <!-- <th>Added Date</th> -->
                  <!-- <th>Action</th> -->
                <!-- </tr>
                </tfoot> -->
              </table>
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
<script>
  $(function () {
    // $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      "pageLength": 50,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "order": [[ 8, "desc" ]]
    })
  })
</script>

</body>


</html>


