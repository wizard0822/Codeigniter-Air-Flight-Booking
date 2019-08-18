<?php echo $header;?>
<?php echo $top_menu;?>

<section class="inward_menu_bottom">
    <div class="container">

        <form class="inward_menu_bottom_block" method="post" name="return_step11_form" id="return_step11_form"
            method="post" action="<?php echo base_url();?>return/step11" autocomplete="off">
            <div class="inward_main_block_holder">
                <div class="blue_header_form justify-content-center d-flex align-items-center">
                    <h5 class="font-weight-bold mb-0">INBOUND BOOKING DETAILS</h5>
                </div>
                <div class="inward_main_block_holder_one twelve_main">
                    <div class="inward_menu_bottom_inner twelve_main_holder">

                        <div class="twelve">
                            <div class="twelve_one">
                                <h3>Do you want to tip the driver?</h3>
                            </div>
                            <div class="twelve_two">

                                <img src="<?php echo base_url();?>assets/frontend/images/return.png">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="inward_main_block_holder_one">
                    <div class="inward_third_block">
                        <!-- <button class="inward_custom_button inward_custom_button_one inward_custom_button_one_border return_custom_button_one_color"
                                id="back"><span>NO</span></button>
                            <button class="inward_custom_button inward_custom_button_two return_custom_button_two_color" id="next"><span>
                                    YES</span> -->
                        <a class="inward_custom_button inward_custom_button_one_one"
                            href="<?php echo base_url();?>return/step13"><span>NO</span></a>
                        <input type="submit"
                            class="inward_custom_button inward_custom_button_two return_custom_button_two_color"
                            name="submit" value="YES">


                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php echo $footer;?>