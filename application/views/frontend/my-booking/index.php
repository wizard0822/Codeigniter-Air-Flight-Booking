<?php echo $header;?>
<?php echo $top_menu;?>

<section class="page-header">
    <div class="container">
        <h1>My Bookings</h1>
    </div>
</section>

<section class="my_booking_menu_bottom">
    <div class="container">
        <div class="my-booking-tabs">

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

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab"
                        aria-controls="upcoming" aria-selected="false">Upcoming</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="past"
                        aria-selected="false">Past</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab"
                        aria-controls="cancelled" aria-selected="false">Cancelled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="all-trip-tab" data-toggle="tab" href="#all-trip" role="tab"
                        aria-controls="all-trip" aria-selected="true">All</a>
                </li>
            </ul>
            <!-- tabs content -->
            <div class="tab-content" id="myTabContent">

                <!-- upcoming-trip tab details start -->
                <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">

                    <?php if(count($bookingDetails1)>0){
                    foreach ($bookingDetails1 as $key1 => $value1) {
                        //$price = $value1['tip_price'] + $value1['tips'];
                # code...?>
                    
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <div class="trip-first-section">
                                <div class="d-flex align-items-center  position-relative">

                                    <?php if(($value1['pickup_time']>$time && $value1['pickup_date']==$date) || ($value1['pickup_date']<=$date2)){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                                    <?php } else if($value1['pickup_date']>$date){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                                    <?php } ?>

                                    <!-- <span class="my_booking_circle listing_pg_circle bg_circle_green"></span> -->
                                    <!-- <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value1['id']);?>"> -->
                                    <h4 class="mb-0 date font_20">
                                     <?php if($value1['book_by_name']!='Return'){
                                         echo date("d F Y",strtotime($value1['pickup_date']));
                                       } else { 
                                        echo date("d F Y",strtotime($value1['pickup_date'])).' / '.date("d F Y",strtotime($value1['inward_pickup_date']));
                                         } ?>
                                    </h4>
                                </div>
                                <div class="tags">
                                    <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value1['id']);?>"
                                        class="trip-tab-details">
                                        <p class="tag_booking text-uppercase"><?php echo $value1['book_by_name'];?></p>
                                    </a>
                                </div>
                                <h4 class="w_100px text-right mb-0 font-weight-bold price primary_text_color font_20">
                                    £<?php echo $value1['total'];?>
                                </h4>
                            </div>
                            <div class="trip-second-section">
                                <div class="footer_color d-block">
                                    <div class="triple_section_block">
                                        <div class="d-flex justify-content-start w-100">
                                         <?php if($value1['book_by_name']!='Return'){?>
                                            <div>
                                                
                                                <?php echo $value1['address'];?>
                                            </div>

                                            <div class="ml-4">
                                                
                                                <?php echo $value1['destination_address'];?>
                                            </div>
                                            <?php } else { ?>
                                                <div>
                                                    <?php echo $value1['address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value1['destination_address'];?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div>
                                            <?php if($value1['book_by_name']!='Return'){?>
                                            <div class="footer_color mt-3"><?php echo $value1['vehicle_name'];?></div>
                                            <?php } else { ?>
                                            <!-- <div class="footer_color">
                                                <?php echo $value1['inward_address'];?> To
                                                <?php echo $value1['inward_des_address'];?></div> -->

                                            <div class="d-flex justify-content-start w-100 mt-3">
                                                <div>
                                                
                                                    <?php echo $value1['inward_address'];?>
                                                </div>

                                                <div class="ml-4">
                                                
                                                    <?php echo $value1['inward_des_address'];?>
                                                </div>
                                            </div>

                                            <?php } ?>
                                        </div>

                                        <div class="all_via">
                                            <?php if($value1['via1_address']!='' && $value1['via2_address']=='' && $value1['via3_address']==''){echo "<p class='mt-3 mb-0'>( 1 Via )</p>";}else if($value1['via1_address']!='' && $value1['via2_address']!='' && $value1['via3_address']==''){echo "<p class='mt-3 mb-0'>( 2 Vias )</p>";}else if($value1['via1_address']!='' && $value1['via2_address']!='' && $value1['via3_address']!=''){echo "<p class='mt-3 mb-0'>( 3 Vias )</p>";}?>
                                        </div>
                                    </div>
                                </div>

                                <?php if($value1['book_by_name']!='Return'){?>
                                <p class="time"><span class="footer_color">Pickup Time :</span>
                                    <?php echo "<span class='black_text'>".$value1['pickup_time']."</span>";?></p>
                                <?php } else { ?>
                                <div>
                                    <p class="time"><span class="footer_color">Outbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value1['inward_pickup_time']."</span>";?></p>
                                    <p class="time mt-3"><span class="footer_color">Inbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value1['pickup_time']."</span>";?>
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="trip-third-section">
                                <div class="d-flex justify-content-start w-50">
                                    <p class="name footer_color"><i class="fas fa-user"></i>
                                        <?php echo $value1['customer_name'];?></p>
                                    <p class="pl-2 ml-2 email footer_color"><i class="fas fa-envelope"></i>
                                        <?php echo $value1['customer_email'];?>
                                    </p>
                                </div>
                                <p class="contact footer_color"><i class="fas fa-phone phone_rotate"></i>
                                    <?php echo $value1['customer_country_code'].' '.$value1['customer_telephone'];?></p>
                            </div>
                            <!-- </a> -->
                            <!-- <div class="trip-fourth-section mt-2">
                                <div class="text-center">
                                    <button class="btn bg_transparent show_more_boxshadow">Show More</button>
                                </div>
                            </div> -->
                            <!-- <div class="trip-fourth-section text-right">
                                <a href="<?php echo base_url();?>my_booking/cancel_trips/<?php echo $value1['trip_id'];?>" type="button" class="btn btn-primary text-right" onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel</a>
                            </div> -->
                            <!--  <?php echo $value1['pickup_date'].''.$value1['pickup_time'];?> -->
                            <!-- <?php if($value1['pickup_date'].''.$value1['pickup_time']>=$cancel_time){?> 
                             <div class="trip-fourth-section text-right">
                                <a href="<?php echo base_url();?>my_booking/cancel_refund_trips/<?php echo $value1['trip_id'];?>" type="button" class="btn btn-primary text-right cancel_refund" onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel & Refund</a>
                            </div> 
                            <?php } else {?> 
                            <div class="trip-fourth-section text-right">
                                <a href="<?php echo base_url();?>my_booking/cancel_trips/<?php echo $value1['trip_id'];?>" rel="<?php echo $value1['trip_id'];?>" type="button" class="btn btn-primary text-right cancel1" onclick="return confirm('Are you sure you want to cancel the trip?');">Cancel</a>
                            </div>
                            <?php } ?> -->
                        </div>
                        <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value1['id']);?>"
                            class="trip-tab-details"><i class="fas fa-chevron-right"></i></a>
                    </div>
                    
                    <?php } } else {?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <p class="font-weight-bold secondary_color mt-3"> You have no upcoming bookings </p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- upcoming-trip end  -->


                <!-- past-trip tab details start -->
                <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                    <?php if(count($bookingDetails2)>0){
            foreach ($bookingDetails2 as $key2 => $value2) {
                //$price = $value2['tip_price'] + $value2['tips'];
                # code...?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <div class="trip-first-section">
                                <div class="d-flex align-items-center  position-relative">
                                    <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                                    <!-- <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value2['id']);?>" > -->
                                    <h4 class="mb-0 date font_20">
                                        <?php if($value2['book_by_name']!='Return'){
                                         echo date("d F Y",strtotime($value2['pickup_date']));
                                       } else { 
                                        echo date("d F Y",strtotime($value2['pickup_date'])).' / '.date("d F Y",strtotime($value2['inward_pickup_date']));
                                         } ?>
                                    </h4>
                                </div>
                                <div class="tags">
                                    <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value2['id']);?>"
                                        class="trip-tab-details">
                                        <p class="tag_booking text-uppercase"><?php echo $value2['book_by_name'];?></p>
                                    </a>
                                </div>
                                <h4 class="w_100px text-right mb-0 font-weight-bold price primary_text_color font_20">
                                    £<?php echo $value2['total'];?>
                                </h4>
                            </div>
                            <div class="trip-second-section">
                                <!-- <p class="address">
                                    <span class="d-block footer_color">
                                        <?php echo $value2['address'];?> To
                                        <?php echo $value2['destination_address'];?>
                                        <?php if($value2['via1_address']!='' && $value2['via2_address']=='' && $value2['via3_address']==''){echo "( 1 Via )";}else if($value2['via1_address']!='' && $value2['via2_address']!='' && $value2['via3_address']==''){echo "( 2 Vias )";}else if($value2['via1_address']!='' && $value2['via2_address']!='' && $value2['via3_address']!=''){echo "( 3 Vias )";}?>
                                    </span>
                                    <?php if($value2['book_by_name']!='Return'){?>
                                    <span class="footer_color"><?php echo $value2['vehicle_name'];?></span>
                                    <?php } else { ?>
                                    <span class="footer_color"><?php echo $value2['inward_address'];?> To
                                        <?php echo $value2['inward_des_address'];?></span>
                                    <?php } ?>
                                </p> -->



                                <div class="footer_color d-block">
                                    <div class="triple_section_block">
                                        <div class="d-flex justify-content-start w-100">
                                        <?php if($value2['book_by_name']!='Return'){?>
                                            <div>
                                                <?php echo $value2['address'];?>
                                            </div>

                                            <div class="ml-4">
                                                <?php echo $value2['destination_address'];?>
                                            </div>
                                        <?php } else {?>
                                                <div>
                                                    <?php echo $value2['address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value2['destination_address'];?>
                                                </div>
                                        <?php } ?>
                                        </div>

                                        <div>
                                            <?php if($value2['book_by_name']!='Return'){?>
                                            <div class="footer_color mt-3"><?php echo $value2['vehicle_name'];?></div>
                                            <?php } else { ?>
                                            <!-- <div class="footer_color"><?php echo $value2['inward_address'];?> To
                                                <?php echo $value2['inward_des_address'];?></div> -->

                                            <div class="d-flex justify-content-start w-100 mt-3">
                                                <div>
                                                    <?php echo $value2['inward_address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value2['inward_des_address'];?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="all_via">
                                            <?php if($value2['via1_address']!='' && $value2['via2_address']=='' && $value2['via3_address']==''){echo "<p class='mt-3 mb-0'>( 1 Via )</p>";}else if($value2['via1_address']!='' && $value2['via2_address']!='' && $value2['via3_address']==''){echo "<p class='mt-3 mb-0'>( 2 Vias )</p>";}else if($value2['via1_address']!='' && $value2['via2_address']!='' && $value2['via3_address']!=''){echo "<p class='mt-3 mb-0'>( 3 Vias )</p>";}?>
                                        </div>
                                    </div>
                                </div>



                                <?php if($value2['book_by_name']!='Return'){?>
                                <p class="time"><span class="footer_color">Pickup Time :</span>
                                    <?php echo "<span class='black_text'>".$value2['pickup_time']."</span>";?></p>
                                <?php } else { ?>
                                <div>
                                    <p class="time"><span class="footer_color">Outbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value2['pickup_time']."</span>";?></p>
                                    <p class="time mt-3"><span class="footer_color">Inbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value2['inward_pickup_time']."</span>";?>
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- <div class="trip-third-section">
                                <p class="name footer_color"><i class="fas fa-user"></i>
                                    <?php echo $value2['customer_name'];?></p>
                                <p class="email footer_color"><i class="fas fa-envelope"></i>
                                    <?php echo $value2['customer_email'];?>
                                </p>
                                <p class="contact footer_color"><i class="fas fa-phone phone_rotate"></i>
                                    <?php echo $value2['customer_country_code'].' '.$value2['customer_telephone'];?></p>
                            </div> -->

                            <div class="trip-third-section">
                                <div class="d-flex justify-content-start w-50">
                                    <p class="name footer_color"><i class="fas fa-user"></i>
                                        <?php echo $value2['customer_name'];?></p>
                                    <p class="pl-2 ml-2 email footer_color"><i class="fas fa-envelope"></i>
                                        <?php echo $value2['customer_email'];?>
                                    </p>
                                </div>
                                <p class="contact footer_color"><i class="fas fa-phone phone_rotate"></i>
                                    <?php echo $value2['customer_country_code'].' '.$value2['customer_telephone'];?></p>
                            </div>

                            <!-- <div class="trip-fourth-section mt-2">
                                <div class="text-center">
                                    <button class="btn bg_transparent show_more_boxshadow">Show More</button>
                                </div>
                            </div> -->
                        </div>
                        <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value2['id']);?>"
                            class="trip-tab-details"><i class="fas fa-chevron-right"></i></a>
                    </div>
                    <!-- </a> -->
                    <?php } } else {?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <p class="font-weight-bold secondary_color mt-3"> You have no past bookings </p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- past-trip end -->

                <!-- cancelled-trip tab details start -->
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">

                    <?php if(count($bookingDetails3)>0){
                 foreach ($bookingDetails3 as $key3 => $value3) {
                    //$price = $value3['tip_price'] + $value3['tips'];
                # code...?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <div class="trip-first-section">
                                <div class="d-flex align-items-center  position-relative">
                                    <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                                     <!-- <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value3['id']);?>" -->
                                    <h4 class="mb-0 date font_20">
                                        <?php if($value3['book_by_name']!='Return'){
                                         echo date("d F Y",strtotime($value3['pickup_date']));
                                       } else { 
                                        echo date("d F Y",strtotime($value3['pickup_date'])).' / '.date("d F Y",strtotime($value3['inward_pickup_date']));
                                         } ?>
                                    </h4>
                                </div>
                                <div class="tags">
                                    <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value3['id']);?>"
                                        class="trip-tab-details">
                                        <p class="tag_booking text-uppercase"><?php echo $value3['book_by_name'];?></p>
                                    </a>
                                </div>
                                <h4 class="w_100px text-right mb-0 font-weight-bold price primary_text_color font_20">
                                    £<?php echo $value3['total'];?>
                                </h4>
                            </div>
                            <div class="trip-second-section">
                                <!-- <p class="address">
                                    <span class="footer_color d-block">
                                        <?php echo $value3['address'];?> To
                                        <?php echo $value3['destination_address'];?>
                                        <?php if($value3['via1_address']!='' && $value3['via2_address']=='' && $value3['via3_address']==''){echo "( 1 Via )";}else if($value3['via1_address']!='' && $value3['via2_address']!='' && $value3['via3_address']==''){echo "( 2 Vias )";}else if($value3['via1_address']!='' && $value3['via2_address']!='' && $value3['via3_address']!=''){echo "( 3 Vias )";}?>
                                    </span>
                                    <?php if($value3['book_by_name']!='Return'){?>
                                    <span class="footer_color"><?php echo $value3['vehicle_name'];?></span>
                                    <?php } else { ?>
                                    <span class="footer_color"><?php echo $value3['inward_address'];?> To
                                        <?php echo $value3['inward_des_address'];?></span>
                                    <?php } ?>
                                </p> -->


                                <div class="footer_color d-block">
                                    <div class="triple_section_block">
                                        <div class="d-flex justify-content-start w-100">
                                            <!-- <div>
                                                <?php echo $value3['address'];?>
                                            </div>

                                            <div class="ml-4">
                                                <?php echo $value3['destination_address'];?>
                                            </div> -->
                                            <?php if($value3['book_by_name']!='Return'){?>
                                            <div>
                                                
                                                <?php echo $value3['address'];?>
                                            </div>

                                            <div class="ml-4">
                                                
                                                <?php echo $value3['destination_address'];?>
                                            </div>
                                            <?php } else { ?>
                                                <div>
                                                    <?php echo $value3['address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value3['destination_address'];?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div>
                                            <?php if($value3['book_by_name']!='Return'){?>
                                            <div class="footer_color mt-3"><?php echo $value3['vehicle_name'];?></div>
                                            <?php } else { ?>
                                            <!-- <div class="footer_color"><?php echo $value3['inward_address'];?> To
                                                <?php echo $value3['inward_des_address'];?></div> -->

                                            <div class="d-flex justify-content-start w-100 mt-3">
                                                <div>
                                                    <?php echo $value3['inward_address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value3['inward_des_address'];?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="all_via">
                                            <?php if($value3['via1_address']!='' && $value3['via2_address']=='' && $value3['via3_address']==''){echo "<p class='mt-3 mb-0'>( 1 Via )</p>";}else if($value3['via1_address']!='' && $value3['via2_address']!='' && $value3['via3_address']==''){echo "<p class='mt-3 mb-0'>( 2 Vias )</p>";}else if($value3['via1_address']!='' && $value3['via2_address']!='' && $value3['via3_address']!=''){echo "<p class='mt-3 mb-0'>( 3 Vias )</p>";}?>
                                        </div>

                                    </div>
                                </div>


                                <?php if($value3['book_by_name']!='Return'){?>
                                <p class="time"><span class="footer_color">Pickup Time :</span>
                                    <?php echo "<span class='black_text'>".$value3['pickup_time']."</span>";?></p>
                                <?php } else { ?>
                                <div>
                                    <p class="time"><span class="footer_color">Outbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value3['inward_pickup_time']."</span>";?></p>
                                    <p class="time mt-3"><span class="footer_color">Inbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value3['pickup_time']."</span>";?>
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- <div class="trip-third-section">
                                <p class="name footer_color"><i class="fas fa-user"></i>
                                    <?php echo $value3['customer_name'];?></p>
                                <p class="email footer_color"><i class="fas fa-envelope"></i>
                                    <?php echo $value3['customer_email'];?>
                                </p>
                                <p class="contact footer_color"><i class="fas fa-phone phone_rotate"></i>
                                    <?php echo $value3['customer_country_code'].' '.$value3['customer_telephone'];?></p>
                            </div> -->

                            <div class="trip-third-section">
                                <div class="d-flex justify-content-start w-50">
                                    <p class="name footer_color"><i class="fas fa-user"></i>
                                        <?php echo $value3['customer_name'];?></p>
                                    <p class="pl-2 ml-2 email footer_color"><i class="fas fa-envelope"></i>
                                        <?php echo $value3['customer_email'];?>
                                    </p>
                                </div>
                                <p class="contact footer_color"><i class="fas fa-phone phone_rotate"></i>
                                    <?php echo $value3['customer_country_code'].' '.$value3['customer_telephone'];?></p>
                            </div>

                            <!-- <div class="trip-fourth-section mt-2">
                                <div class="text-center">
                                    <button class="btn bg_transparent show_more_boxshadow">Show More</button>
                                </div>
                            </div> -->
                        </div>
                        <!-- </a> -->
                        <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value3['id']);?>"
                            class="trip-tab-details"><i class="fas fa-chevron-right"></i></a>
                    </div>
                    <?php } } else {?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <p class="font-weight-bold secondary_color mt-3"> You have no cancelled bookings <p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- canceelled-trip end -->
                <!-- all-trip tab details start -->
                <div class="tab-pane fade" id="all-trip" role="tabpanel" aria-labelledby="all-trip-tab">

                    <?php if(count($bookingDetails)>0){
                foreach ($bookingDetails as $key => $value) {
                    //$price = $value['tip_price'] + $value['tips'];
                # code...?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <div class="trip-first-section">
                                <div class="d-flex align-items-center  position-relative">
                                    <?php if($value['status']==2){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_red"></span>
                                    <?php } else if($value['pickup_time']>$time && $value['pickup_date']==$date){?>

                                    <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                                    <?php } else if($value['pickup_time']<$time && $value['pickup_date']==$date ){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                                    <?php } else if($value['pickup_date']>$date){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_green"></span>
                                    <!-- <?php } else if($value['pickup_date']<=$date2 && $value['pickup_date']>=$date){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_green"></span> -->
                                    <!-- <?php } else if($value['pickup_date']>$date2){ ?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_yellow"></span> -->
                                    <?php } else if($value['pickup_date']<$date){?>
                                    <span class="my_booking_circle listing_pg_circle bg_circle_grey"></span>
                                    <?php } ?>

                                    <!-- <span class="my_booking_circle listing_pg_circle bg_circle_green"></span> -->
                                    <!-- <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value['id']);?>"> -->
                                    <h4 class="mb-0 date font_20">
                                        <?php if($value['book_by_name']!='Return'){
                                         echo date("d F Y",strtotime($value['pickup_date']));
                                       } else { 
                                        echo date("d F Y",strtotime($value['pickup_date'])).' / '.date("d F Y",strtotime($value['inward_pickup_date']));
                                         } ?>
                                    </h4>
                                </div>

                                <div class="tags">
                                    <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value['id']);?>"
                                        class="trip-tab-details">
                                        <p class="tag_booking text-uppercase"><?php echo $value['book_by_name'];?></p>
                                    </a>
                                </div>

                                <h4 class="w_100px text-right mb-0 font-weight-bold price primary_text_color font_20">
                                    £<?php echo $value['total'];?>
                                </h4>
                            </div>
                            <div class="trip-second-section">
                                <!-- <p class="address">
                                    <span class="footer_color d-block">
                                        <?php echo $value['address'];?> To
                                        <?php echo $value['destination_address'];?>
                                        <?php if($value['via1_address']!='' && $value['via2_address']=='' && $value['via3_address']==''){echo "( 1 Via )";}else if($value['via1_address']!='' && $value['via2_address']!='' && $value['via3_address']==''){echo "( 2 Vias )";}else if($value['via1_address']!='' && $value['via2_address']!='' && $value['via3_address']!=''){echo "( 3 Vias )";}?></span>
                                    <?php if($value['book_by_name']!='Return'){?>
                                    <span class="footer_color"><?php echo $value['vehicle_name'];?></span>
                                    <?php } else { ?>
                                    <span class="footer_color"><?php echo $value['inward_address'];?> To
                                        <?php echo $value['inward_des_address'];?></span>
                                    <?php } ?>
                                </p> -->


                                <div class="footer_color d-block">
                                    <div class="triple_section_block">
                                        <div class="d-flex justify-content-start w-100">
                                            <!-- <div>
                                                <?php echo $value['address'];?>
                                            </div>

                                            <div class="ml-4">
                                                <?php echo $value['destination_address'];?>
                                            </div> -->
                                            <?php if($value['book_by_name']!='Return'){?>
                                            <div>
                                                
                                                <?php echo $value['address'];?>
                                            </div>

                                            <div class="ml-4">
                                                
                                                <?php echo $value['destination_address'];?>
                                            </div>
                                            <?php } else { ?>
                                                <div>
                                                    <?php echo $value['address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value['destination_address'];?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div>
                                            <?php if($value['book_by_name']!='Return'){?>
                                            <div class="footer_color mt-3"><?php echo $value['vehicle_name'];?></div>
                                            <?php } else { ?>
                                            <!-- <div class="footer_color"><?php echo $value['inward_address'];?> To
                                                <?php echo $value['inward_des_address'];?></div> -->

                                            <div class="d-flex justify-content-start w-100 mt-3">
                                                <div>
                                                    <?php echo $value['inward_address'];?>
                                                </div>

                                                <div class="ml-4">
                                                    <?php echo $value['inward_des_address'];?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="all_via">
                                            <?php if($value['via1_address']!='' && $value['via2_address']=='' && $value['via3_address']==''){echo "<p class='mt-3 mb-0'>( 1 Via )</p>";}else if($value['via1_address']!='' && $value['via2_address']!='' && $value['via3_address']==''){echo "<p class='mt-3 mb-0'>( 2 Vias )</p>";}else if($value['via1_address']!='' && $value['via2_address']!='' && $value['via3_address']!=''){echo "<p class='mt-3 mb-0'>( 3 Vias )</p>";}?>
                                        </div>

                                    </div>
                                </div>


                                <?php if($value['book_by_name']!='Return'){?>
                                <p class="time"><span class="footer_color">Pickup Time :</span>
                                    <?php echo "<span class='black_text'>".$value['pickup_time']."</span>";?></p>
                                <?php } else { ?>
                                <div>
                                    <p class="time"><span class="footer_color">Outbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value['inward_pickup_time']."</span>";?></p>
                                    <p class="mt-3 time"><span class="footer_color">Inbound Pickup Time :</span>
                                        <?php echo "<span class='black_text'>".$value['pickup_time']."</span>";?>
                                    </p>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- <div class="trip-third-section">
                                <p class="name footer_color"><i class="mr-1 fas fa-user"></i>
                                    <?php echo $value['customer_name'];?></p>
                                <p class="email footer_color"><i class="mr-1 fas fa-envelope"></i>
                                    <?php echo $value['customer_email'];?>
                                </p>
                                <p class="contact footer_color"><i class="mr-1 fas fa-phone phone_rotate"></i>
                                    <?php echo $value['customer_country_code'].' '.$value['customer_telephone'];?></p>


                            </div> -->

                            <div class="trip-third-section">
                                <div class="d-flex justify-content-start w-50">
                                    <p class="name footer_color"><i class="fas fa-user"></i>
                                        <?php echo $value['customer_name'];?></p>
                                    <p class="pl-2 ml-2 email footer_color"><i class="fas fa-envelope"></i>
                                        <?php echo $value['customer_email'];?>
                                    </p>
                                </div>
                                <p class="contact footer_color"><i class="fas fa-phone phone_rotate"></i>
                                    <?php echo $value['customer_country_code'].' '.$value['customer_telephone'];?></p>
                            </div>



                            <!-- <div class="trip-fourth-section mt-2">
                                <div class="text-center">
                                    <button class="btn bg_transparent show_more_boxshadow">Show More</button>
                                </div>
                            </div> -->
                        </div>
                        <!-- </a> -->
                        <a href="<?php echo base_url();?>my-booking/details/<?php echo md5($value['id']);?>"
                            class="trip-tab-details"><i class="fas fa-chevron-right"></i></a>
                    </div>
                    <?php } } else {?>
                    <div class="all-trip-tab">
                        <div class="trip-tab">
                            <p class="font-weight-bold secondary_color mt-3">You have no bookings</p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- all-trip tab end -->
            </div>
            <!--  -->
        </div>
    </div>
</section>

<?php echo $footer;?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
$('document').ready(function() {
    $('.cancel').click(function() {
        $.confirm({
            title: 'Confirmation:',
            content: "Are you sure to cancel the trip?",
            confirmButton: "Yes",
            cancelButton: 'No',
            confirm: function() {
                tripId = $(this).attr('rel');
                alert(tripId);
                var url = '<?php echo base_url();?>my_booking/cancel_trips/' + tripId;

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

            }
        });
    });

})
</script>