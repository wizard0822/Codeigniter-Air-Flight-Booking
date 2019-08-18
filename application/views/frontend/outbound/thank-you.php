<?php echo $header;?>
<?php echo $top_menu;?>
<section class="signin_form thank_you_section ">
    <div class="inward_menu_bottom">
        <div class="container">
            <div class="inward_menu_bottom_block">
                <h1>Thank You</h1>
                <p><i class="fas fa-check-circle"></i></p>
                <h2>Your Booking is confirmed and payment was successful</h2>
                <h4>Transaction ID : <?php echo $payment_details['receiptId'];?></h4>
                <h4>Booking ID : <?php echo $data['body']['booking']['trip_id'];?></h4>
                
            </div>
            <div class="inward_main_block_holder_one">
                    <div class="inward_third_block">
                        
                        <!-- <input type="submit" class="inward_custom_button inward_custom_button_two"
                            name="submit" value="Done"> -->
                            <a href="<?php echo base_url();?>" class="inward_custom_button inward_custom_button_two">Done</a>
                            
                    </div>
                </div>
        </div>
    </div>
    
</section>
<?php echo $footer;?>
