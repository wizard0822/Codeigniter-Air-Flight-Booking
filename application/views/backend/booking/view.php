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


        Booking


        <small>Details</small>


      </h1>


      <ol class="breadcrumb">


        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>


        <li class="active">Booking Details</li>


      </ol>

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
              <h3 class="box-title"><?php echo $bookingDetails[0]['book_by_name'];?> Details Booking</h3>
              <div class="col-md-3 pull-right" ><a href="<?php echo $base_url;?>admin/booking" class="btn pull-right btn-primary">Back</a></div>
            </div>
            <!-- /.box-header -->
            <?php if($bookingDetails[0]['book_by_name']!='Return'){ ?>
            <div class="box-body">
              <div class="box-body">
                <h5 class="box-title"> Flight Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Flight Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['airline_name']?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Origin Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['airline_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Destination Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['destinationName'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title"> Trip Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Pickup Location</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Destination Location</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['destination_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Pickup Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['pickup_time'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if($bookingDetails[0]['required_arrival_datetime']!=''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Arrival Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['required_arrival_datetime'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } ?>
                <?php if($bookingDetails[0]['via1_address']!='' && $bookingDetails[0]['via2_address']=='' && $bookingDetails[0]['via3_address']==''){?>
                 <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } else if($bookingDetails[0]['via1_address']!='' && $bookingDetails[0]['via2_address']!='' && $bookingDetails[0]['via3_address']==''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via2</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['via2_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } else if($bookingDetails[0]['via1_address']!='' && $bookingDetails[0]['via2_address']!='' && $bookingDetails[0]['via3_address']!=''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via2</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['via2_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via3</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['via3_address'];?>" readonly="readonly">
                      
                      </div>
                  </div> 
                <?php } ?>
              </div>

              <div class="box-body">
                <h5 class="box-title"> Other Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Passengers</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['no_passengers'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Vehicle Type</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['vehicle_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Large Cases</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['no_large_cases'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Cabin Cases</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['no_cabin_cases'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                   <?php if($bookingDetails[0]['notes']!=''){?>
                    <div class="form-group">
                      <label for="type" class="control-label col-md-3">Driver Notes</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['notes'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php } ?>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title"> Contact Informations</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Customer Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['customer_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Customer Email</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['customer_email'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Customer Telephone</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['customer_country_code']." ".$bookingDetails[0]['customer_telephone'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title"> Payment Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Price</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $bookingDetails[0]['tip_price'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if(!empty($bookingDetails[0]['tips'])){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Tip</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $bookingDetails[0]['tips'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php } ?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Total</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $bookingDetails[0]['total'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title"> Booking Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking Date</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['pickup_date'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['pickup_time'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking ID</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['trip_id'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Transaction ID</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['booking_id'];?>" readonly="readonly">
                      
                      </div>
                  </div>

                  <?php if($bookingDetails[0]['refund_status']!="0"){ 
                  	if($bookingDetails[0]['refund_status']=="1"){
                  	?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Refund Status</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="Your refund of £ <?php echo $bookingDetails[0]['total'];?> has been successfully processed" readonly="readonly">
                      </div>
                  </div>
                  <?php } else { ?>
                  	<div class="form-group">
                      <label for="type" class="control-label col-md-3">Refund Status</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="Your cancellation is not eligible for refund" readonly="readonly">
                      </div>
                  </div>
                  <?php } } ?>

              <?php if($bookingDetails[0]['pickup_time']>$time && $bookingDetails[0]['pickup_date']==$date && $bookingDetails[0]['status']!=2){?>
               <div class="box-footer">
                  <!-- <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button> -->
                   <a href="<?php echo base_url();?>admin/booking/cancel_trips1/<?php echo $bookingDetails[0]['trip_id'];?>"
                        rel="<?php echo $bookingDetails[0]['trip_id'];?>"
                        class="btn btn-primary"
                        onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel Booking</a>
                </div>
                <?php } else if($bookingDetails[0]['pickup_date']>$date && $bookingDetails[0]['status']!=2){?>
                <div class="box-footer">
                  <!-- <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button> -->
                   <a href="<?php echo base_url();?>admin/booking/cancel_trips1/<?php echo $bookingDetails[0]['trip_id'];?>"
                        rel="<?php echo $bookingDetails[0]['trip_id'];?>"
                        class="btn btn-primary"
                        onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel Booking</a>
                </div>
                <?php } ?>
                <!-- /.box-body -->
            </div>
            <?php } else { ?>
            <div class="box-body">
              <div class="box-body">
                <h5 class="box-title">Outbound Flight Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Flight Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $bookingDetails[0]['airline_name']?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Origin Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['airline_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Destination Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['destinationName'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title">Outbound Trip Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Pickup Location</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Destination Location</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['destination_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Pickup Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['pickup_time'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if($return_bookingDetails[0]['required_arrival_datetime']!=''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Arrival Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['required_arrival_datetime'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } ?>
                <?php if($return_bookingDetails[0]['via1_address']!='' && $return_bookingDetails[0]['via2_address']=='' && $return_bookingDetails[0]['via3_address']==''){?>
                 <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } else if($return_bookingDetails[0]['via1_address']!='' && $return_bookingDetails[0]['via2_address']!='' && $return_bookingDetails[0]['via3_address']==''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via2</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['via2_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } else if($return_bookingDetails[0]['via1_address']!='' && $return_bookingDetails[0]['via2_address']!='' && $return_bookingDetails[0]['via3_address']!=''){?>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via2</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['via2_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via3</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['via3_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } ?> 
              </div>

              <div class="box-body">
                <h5 class="box-title">Outbound Other Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Passengers</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['no_passengers'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Vehicle Type</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['vehicle_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Large Cases</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['no_large_cases'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Cabin Cases</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['no_cabin_cases'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if($return_bookingDetails[0]['notes']!=''){?>
                    <div class="form-group">
                      <label for="type" class="control-label col-md-3">Driver Notes</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['notes'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php } ?>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title">Outbound Payment Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Price</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $return_bookingDetails[0]['tip_price'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if(!empty($return_bookingDetails[0]['tips'])){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Tip</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $return_bookingDetails[0]['tips'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php } ?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Total</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $return_bookingDetails[0]['total'];?>" readonly="readonly">
                      
                      </div>
                  </div>
              </div>


              <div class="box-body">
                <h5 class="box-title">Outbound Booking Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking Date</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['pickup_date'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['pickup_time'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking ID</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[0]['trip_id'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>
                <!-- /.box-body -->
            </div>
            <div class="box-body">
              <div class="box-body">
                <h5 class="box-title">Inbound Flight Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Flight Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['airline_name']?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Origin Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['airline_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Destination Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['destinationName'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title">Inbound Trip Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Pickup Location</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Destination Location</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['destination_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Pickup Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['pickup_time'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if($return_bookingDetails[1]['required_arrival_datetime']!=''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Arrival Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['required_arrival_datetime'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } ?>
                 <?php if($return_bookingDetails[1]['via1_address']!='' && $return_bookingDetails[1]['via2_address']=='' && $return_bookingDetails[1]['via3_address']==''){?>
                 <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } else if($return_bookingDetails[1]['via1_address']!='' && $return_bookingDetails[1]['via2_address']!='' && $return_bookingDetails[1]['via3_address']==''){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via2</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['via2_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } else if($return_bookingDetails[1]['via1_address']!='' && $return_bookingDetails[1]['via2_address']!='' && $return_bookingDetails[1]['via3_address']!=''){?>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via1</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['via1_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via2</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['via2_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Via3</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['via3_address'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                <?php } ?> 
              </div>

              <div class="box-body">
                <h5 class="box-title">Inbound Other Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Passengers</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['no_passengers'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Vehicle Type</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['vehicle_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Large Cases</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['no_large_cases'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Number of Cabin Cases</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['no_cabin_cases'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if($return_bookingDetails[1]['notes']!=''){?>
                    <div class="form-group">
                      <label for="type" class="control-label col-md-3">Driver Notes</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['notes'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php } ?>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title"> Contact Informations</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Customer Name</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['customer_name'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Customer Email</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['customer_email'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Customer Telephone</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['customer_telephone'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title">Inbound Payment Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Price</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $return_bookingDetails[1]['tip_price'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php if(!empty($return_bookingDetails[1]['tips'])){?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Tip</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $return_bookingDetails[1]['tips'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <?php } ?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Total</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="£ <?php echo $return_bookingDetails[1]['total'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  
              </div>

              <div class="box-body">
                <h5 class="box-title">Inbound Booking Details</h5>
                <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking Date</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['pickup_date'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking Time</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['pickup_time'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Booking ID</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['trip_id'];?>" readonly="readonly">
                      
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Transaction ID</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="<?php echo $return_bookingDetails[1]['booking_id'];?>" readonly="readonly">
                      
                      </div>
                  </div>

                   <?php
//t($return_bookingDetails);
                    if($return_bookingDetails[0]['refund_status']!="0"){ 
                  	if($return_bookingDetails[0]['refund_status']=="1"){
                  	?>
                  <div class="form-group">
                      <label for="type" class="control-label col-md-3">Refund Status</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="Your refund of £ <?php echo $return_bookingDetails[0]['total']+$return_bookingDetails[1]['total'];?> has been successfully processed" readonly="readonly">
                      </div>
                  </div>
                  <?php } else { ?>
                  	<div class="form-group">
                      <label for="type" class="control-label col-md-3">Refund Status</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" value="Your cancellation is not eligible for refund" readonly="readonly">
                      </div>
                  </div>
                  <?php } } ?>

                  
              </div>
              <?php if($return_bookingDetails[1]['pickup_time']>$time && $return_bookingDetails[1]['pickup_date']==$date && $return_bookingDetails[1]['status']!=2){?>
               <div class="box-footer">
                  <!-- <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button> -->
                   <a href="<?php echo base_url();?>admin/booking/cancel_trips/<?php echo $return_bookingDetails[0]['trip_id'];?>/<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        rel="<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        class="btn btn-primary"
                        onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel Booking</a>
                </div>
                <?php } else if($return_bookingDetails[1]['pickup_date']>$date && $return_bookingDetails[1]['status']!=2){?>
                <div class="box-footer">
                  <!-- <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Submit</button> -->
                   <a href="<?php echo base_url();?>admin/booking/cancel_trips/<?php echo $return_bookingDetails[0]['trip_id'];?>/<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        rel="<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        class="btn btn-primary"
                        onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel Booking</a>
                </div>
                <?php } ?>
                <!-- /.box-body -->
            </div>
            <?php } ?>
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
</style>
<script src="https://cdn.ckeditor.com/4.11.0/standard/ckeditor.js"></script>
<script>
      CKEDITOR.replace( 'description' );
</script>
<script type="text/javascript">
    $("#question_edit").validate({
        errorElement: 'span',
        errorClass: 'customerror',
        rules: {
            
           name: {
               required: true
           },
           link: {
               url: true,
               required:true
           }
        },
        messages: {
         
          name: {
             required: "Please provide name!"
          },
          link: {
             required: "Please provide link!",
             url: "Please provide link with http:// format!"
          }

        }
    });
    
    
</script>

</body>


</html>


