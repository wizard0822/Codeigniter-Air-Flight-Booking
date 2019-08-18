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


        Booking Management


        <small>List</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Booking List</li>


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
                <div class="col-md-9"> <h3 class="box-title">All Booking Management List</h3></div>
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>

                  <th>Booking ID</th>
                  <th>Customer ID</th>
                  <th>Status</th>
                  <th>Pickup Address</th>
                  <th>Destination Address</th>
                  <th>Pickup DateTime</th>
                  <th>Booked Date</th>
                  <th>Customer Name</th>
                  <th>Customer Telephone</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                  <?php foreach ($list as $key => $value) {?>
                  <tr>
                  <td><?php echo $value['trip_id'];?></td>
                  <td><?php echo $value['id_customer'];?></td>
                  <td><?php echo $value['book_by_name'];?></td>
                  <td><?php echo $value['address'];?></td>
                  <td><?php echo $value['destination_address'];?></td>
                  <td><?php echo $value['pickup_date'].' '.$value['pickup_time'];?></td>
                  <td><span style="display: none;"><?php echo $value['added_date'];?></span><?php echo date('m/d/Y',$value['added_date']);?></td>
                  <td><?php echo $value['customer_name'];?></td>
                  <td><?php echo $value['customer_country_code'].' '.$value['customer_telephone'];?></td>
                  <td><?php if($value['status']==1){echo "Payment Successful"; } else if($value['status']==0){echo "Payment Cancel";} else if($value['status']==2){echo "Cancelled";}?></td>
                    <!-- <?php if(($value['pickup_time']>$time && $value['pickup_date']==$date && $value['status']==1) || ($value['pickup_date']>$date && $value['status']==1)){?><td><a href="<?php echo base_url();?>admin/booking/cancel_trips/<?php echo $value['trip_id'];?>"
                    rel="<?php echo $value['trip_id'];?>" class="btn btn-outline-warning btn-lg cancel_trip"
                    onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel</a></td>
                    <?php } else {?>
                    <td></td>
                    <?php } ?> -->
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                    <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url;?>admin/booking/details/booking-<?php echo md5($value['id']);?>">View</a></li>
                          <!-- <li><a  class="confirmBox"  onclick="return confirm('Are you sure to delete the vehicle type?');" href="<?php echo $base_url;?>admin/price_management/delete/<?php echo base64_encode($value['id']); ?>">Delete</a></li> -->
                          
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
      "order": [[ 7, "desc" ]]
    })
  })
</script>

</body>


</html>


