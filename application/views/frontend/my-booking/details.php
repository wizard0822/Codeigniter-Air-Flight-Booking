<?php echo $header;?>
<?php echo $top_menu;?>
<section class="trip_details_header background_grey">
    <div class="container">
        <h3 class="font-weight-normal">Trip Details</h3>
    </div>

</section>
<?php if($bookingDetails[0]['book_by_name']!='Return'){ ?>
<section class="address_and_back_holder">
    <div class="container">
        <?php if($this->session->flashdata('err_message')!='') { ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('err_message'); ?></span>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('sess_message')!='') { ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('sess_message'); ?></span>
        </div>
        <?php } ?>
        <div class="border_area background_light_green py-3 mt-5 ">
            <div class="d-flex justify-content-between blue-head-sec">
                <div class="address position-relative">
                    <div class="d-flex align-items-center">
                        <?php if($bookingDetails[0]['status']==2){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                        <?php } else if($bookingDetails[0]['pickup_time']>$time && $bookingDetails[0]['pickup_date']==$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($bookingDetails[0]['pickup_date']<=$date2 && $bookingDetails[0]['pickup_date']>$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($bookingDetails[0]['pickup_time']<$time && $bookingDetails[0]['pickup_date']==$date ){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } else if($bookingDetails[0]['pickup_date']>$date){ ?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($bookingDetails[0]['pickup_date']<$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } ?>
                        <h4 class="font_20 font-weight-bold mb-0">
                            <?php echo date("d F Y",strtotime($bookingDetails[0]['pickup_date']));?>
                        </h4>

                    </div>

                    <p class="mt-3"><?php echo $bookingDetails[0]['airport_name'];?></p>
                </div>

                <div class="tags details_page_tags">
                    <p class="tag_booking text-uppercase"><?php echo $bookingDetails[0]['book_by_name'];?> booking
                        details</p>
                </div>

                <div class="back">
                    <a href="<?php echo base_url();?>my-booking" class="text-decoration-none color_unset">
                        <h4 class="font_20 font-weight-normal d-flex align-items-center"><i
                                class="fas fa-chevron-left mr-2"></i>
                            <p>Back</p>
                        </h4>
                    </a>
                </div>
            </div>
        </div>


    </div>

</section>

<section class="details_part">
    <div class="container">
        <div class="border_area">
            <div class="border_bottom_dashed flight_details_holder py-3">
                <h4 class="primary_text_color">Flight Details</h4>
                <div class="mt-3 d-flex justify-content-between align-items-end">
                    <div>
                        <small class="footer_color">Flight No.</small>
                        <p style="margin-bottom:15px;"><?php echo $bookingDetails[0]['airline_name'];?></p>
                        <small class="footer_color">Origin</small>
                        <p><?php echo $bookingDetails[0]['originName'];?></p>
                        <p><?php echo $bookingDetails[0]['terminal_orig'];?></p>
                    </div>
                    <div>
                        <small class="footer_color">Destination</small>
                        <p><?php echo $bookingDetails[0]['destinationName'];?></p>
                        <p><?php echo $bookingDetails[0]['terminal_dest'];?></p>
                    </div>
                </div>
            </div>

            <div class="border_bottom_dashed trip_details_holder py-3">
                <h4 class="primary_text_color">Trip Details</h4>
                <div class="d-grid trip_details_grid mt-2">
                    <div class="trip_deatils">
                        <small class="footer_color">Pickup Location</small>
                        <p><?php echo $bookingDetails[0]['address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Destination Airport</small>
                        <p><?php echo $bookingDetails[0]['destination_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Pickup Time</small>
                        <p><?php echo $bookingDetails[0]['pickup_time'];?></p>
                    </div>
                    <?php if($bookingDetails[0]['required_arrival_datetime']!=''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Arrival Time</small>
                        <p><?php echo $bookingDetails[0]['required_arrival_datetime'];?></p>
                    </div>
                    <?php } ?>
                </div>

                <div class="d-grid via_details_grid mt-2">
                    <?php if($bookingDetails[0]['via1_address']!='' && $bookingDetails[0]['via2_address']=='' && $bookingDetails[0]['via3_address']==''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $bookingDetails[0]['via1_address'];?></p>
                    </div>
                    <?php } else if($bookingDetails[0]['via1_address']!='' && $bookingDetails[0]['via2_address']!='' && $bookingDetails[0]['via3_address']==''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $bookingDetails[0]['via1_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 2</small>
                        <p><?php echo $bookingDetails[0]['via2_address'];?></p>
                    </div>
                    <?php } else if($bookingDetails[0]['via1_address']!='' && $bookingDetails[0]['via2_address']!='' && $bookingDetails[0]['via3_address']!=''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $bookingDetails[0]['via1_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 2</small>
                        <p><?php echo $bookingDetails[0]['via2_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 3</small>
                        <p><?php echo $bookingDetails[0]['via3_address'];?></p>
                    </div>
                    <?php } ?>
                </div>

                <div class="other_details mt-3">
                    <small class="primary_text_color">Other Details</small>

                    <div class="d-grid other_details_grid mt-2">
                        <div class="trip_deatils">
                            <small class="footer_color">Number of Passengers</small>
                            <p><?php echo $bookingDetails[0]['no_passengers'];?></p>
                        </div>
                        <div class="trip_deatils">
                            <small class="footer_color">Vehicle Type</small>
                            <p><?php echo $bookingDetails[0]['vehicle_name'];?></p>
                        </div>
                        <div class="trip_deatils">
                            <small class="footer_color">Number of Large Cases</small>
                            <p><?php echo $bookingDetails[0]['no_large_cases'];?></p>
                        </div>

                        <div class="trip_deatils">
                            <small class="footer_color">Number of Cabin Cases</small>
                            <p><?php echo $bookingDetails[0]['no_cabin_cases'];?></p>
                        </div>

                        <?php if($bookingDetails[0]['notes']!=''){?>
                        <div class="trip_deatils">
                            <small class="footer_color">Driver Notes</small>
                            <p><?php echo $bookingDetails[0]['notes'];?></p>
                        </div>
                        <?php } ?>


                    </div>
                </div>
            </div>

            <div class="border_bottom_dashed contact_information_holder py-3">
                <h4 class="primary_text_color">Contact Informations</h4>
                <div class="mt-3">
                    <div class="d-grid contact_info_grid mt-2">
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-user mr-2 primary_text_color"></i>
                            <p class="footer_color mb-0"> <?php echo $bookingDetails[0]['customer_name'];?></p>
                        </div>
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-envelope mr-2 primary_text_color"></i>
                            <p class="footer_color mb-0"><?php echo $bookingDetails[0]['customer_email'];?></p>
                        </div>
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-phone phone_rotate mr-1 primary_text_color"></i>
                            <p class="footer_color mb-0">
                                <?php echo $bookingDetails[0]['customer_country_code'],' '.$bookingDetails[0]['customer_telephone'];?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="payment_details_holder py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="primary_text_color">Payment Details</h4>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-center">
                                    <div class="payment_details">
                                        <small class="footer_color">Price</small>
                                        <p class="mb-0"><span>£</span><?php echo $bookingDetails[0]['tip_price'];?></p>
                                    </div>
                                    <?php if(!empty($bookingDetails[0]['tips'])){?>
                                    <div class="payment_details mx-3">
                                        <p class="mb-0">+</p>
                                    </div>
                                    <div class="payment_details">
                                        <small class="footer_color">Tip</small>
                                        <p class="mb-0">
                                            <span>£</span><?php echo $bookingDetails[0]['tips'];?>
                                        </p>
                                    </div>
                                    <?php } ?>
                                </div>



                            </div>
                            <div class="btn_and_total mt-3">
                                <h3 class="primary_text_color font-weight-bold">
                                    <span>£</span><?php echo $bookingDetails[0]['total'];?>
                                </h3>
                            </div>

                        </div>
                    </div>

                    <div class="booking_details text-right mt-2">
                        <p class="mb-2"><span class="footer_color">Booking Date:</span>
                            <?php echo date("d F Y",$bookingDetails[0]['added_date']);?></p>
                        <p class="mb-2"><span class="footer_color">Booking Time :</span>
                            <?php echo date("H:i",$bookingDetails[0]['added_date']);?></p>
                        <p class="mb-2"><span class="footer_color">Booking ID :</span>
                            <?php echo $bookingDetails[0]['trip_id'];?></p>
                        <p><span class="footer_color">Transaction ID :</span>
                            <?php echo $bookingDetails[0]['booking_id'];?>
                        </p>
                    </div>
                </div>
                <?php if($bookingDetails[0]['pickup_time']>$time && $bookingDetails[0]['pickup_date']==$date && $bookingDetails[0]['status']!=2){?>
                <div class="d-flex justify-content-end mt-4 pb-4">
                    <input type="hidden" id="trip_id" value="<?php echo $bookingDetails[0]['trip_id'];?>">
                    <!-- <button type="button" id="<?php echo $bookingDetails[0]['trip_id'];?>" class="btn btn-outline-warning btn-lg cancel_trip">CANCEL TRIP</button> -->
                    <a href="JavaScript:void(0);"
                        data-target="<?php echo base_url();?>my_booking/cancel_trips1/<?php echo $bookingDetails[0]['trip_id'];?>"
                        rel="<?php echo $bookingDetails[0]['trip_id'];?>"
                        class="btn btn-outline-warning btn-lg cancel_trip px-4 py-1">Cancel Booking</a>

                </div>
                <?php } else if($bookingDetails[0]['pickup_date']>$date && $bookingDetails[0]['status']!=2){?>
                <div class="d-flex justify-content-end mt-4 pb-4">
                    <input type="hidden" id="trip_id" value="<?php echo $bookingDetails[0]['trip_id'];?>">
                    <!-- <button type="button" id="<?php echo $bookingDetails[0]['trip_id'];?>" class="btn btn-outline-warning btn-lg cancel_trip">CANCEL TRIP</button> -->
                    <a href="JavaScript:void(0);"
                        data-target="<?php echo base_url();?>my_booking/cancel_trips1/<?php echo $bookingDetails[0]['trip_id'];?>"
                        rel="<?php echo $bookingDetails[0]['trip_id'];?>"
                        class="btn btn-outline-warning btn-lg cancel_trip px-4 py-1">Cancel Booking</a>

                </div>
                <!-- <?php } else if($bookingDetails[0]['pickup_date'].' '.$bookingDetails[0]['pickup_time']>=$time1 && $bookingDetails[0]['pickup_date'].' '.$bookingDetails[0]['pickup_time']<= $time2 && $bookingDetails[0]['status']!=2 && $bookingDetails[0]['pickup_time']>$time){?>
                <div class="d-flex justify-content-end mt-4 pb-4">
                    <input type="hidden" id="trip_id" value="<?php echo $bookingDetails[0]['trip_id'];?>">
                   
                    <a href="<?php echo base_url();?>my_booking/cancel_refund_trips/<?php echo $bookingDetails[0]['trip_id'];?>"
                        rel="<?php echo $bookingDetails[0]['trip_id'];?>"
                        class="btn btn-outline-warning btn-lg cancel_trip px-4 py-1">Cancel Booking</a>

                </div> -->
                <?php } ?>
            </div>
        </div>
        <!-- <input type="tel" id="demo" placeholder="" id="telephone"> -->


    </div>
</section>
<?php } else { ?>

<section class="address_and_back_holder">
    <div class="container">
        <?php if($this->session->flashdata('err_message')!='') { ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('err_message'); ?></span>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('sess_message')!='') { ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('sess_message'); ?></span>
        </div>
        <?php } ?>
        <div class="border_area background_light_green py-3 mt-5 ">
            <div class="d-flex justify-content-between blue-head-sec">
                <div class="address position-relative">
                    <div class="d-flex align-items-center">
                        <!-- <?php if($return_bookingDetails[0]['status']==2){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_time']>$time && $return_bookingDetails[0]['pickup_date']==$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_date']<=$date2 && $return_bookingDetails[0]['pickup_date']>=$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_date']>$date){ ?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_date']<$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } ?> -->
                        <?php if($return_bookingDetails[0]['status']==2){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_time']>$time && $return_bookingDetails[0]['pickup_date']==$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_date']<=$date2 && $return_bookingDetails[0]['pickup_date']>$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_time']<$time && $return_bookingDetails[0]['pickup_date']==$date ){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_date']>$date){ ?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[0]['pickup_date']<$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } ?>
                        <h4 class="font_20 font-weight-bold mb-0">
                            <?php echo date("d F Y",strtotime($return_bookingDetails[0]['pickup_date']));?>
                        </h4>

                    </div>

                    <p class="mt-3"><?php echo $return_bookingDetails[0]['airport_name'];?></p>
                </div>
                <div class="tags details_page_tags">
                    <p class="tag_booking text-uppercase">Outbound
                        booking details</p>
                </div>
                <div class="back">
                    <a href="<?php echo base_url();?>my-booking" class="text-decoration-none color_unset">
                        <h4 class="font_20 font-weight-normal d-flex align-items-center"><i
                                class="fas fa-chevron-left mr-2"></i>
                            <p>Back</p>
                        </h4>
                    </a>
                </div>
            </div>
        </div>


    </div>

</section>

<section class="details_part">
    <div class="container">
        <div class="border_area">
            <div class="border_bottom_dashed flight_details_holder py-3">
                <h4 class="primary_text_color">Flight Details</h4>
                <div class="mt-3 d-flex justify-content-between align-items-end">
                    <div>
                        <p><?php echo $return_bookingDetails[0]['airline_name'];?></p>
                        <p><?php echo $return_bookingDetails[0]['originName'];?></p>
                        <p><?php echo $bookingDetails[0]['terminal_orig'];?></p>
                    </div>
                    <div>
                        <p><?php echo $return_bookingDetails[0]['destinationName'];?></p>
                        <p><?php echo $bookingDetails[0]['terminal_dest'];?></p>
                    </div>
                </div>
            </div>

            <div class="border_bottom_dashed trip_details_holder py-3">
                <h4 class="primary_text_color">Trip Details</h4>
                <div class="d-grid trip_details_grid mt-2">
                    <div class="trip_deatils">
                        <small class="footer_color">Pickup Location</small>
                        <p><?php echo $return_bookingDetails[0]['address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Destination Location</small>
                        <p><?php echo $return_bookingDetails[0]['destination_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Pickup Time</small>
                        <p><?php echo $return_bookingDetails[0]['pickup_time'];?></p>
                    </div>
                    <?php if($return_bookingDetails[0]['required_arrival_datetime']!=''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Arrival Time</small>
                        <p><?php echo $return_bookingDetails[0]['required_arrival_datetime'];?></p>
                    </div>
                    <?php } ?>
                </div>

                <div class="d-grid via_details_grid mt-2">
                    <?php if($return_bookingDetails[0]['via1_address']!='' && $return_bookingDetails[0]['via2_address']=='' && $return_bookingDetails[0]['via3_address']==''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $return_bookingDetails[0]['via1_address'];?></p>
                    </div>
                    <?php } else if($return_bookingDetails[0]['via1_address']!='' && $return_bookingDetails[0]['via2_address']!='' && $return_bookingDetails[0]['via3_address']==''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $return_bookingDetails[0]['via1_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 2</small>
                        <p><?php echo $return_bookingDetails[0]['via2_address'];?></p>
                    </div>
                    <?php } else if($return_bookingDetails[0]['via1_address']!='' && $return_bookingDetails[0]['via2_address']!='' && $return_bookingDetails[0]['via3_address']!=''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $return_bookingDetails[0]['via1_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 2</small>
                        <p><?php echo $return_bookingDetails[0]['via2_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 3</small>
                        <p><?php echo $return_bookingDetails[0]['via3_address'];?></p>
                    </div>
                    <?php } ?>

                </div>

                <div class="other_details mt-3">
                    <small class="primary_text_color">Other Details</small>

                    <div class="d-grid other_details_grid mt-2">
                        <div class="trip_deatils">
                            <small class="footer_color">Number of Passengers</small>
                            <p><?php echo $return_bookingDetails[0]['no_passengers'];?></p>
                        </div>
                        <div class="trip_deatils">
                            <small class="footer_color">Vehicle Type</small>
                            <p><?php echo $return_bookingDetails[0]['vehicle_name'];?></p>
                        </div>
                        <div class="trip_deatils">
                            <small class="footer_color">Number of Large Cases</small>
                            <p><?php echo $return_bookingDetails[0]['no_large_cases'];?></p>
                        </div>

                        <div class="trip_deatils">
                            <small class="footer_color">Number of Cabin Cases</small>
                            <p><?php echo $return_bookingDetails[0]['no_cabin_cases'];?></p>
                        </div>
                        <?php if($return_bookingDetails[0]['notes']!=''){?>
                        <div class="trip_deatils">
                            <small class="footer_color">Driver Notes</small>
                            <p><?php echo $return_bookingDetails[0]['notes'];?></p>
                        </div>
                        <?php } ?>


                        <!-- <div class="trip_deatils">
                        <small class="footer_color">Booking Date</small>
                        <p><?php echo $bookingDetails[0]['pickup_date'];?></p>
                    </div> -->


                    </div>
                </div>
            </div>

            <!-- <div class="border_bottom_dashed contact_information_holder py-3">
                <h4 class="primary_text_color">Contact Informations</h4>
                <div class="mt-3">
                    <div class="d-grid contact_info_grid mt-2">
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-user mr-2 primary_text_color"></i>
                            <p class="footer_color mb-0"> <?php echo $return_bookingDetails[0]['customer_name'];?></p>
                        </div>
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-envelope mr-2 primary_text_color"></i>
                            <p class="footer_color mb-0"><?php echo $return_bookingDetails[0]['customer_email'];?></p>
                        </div>
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-phone phone_rotate mr-1 primary_text_color"></i>
                            <p class="footer_color mb-0"><?php echo $return_bookingDetails[0]['customer_telephone'];?>
                            </p>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="payment_details_holder py-3">
                <div class="d-flex justify-content-end">
                    <!-- <div class="">
                        <h4 class="primary_text_color">Payment Details</h4>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-center">
                                    <div class="payment_details">
                                        <small class="footer_color">Price</small>
                                        <p class="mb-0"><span>£</span><?php echo $return_bookingDetails[0]['tip_price'];?></p>
                                    </div>
                                    <?php if(!empty($return_bookingDetails[0]['tips'])){?>
                                    <div class="payment_details mx-3">
                                        <p class="mb-0">+</p>
                                    </div>
                                    <div class="payment_details">
                                        <small class="footer_color">Tip</small>
                                        <p class="mb-0">
                                            <span>£</span><?php echo $return_bookingDetails[0]['tips'];?>
                                        </p>
                                    </div>
                                    <?php } ?>
                                </div>



                            </div>
                            <div class="btn_and_total mt-3">
                                <h3 class="primary_text_color font-weight-bold">
                                    <span>£</span><?php echo $return_bookingDetails[0]['total'];?>
                                </h3>
                            </div>

                        </div>
                    </div> -->

                    <div class="booking_details text-right mt-2">
                        <p class="mb-2"><span class="footer_color">Booking Date:</span>
                            <?php echo date("d F Y",$return_bookingDetails[0]['added_date']);?></p>
                        <p class="mb-2"><span class="footer_color">Booking Time :</span>
                            <?php echo date("H:i",$return_bookingDetails[0]['added_date']);?></p>
                        <p class="mb-2"><span class="footer_color">Booking ID :</span>
                            <?php echo $return_bookingDetails[0]['trip_id'];?></p>
                        <!-- <p><span class="footer_color">Transaction ID :</span>
                            <?php echo $return_bookingDetails[0]['booking_id'];?>
                        </p> -->
                    </div>
                </div>

            </div>
        </div>
        <!-- <input type="tel" id="demo" placeholder="" id="telephone"> -->


    </div>
</section>

<section class="address_and_back_holder">
    <div class="container">
        <?php if($this->session->flashdata('err_message')!='') { ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('err_message'); ?></span>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('sess_message')!='') { ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('sess_message'); ?></span>
        </div>
        <?php } ?>
        <div class="border_area background_light_green py-3 mt-5 ">
            <div class="d-flex justify-content-between">
                <div class="address position-relative">
                    <div class="d-flex align-items-center">
                        <!-- <?php if($return_bookingDetails[1]['status']==2){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_time']>$time && $return_bookingDetails[1]['pickup_date']==$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_date']<=$date2 && $return_bookingDetails[1]['pickup_date']>=$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_date']>$date){ ?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_date']<$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } ?> -->
                        <?php if($return_bookingDetails[1]['status']==2){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_time']>$time && $return_bookingDetails[1]['pickup_date']==$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_date']<=$date2 && $return_bookingDetails[1]['pickup_date']>$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_time']<$time && $return_bookingDetails[1]['pickup_date']==$date ){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_date']>$date){ ?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                        <?php } else if($return_bookingDetails[1]['pickup_date']<$date){?>
                        <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                        <?php } ?>
                        <h4 class="font_20 font-weight-bold mb-0">
                            <?php echo date("d F Y",strtotime($return_bookingDetails[1]['pickup_date']));?>
                        </h4>

                    </div>

                    <p class="mt-3"><?php echo $return_bookingDetails[1]['airport_name'];?></p>
                </div>
                <!-- <div class="tags details_page_tags">
                    <p class="tag_booking">RETURN</p>
                </div> -->
                <div class="tags details_page_tags">
                    <p class="tag_booking text-uppercase">Inbound
                        booking details</p>
                </div>
                <div class="back">
                    <a href="<?php echo base_url();?>my-booking" class="text-decoration-none color_unset">
                        <h4 class="font_20 font-weight-normal d-flex align-items-center"><i
                                class="fas fa-chevron-left mr-2"></i>
                            <p>Back</p>
                        </h4>
                    </a>
                </div>
            </div>
        </div>


    </div>

</section>

<section class="details_part">
    <div class="container">
        <div class="border_area">
            <div class="border_bottom_dashed flight_details_holder py-3">
                <h4 class="primary_text_color">Flight Details</h4>
                <div class="mt-3 d-flex justify-content-between align-items-end">
                    <div>
                        <p><?php echo $return_bookingDetails[1]['airline_name'];?></p>
                        <p><?php echo $return_bookingDetails[1]['originName'];?></p>
                        <p><?php echo $bookingDetails[0]['terminal_orig'];?></p>
                    </div>
                    <div>
                        <p><?php echo $return_bookingDetails[1]['destinationName'];?></p>
                        <p><?php echo $bookingDetails[0]['terminal_dest'];?></p>
                    </div>
                </div>
            </div>

            <div class="border_bottom_dashed trip_details_holder py-3">
                <h4 class="primary_text_color">Trip Details</h4>
                <div class="d-grid trip_details_grid mt-2">
                    <div class="trip_deatils">
                        <small class="footer_color">Pickup Location</small>
                        <p><?php echo $return_bookingDetails[1]['address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Destination Location</small>
                        <p><?php echo $return_bookingDetails[1]['destination_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Pickup Time</small>
                        <p><?php echo $return_bookingDetails[1]['pickup_time'];?></p>
                    </div>
                    <?php if($return_bookingDetails[1]['required_arrival_datetime']!=''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Arrival Time</small>
                        <p><?php echo $return_bookingDetails[1]['required_arrival_datetime'];?></p>
                    </div>
                    <?php } ?>
                </div>

                <div class="d-grid via_details_grid mt-2">
                    <?php if($return_bookingDetails[1]['via1_address']!='' && $return_bookingDetails[1]['via2_address']=='' && $return_bookingDetails[1]['via3_address']==''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $return_bookingDetails[1]['via1_address'];?></p>
                    </div>
                    <?php } else if($return_bookingDetails[1]['via1_address']!='' && $return_bookingDetails[1]['via2_address']!='' && $return_bookingDetails[1]['via3_address']==''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $return_bookingDetails[1]['via1_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 2</small>
                        <p><?php echo $return_bookingDetails[1]['via2_address'];?></p>
                    </div>
                    <?php } else if($return_bookingDetails[1]['via1_address']!='' && $return_bookingDetails[1]['via2_address']!='' && $return_bookingDetails[1]['via3_address']!=''){?>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 1</small>
                        <p><?php echo $return_bookingDetails[1]['via1_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 2</small>
                        <p><?php echo $return_bookingDetails[1]['via2_address'];?></p>
                    </div>
                    <div class="trip_deatils">
                        <small class="footer_color">Via 3</small>
                        <p><?php echo $return_bookingDetails[1]['via3_address'];?></p>
                    </div>
                    <?php } ?>

                </div>

                <div class="other_details mt-3">
                    <small class="primary_text_color">Other Details</small>

                    <div class="d-grid other_details_grid mt-2">
                        <div class="trip_deatils">
                            <small class="footer_color">Number of Passengers</small>
                            <p><?php echo $return_bookingDetails[1]['no_passengers'];?></p>
                        </div>
                        <div class="trip_deatils">
                            <small class="footer_color">Vehicle Type</small>
                            <p><?php echo $return_bookingDetails[1]['vehicle_name'];?></p>
                        </div>
                        <div class="trip_deatils">
                            <small class="footer_color">Number of Large Cases</small>
                            <p><?php echo $return_bookingDetails[1]['no_large_cases'];?></p>
                        </div>

                        <div class="trip_deatils">
                            <small class="footer_color">Number of Cabin Cases</small>
                            <p><?php echo $return_bookingDetails[1]['no_cabin_cases'];?></p>
                        </div>
                        <?php if($return_bookingDetails[1]['notes']!=''){?>
                        <div class="trip_deatils">
                            <small class="footer_color">Driver Notes</small>
                            <p><?php echo $return_bookingDetails[1]['notes'];?></p>
                        </div>
                        <?php } ?>

                        <!-- <div class="trip_deatils">
                        <small class="footer_color">Booking Date</small>
                        <p><?php echo $bookingDetails[0]['pickup_date'];?></p>
                    </div> -->


                    </div>
                </div>
            </div>

            <div class="border_bottom_dashed contact_information_holder py-3">
                <h4 class="primary_text_color">Contact Informations</h4>
                <div class="mt-3">
                    <div class="d-grid contact_info_grid mt-2">
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-user mr-2 primary_text_color"></i>
                            <p class="footer_color mb-0"> <?php echo $return_bookingDetails[1]['customer_name'];?></p>
                        </div>
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-envelope mr-2 primary_text_color"></i>
                            <p class="footer_color mb-0"><?php echo $return_bookingDetails[1]['customer_email'];?></p>
                        </div>
                        <div class="trip_deatils d-flex align-items-center">
                            <i class="fas fa-phone phone_rotate mr-1 primary_text_color"></i>
                            <p class="footer_color mb-0">
                                <?php echo $return_bookingDetails[1]['customer_country_code'],' '.$return_bookingDetails[1]['customer_telephone'];?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="payment_details_holder py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="primary_text_color">Payment Details</h4>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-center">
                                    <div class="payment_details">
                                        <small class="footer_color">Outbound Price</small>
                                        <p class="mb-0">
                                            <span>£</span><?php echo $return_bookingDetails[0]['tip_price'];?></p>
                                    </div>
                                    <?php if(!empty($return_bookingDetails[0]['tips'])){?>
                                    <div class="payment_details mx-3">
                                        <p class="mb-0">+</p>
                                    </div>
                                    <div class="payment_details">
                                        <small class="footer_color">Outbound Tip</small>
                                        <p class="mb-0">
                                            <span>£</span><?php echo $return_bookingDetails[0]['tips'];?>
                                        </p>
                                    </div>
                                    <?php } ?>
                                </div>



                            </div>

                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-center">
                                    <div class="payment_details">
                                        <small class="footer_color">Inbound Price</small>
                                        <p class="mb-0">
                                            <span>£</span><?php echo $return_bookingDetails[1]['tip_price'];?></p>
                                    </div>
                                    <?php if(!empty($return_bookingDetails[1]['tips'])){?>
                                    <div class="payment_details mx-3">
                                        <p class="mb-0">+</p>
                                    </div>
                                    <div class="payment_details">
                                        <small class="footer_color">Inbound Tip</small>
                                        <p class="mb-0">
                                            <span>£</span><?php echo $return_bookingDetails[1]['tips'];?>
                                        </p>
                                    </div>
                                    <?php } ?>
                                </div>



                            </div>
                            <div class="btn_and_total mt-3">
                                <h3 class="primary_text_color font-weight-bold">
                                    <span>£</span><?php echo $return_bookingDetails[0]['total'] + $return_bookingDetails[1]['total'];?>
                                </h3>
                            </div>

                        </div>
                    </div>

                    <div class="booking_details text-right mt-2">
                        <p class="mb-2"><span class="footer_color">Booking Date:</span>
                            <?php echo date("d F Y",$return_bookingDetails[1]['added_date']);?></p>
                        <p class="mb-2"><span class="footer_color">Booking Time :</span>
                            <?php echo date("H:i",$return_bookingDetails[1]['added_date']);?></p>
                        <p class="mb-2"><span class="footer_color">Booking ID :</span>
                            <?php echo $return_bookingDetails[1]['trip_id'];?></p>
                        <p><span class="footer_color">Transaction ID :</span>
                            <?php echo $return_bookingDetails[1]['booking_id'];?>
                        </p>
                    </div>
                </div>
                <?php if($return_bookingDetails[1]['pickup_time']>$time && $return_bookingDetails[1]['pickup_date']==$date && $return_bookingDetails[1]['status']!=2){?>
                <div class="d-flex justify-content-end mt-4 pb-4">
                    <input type="hidden" id="trip_id" value="<?php echo $return_bookingDetails[1]['trip_id'];?>">
                    <!-- <button type="button" id="<?php echo $bookingDetails[0]['trip_id'];?>" class="btn btn-outline-warning btn-lg cancel_trip">CANCEL TRIP</button> -->
                    <a href="JavaScript:void(0);"
                        data-target="<?php echo base_url();?>my_booking/cancel_trips/<?php echo $return_bookingDetails[0]['trip_id'];?>/<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        rel="<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        class="btn btn-outline-warning btn-lg cancel_trip px-4 py-1">Cancel Booking</a>

                </div>
                <?php } else if($return_bookingDetails[1]['pickup_date']>$date && $return_bookingDetails[1]['status']!=2){?>
                <div class="d-flex justify-content-end mt-4 pb-4">
                    <input type="hidden" id="trip_id" value="<?php echo $return_bookingDetails[1]['trip_id'];?>">
                    <!-- <button type="button" id="<?php echo $bookingDetails[0]['trip_id'];?>" class="btn btn-outline-warning btn-lg cancel_trip">CANCEL TRIP</button> -->
                    <a href="JavaScript:void(0);"
                        data-target="<?php echo base_url();?>my_booking/cancel_trips/<?php echo $return_bookingDetails[0]['trip_id'];?>/<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        rel="<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        class="btn btn-outline-warning btn-lg cancel_trip px-4 py-1">Cancel Booking</a>

                </div>
                <!-- <?php } else if($return_bookingDetails[1]['pickup_date'].' '.$return_bookingDetails[1]['pickup_time']>=$time1 && $return_bookingDetails[1]['pickup_date'].' '.$return_bookingDetails[1]['pickup_time']<= $time2 && $return_bookingDetails[1]['status']!=2 && $return_bookingDetails[1]['pickup_time']>$time){?>
                <div class="d-flex justify-content-end mt-4 pb-4">
                    <input type="hidden" id="trip_id" value="<?php echo $return_bookingDetails[1]['trip_id'];?>">
                    <a href="<?php echo base_url();?>my_booking/cancel_refund_trips/<?php echo $return_bookingDetails[0]['trip_id'];?>/<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        rel="<?php echo $return_bookingDetails[1]['trip_id'];?>"
                        class="btn btn-outline-warning btn-lg cancel_trip px-4 py-1">Cancel Booking</a>

                </div> -->
                <?php } ?>
            </div>
        </div>
        <!-- <input type="tel" id="demo" placeholder="" id="telephone"> -->


    </div>
</section>
<?php } ?>

<div class="loader_overlay">
    <div class="loader_holder d-flex justify-content-center align-items-center">
        <div class="text-center">
            <i class="fas fa-spinner mr-2 loader"></i>
            <h4 class="mt-2">Please wait cancelling your booking...</h4>
        </div>
    </div>
</div>


<?php echo $footer;?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
$('document').ready(function() {
    $("[data-confirm]").on('click,submit', function($e) {
        console.log($e);
    })

    $('.cancel_trip').click(function() {
        var target = $(this).attr('data-target');
        var r = confirm("Are you sure you want to cancel your booking?");
        if (r == true) {
            $(this).addClass('disabled_cancel_return');
            $('.loader_overlay').fadeIn(100);
            window.location.href = target;
        }
    })

    $('.cancel_trip1').click(function() {
        var tripId = $('#trip_id').val();
        //alert(tripId);
        var url = '<?php echo base_url();?>my_booking/cancel_refund_trips/' + tripId;
        $.confirm({
            title: 'Confirmation:',
            content: "Are you sure to cancel the trip?",
            confirmButton: 'Yes i agree',
            cancelButton: 'NO never !',
            confirm: function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {},
                    success: function(data) {
                        if (data == 1) {
                            $.alert({
                                title: 'Confirmation:',
                                content: 'Trip has been cancelled successfully.',
                                //content: msg[0],
                                confirmButton: 'Ok',
                                confirm: function() {
                                    window.location.reload();
                                    //window.location.href = BASE_URL + "product/all_product";
                                }
                            });
                        } else {

                        }
                    }
                });
            },
            cancel: function() {
                console.log("NO nnnn");

            }
        });
    });

})
</script>