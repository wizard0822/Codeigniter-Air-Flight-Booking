<?php echo $header;?>
<?php echo $top_menu;?>
<section class="signin_form thank_you_section ">

    <div class="inward_menu_bottom">
        <div class="container">
            <div class="inward_menu_bottom_block">
                <!-- <h1>Thank You</h1> -->
                <p><i class="fas fa-check-circle"></i></p>
                <h2>Your booking has been cancelled successfully</h2>
                <h4>Transaction ID : <?php echo $bookingDetails[0]['booking_id'];?></h4>
                <?php if($bookingDetails[0]['book_by_name']=="Return"){?>   
                 <h4>Outbound Booking ID : <?php echo $return_bookingDetails[0]['trip_id'];?></h4>
                 <h4>Inbound Booking ID : <?php echo $return_bookingDetails[1]['trip_id'];?></h4>
                <?php } else if($bookingDetails[0]['book_by_name']=="Inbound") { ?>
                 <h4>Inbound Booking ID : <?php echo $bookingDetails[0]['trip_id'];?></h4>
                <?php } else if($bookingDetails[0]['book_by_name']=="Outbound") { ?>
                 <h4>Outbound Booking ID : <?php echo $bookingDetails[0]['trip_id'];?></h4>
                <?php } ?>
                <h2>Note: <?php echo $this->session->flashdata('sess_message'); ?></h2>
            </div>
            <div class="inward_main_block_holder_one">
                <div class="inward_third_block">

                    <!-- <input type="submit" class="inward_custom_button inward_custom_button_two"
                            name="submit" value="Done"> -->
                    <a href="<?php echo base_url();?>my-booking" class="inward_custom_button inward_custom_button_two">Done</a>

                </div>
            </div>
        </div>
    </div>

</section>
<?php echo $footer;?>