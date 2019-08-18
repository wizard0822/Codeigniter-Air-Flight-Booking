<?php echo $header;?>
<?php echo $top_menu;?>
<section class="inward_menu_bottom">
    <div class="container">
        <form class="inward_menu_bottom_block" method="post" name="inbound_step1_form" id="inbound_step1_form"
            method="post" action="<?php echo base_url();?>inbound" autocomplete="off">
            <div class="inward_main_block_holder">
                <div class="inward_main_block_holder_one">
                    <div class="blue_header_form justify-content-center d-flex align-items-center">
                        <h5 class="font-weight-bold mb-0">INBOUND BOOKING DETAILS</h5>
                    </div>
                    <div class="inward_menu_bottom_inner">
                        <div class="inward_up_blocks">
                            <div class="inward_one_block">
                                <h4>Flight Number</h4>
                                <div class="flight_number">
                                    <div class="flight_number_tel">
                                        <input type="text" name="flight_number" placeholder="Enter Flight Number"
                                            id="flight_number" class="autocomplete px_both"
                                            value="<?php echo $this->session->userdata('flight_number');?>"
                                            onkeyup="this.value = this.value.toUpperCase();">
                                        <label id="flight_number-error" class="error" for="flight_number"></label>
                                        <input type="hidden" name="airline_name" id="airline_name_input"
                                            value="<?php echo $this->session->userdata('airline_name');?>">
                                        <input type="hidden" name="originName" id="originName_input"
                                            value="<?php echo $this->session->userdata('originName');?>">
                                        <input type="hidden" name="destinationName" id="destinationName_input"
                                            value="<?php echo $this->session->userdata('destinationName');?>">
                                        <input type="hidden" name="airport_select" id="airport_select_input"
                                            value="<?php echo $this->session->userdata('airport_select');?>">
                                        <input type="hidden" name="terminal_orig" id="terminal_orig_input"
                                            value="<?php echo $this->session->userdata('terminal_orig');?>">
                                        <input type="hidden" name="terminal_dest" id="terminal_dest_input"
                                            value="<?php echo $this->session->userdata('terminal_dest');?>">
                                        <input type="hidden" name="departuretime" id="departuretime_input"
                                            value="<?php echo $this->session->userdata('departuretime');?>">
                                        <input type="hidden" name="arrivaltime" id="arrivaltime_input"
                                            value="<?php echo $this->session->userdata('arrivaltime');?>">
                                        <!-- <div class="flight_number_go">
                                            <a href="javascript:void(0);" id="go_btn">Go</a>
                                        </div> -->

                                        <span id="flight_error"
                                            style="color: #ff0000;font-size:13px;margin-left: 18px;"></span>
                                        <div class="status-ajax"></div>
                                    </div>
                                    <div class="flight_number_images">
                                        <img src="<?php echo $base_url;?>assets/frontend/images/airplane-flight.png">
                                    </div>
                                </div>
                            </div>
                        <div class="inward_one_block">
                            <h4>Promo Code</h4>
                            <div class="promo_code">
                                <div class="promo_code_tel">
                                    <input type="text" name="promo_code" placeholder="Enter Promo Code"
                                        id="promo_code" class="autocomplete px_both"
                                        value="<?php echo $this->session->userdata('promo_code');?>"
                                        onkeyup="this.value = this.value.toUpperCase();">
                                        <label id="promo_code-error" class="" for="promo_code"></label>
                                    <span id="promo_code_error"
                                        style="color: #ff0000;font-size:13px;margin-left: 18px;"></span>
                                    <div class="status-ajax"></div>
                                </div>
                                <div class="promo_code_images">
                                    <img src="<?php echo $base_url;?>assets/frontend/images/promo_code_watermark.jpg">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="inward_two_block" id="flight_info_block"
                            <?php if($this->session->userdata('airline_name')==''){?>style="display: none;" <?php } ?>>
                            <div class="british_airways">
                                <?php if($this->session->userdata('airline_name')==''){?>
                                <h6 id="airline_name">British Airways - FR1908</h6>
                                <!-- <h4>Early</h4> -->
                                </h6>
                                <?php } else {?>
                                <h6 id="airline_name"><?php echo $this->session->userdata('airline_name');?></h6>
                                <!-- <h4>Early</h4> -->
                                <?php } ?>
                                </h6>
                            </div>
                            <div class="british_airways_one">
                                <!-- <img src="<?php echo $base_url;?>assets/frontend/images/airplane-flight.png"> -->
                                <img src="<?php echo $base_url;?>assets/frontend/images/flight.png">
                                <img src="<?php echo $base_url;?>assets/frontend/images/ellipse-5.png">
                            </div>
                            <div class="dublin_main_block_holder_holder">
                                <div class="dublin_main_block_ninety">
                                    <?php if($this->session->userdata('originName')==''){?>
                                    <h6 id="originName">Dublin</h6>
                                    <?php } else { ?>
                                    <h6 id="originName"><?php echo $this->session->userdata('originName');?></h6>
                                    <?php } ?>
                                    <?php if($this->session->userdata('terminal_orig')!=''){?>
                                    <h4 id="terminal_orig"><?php echo $this->session->userdata('terminal_orig');?></h4>
                                    <!-- <h4 id="departuretime"><?php echo $this->session->userdata('departuretime');?></h4> -->
                                    <?php } else {?>
                                    <h4 id="terminal_orig"></h4>
                                    <!-- <h4 id="departuretime"></h4> -->
                                    <?php } ?>
                                </div>
                                <div class="dublin_main_block_ninety">
                                    <?php if($this->session->userdata('destinationName')==''){?>
                                    <h6 class="dublin_main_block_right" id="destinationName">GDANSK</h6>
                                    <?php } else { ?>
                                    <h6 class="dublin_main_block_right" id="destinationName">
                                        <?php echo $this->session->userdata('destinationName');?></h6>
                                    <?php } ?>
                                    <?php if($this->session->userdata('terminal_dest')!=''){?>
                                    <h4><?php echo $this->session->userdata('terminal_dest');?>
                                    <!-- <h4><?php echo $this->session->userdata('arrivaltime');?> -->
                                    </h4>
                                    <?php } else {?>
                                    <h4 id="terminal_dest"></h4>
                                    <!-- <h4 id="arrivaltime"></h4> -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="inward_pickup_date_time p-0">
                            <div class="dublin_main_block_two_holder1">
                                <h4>Pickup Date</h4>
                                <div class="airport_name">

                                    <div class="airport_name_holder datepicker_airport_name_holder">
                                        <!-- <input type="text" name="airport" placeholder="Enter Airport"> -->
                                        <input type="text" id="datePicker" name="pickup_date"
                                            placeholder="Enter Pickup Date" readonly="readonly"
                                            value="<?php echo $this->session->userdata('pickup_date');?>" />

                                    </div>
                                    <div class="airport_name_images">
                                        <img src="<?php echo $base_url;?>assets/frontend/images/calendar.png">
                                    </div>
                                    <label class="error-custom" id="error_pickup_date" style="display:none;">Please select another pickup
                                        date no pickup time available for this selected date</label>
                                </div>
                            </div>
                            <div class="dublin_main_block_two_holder1">
                                <h4>Pickup Time</h4>
                                <div class="airport_name">
                                    <div class="airport_name_holder">
                                        <div class="time-picker">
                                            <div class="hour">
                                                <select aria-label="hour" role="listbox" name="pickup_hour"
                                                    id="pickup_hour" class="_1rqd9z8NaN">
                                                    <option value="">Select</option>
                                                    <option value="00"
                                                        <?php if($this->session->userdata('pickup_hour')=="00"){echo "selected";}?>>
                                                        00</option>
                                                    <option value="01"
                                                        <?php if($this->session->userdata('pickup_hour')=="01"){echo "selected";}?>>
                                                        01</option>
                                                    <option value="02"
                                                        <?php if($this->session->userdata('pickup_hour')=="02"){echo "selected";}?>>
                                                        02</option>
                                                    <option value="03"
                                                        <?php if($this->session->userdata('pickup_hour')=="03"){echo "selected";}?>>
                                                        03</option>
                                                    <option value="04"
                                                        <?php if($this->session->userdata('pickup_hour')=="04"){echo "selected";}?>>
                                                        04</option>
                                                    <option value="05"
                                                        <?php if($this->session->userdata('pickup_hour')=="05"){echo "selected";}?>>
                                                        05</option>
                                                    <option value="06"
                                                        <?php if($this->session->userdata('pickup_hour')=="06"){echo "selected";}?>>
                                                        06</option>
                                                    <option value="07"
                                                        <?php if($this->session->userdata('pickup_hour')=="07"){echo "selected";}?>>
                                                        07</option>
                                                    <option value="08"
                                                        <?php if($this->session->userdata('pickup_hour')=="08"){echo "selected";}?>>
                                                        08</option>
                                                    <option value="09"
                                                        <?php if($this->session->userdata('pickup_hour')=="09"){echo "selected";}?>>
                                                        09</option>
                                                    <option value="10"
                                                        <?php if($this->session->userdata('pickup_hour')=="10"){echo "selected";}?>>
                                                        10</option>
                                                    <option value="11"
                                                        <?php if($this->session->userdata('pickup_hour')=="11"){echo "selected";}?>>
                                                        11</option>
                                                    <option value="12"
                                                        <?php if($this->session->userdata('pickup_hour')=="12"){echo "selected";}?>>
                                                        12</option>
                                                    <option value="13"
                                                        <?php if($this->session->userdata('pickup_hour')=="13"){echo "selected";}?>>
                                                        13</option>
                                                    <option value="14"
                                                        <?php if($this->session->userdata('pickup_hour')=="14"){echo "selected";}?>>
                                                        14</option>
                                                    <option value="15"
                                                        <?php if($this->session->userdata('pickup_hour')=="15"){echo "selected";}?>>
                                                        15</option>
                                                    <option value="16"
                                                        <?php if($this->session->userdata('pickup_hour')=="16"){echo "selected";}?>>
                                                        16</option>
                                                    <option value="17"
                                                        <?php if($this->session->userdata('pickup_hour')=="17"){echo "selected";}?>>
                                                        17</option>
                                                    <option value="18"
                                                        <?php if($this->session->userdata('pickup_hour')=="18"){echo "selected";}?>>
                                                        18</option>
                                                    <option value="19"
                                                        <?php if($this->session->userdata('pickup_hour')=="19"){echo "selected";}?>>
                                                        19</option>
                                                    <option value="20"
                                                        <?php if($this->session->userdata('pickup_hour')=="20"){echo "selected";}?>>
                                                        20</option>
                                                    <option value="21"
                                                        <?php if($this->session->userdata('pickup_hour')=="21"){echo "selected";}?>>
                                                        21</option>
                                                    <option value="22"
                                                        <?php if($this->session->userdata('pickup_hour')=="22"){echo "selected";}?>>
                                                        22</option>
                                                    <option value="23"
                                                        <?php if($this->session->userdata('pickup_hour')=="23"){echo "selected";}?>>
                                                        23</option>
                                                </select>
                                                <svg class="arrow-svg" viewBox="0 0 8 5" width="16px" height="10px"
                                                    stroke="currentColor" fill="none" fill-rule="evenodd"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="1 1 3.77984472 4 6.53846154 1"></polyline>
                                                </svg>
                                            </div>
                                            <div class="minutes">
                                                <select aria-label="minutes" role="listbox" name="pickup_minute"
                                                    id="pickup_minute" class="_1rqd9z8NaN">
                                                    <option value="">Select</option>
                                                    <option value="00"
                                                        <?php if($this->session->userdata('pickup_minute')=="00"){echo "selected";}?>>
                                                        00</option>
                                                    <option value="05"
                                                        <?php if($this->session->userdata('pickup_minute')=="05"){echo "selected";}?>>
                                                        05</option>
                                                    <option value="10"
                                                        <?php if($this->session->userdata('pickup_minute')=="10"){echo "selected";}?>>
                                                        10</option>
                                                    <option value="15"
                                                        <?php if($this->session->userdata('pickup_minute')=="15"){echo "selected";}?>>
                                                        15</option>
                                                    <option value="20"
                                                        <?php if($this->session->userdata('pickup_minute')=="20"){echo "selected";}?>>
                                                        20</option>
                                                    <option value="25"
                                                        <?php if($this->session->userdata('pickup_minute')=="25"){echo "selected";}?>>
                                                        25</option>
                                                    <option value="30"
                                                        <?php if($this->session->userdata('pickup_minute')=="30"){echo "selected";}?>>
                                                        30</option>
                                                    <option value="35"
                                                        <?php if($this->session->userdata('pickup_minute')=="35"){echo "selected";}?>>
                                                        35</option>
                                                    <option value="40"
                                                        <?php if($this->session->userdata('pickup_minute')=="40"){echo "selected";}?>>
                                                        40</option>
                                                    <option value="45"
                                                        <?php if($this->session->userdata('pickup_minute')=="45"){echo "selected";}?>>
                                                        45</option>
                                                    <option value="50"
                                                        <?php if($this->session->userdata('pickup_minute')=="50"){echo "selected";}?>>
                                                        50</option>
                                                    <option value="55"
                                                        <?php if($this->session->userdata('pickup_minute')=="55"){echo "selected";}?>>
                                                        55</option>

                                                </select>
                                                <svg class="arrow-svg" viewBox="0 0 8 5" width="16px" height="10px"
                                                    stroke="currentColor" fill="none" fill-rule="evenodd"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="1 1 3.77984472 4 6.53846154 1"></polyline>
                                                </svg>
                                            </div>
                                            <label class="error-custom" id="error_pickup">Please select pickup
                                                time</label>
                                        </div>
                                        <!-- <input type="text" name="pickup_time1" class="time_picker_input"
                                            id="timepicker_value1" placeholder="Enter Pickup Time" sec_id="1"
                                            readonly="readonly"
                                            value="<?php echo $this->session->userdata('pickup_time');?>">
                                        <input type="hidden" value="<?php echo $this->session->userdata('pickup_time');?>" name="pickup_time" id="timepicker_value_hidden1"> -->
                                    </div>
                                    <div class="airport_name_images">
                                        <img
                                            src="<?php echo $base_url;?>assets/frontend/images/clock-circular-outline-1.png">
                                    </div>
                                </div>

                                <div class="time_picker_container_overlay" id="time_picker1">
                                    <span class="overlay_timepicker" id="overlay_timepicker1" sec_id="1"></span>
                                    <div class="time_picker_holder position-relative">
                                        <div class="Time  time_picker">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center flex-column">
                                                    <i class="fas fa-caret-up upHr" id="upHr1" sec_id="1"></i>
                                                    <input type="text " class="mx-2 text-center" style="width:50px;"
                                                        value="01" id="valueHr1" readonly>
                                                    <i class="fas fa-caret-down downHr" id="upHr1" sec_id="1"></i>
                                                </div>

                                                <div class="d-flex align-items-center flex-column mx-2">
                                                    <i class="fas fa-caret-up upMin" id="upMin1" sec_id="1"></i>
                                                    <input type="text " class="mx-2 text-center" style="width:50px;"
                                                        value="00" id="valueMin1" readonly>
                                                    <i class="fas fa-caret-down downMin" id="DownMin1" sec_id="1"></i>
                                                </div>

                                                <div class="am_pm_holder">
                                                    <div class="btn btn-primary btn-sm am_pm" id="am_pm1" sec_id="1">AM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="inward_main_block_holder_one">
                    <div class="inward_third_block">
                        <input type="submit" class="inward_custom_button inward_custom_button_two" name="submit"
                            value="CONTINUE">

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="airport_transport">
    <div class="container">
        <div class="airport_transport_main_block">
            <h3>Airport Transport Specialist</h3>
        </div>
        <div class="airport_transport_main_text">
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and
                a search for 'lorem ipsum' will uncover many web sites still in their infancy.
            </p>
        </div>
    </div>
</section>
<section class="reason_of_book">
    <div class="container">
        <div class="reason_of_book_text_box">
            <div class="reason_of_book_text_box_main_text">
                <h3>Reasons To Book With us</h3>
            </div>
            <div class="reason_of_book_text_box_main_text_box">
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration
                    in some form, by injected humour, or randomised words which don't look even slightly believable.
                    If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                    embarrassing
                    hidden in the middle of text.</p>
            </div>
        </div>
        <div class="reason_of_book_text_box_inner">
            <div class="reason_of_book_text_box_inner_one">
                <div class="reason_of_book_text_box_inner_one_pic">
                    <img src="<?php echo $base_url;?>assets/frontend/images/reason_one.png">
                </div>
                <div class="reason_of_book_text_box_inner_one_text">
                    <p>Lorem ipsum dolor sit amet,consectetur adipiscing aliqua. </p>
                </div>
            </div>
            <div class="reason_of_book_text_box_inner_one">
                <div class="reason_of_book_text_box_inner_one_pic">
                    <img src="<?php echo $base_url;?>assets/frontend/images/reason_two.png">
                </div>
                <div class="reason_of_book_text_box_inner_one_text">
                    <p>Lorem ipsum dolor sit amet,consectetur adipiscing aliqua. </p>
                </div>
            </div>
            <div class="reason_of_book_text_box_inner_one">
                <div class="reason_of_book_text_box_inner_one_pic">
                    <img src="<?php echo $base_url;?>assets/frontend/images/reason_three.png">
                </div>
                <div class="reason_of_book_text_box_inner_one_text">
                    <p>Lorem ipsum dolor sit amet,consectetur adipiscing aliqua. </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer;?>
<style type="text/css">
.status-ajax {
    max-height: 20vh;
    overflow: auto;

}
</style>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#flight_number").on("keyup", function() {
        $("#airline_name_input-error").hide();
        $("#flight_number-error").hide();
    });

    function fetch_time(date,current_time,minute){
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = (month < 10 ? '0' : '') + month + '/' +
        (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inbound/fetch_hour_minute", //this  should be replace by your server side method
            data: {
                selected_date: date,
                current_date:current_date,
                current_hour: current_time,
                current_minute:minute,
            },
            dataType: 'json',
            success: function(data) {
                $('#pickup_hour').html(data.hours);
                $('#pickup_minute').html(data.minute);

                var time1 ='<?php echo $this->session->userdata('pickup_hour')?>';
                var minute1 ='<?php echo $this->session->userdata('pickup_minute')?>';

                if(time1!=''){
                    $('#pickup_hour option[value='+time1+']').prop('selected',true);
                }
                if(minute1!=''){
                    $('#pickup_minute option[value='+minute1+']').prop('selected',true);
                }
                
                
                // console.log(data.hours);
            }
        });
}

function fetch_minute(date,hour,current_time,minute){
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = (month < 10 ? '0' : '') + month + '/' +
        (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inbound/fetch_minute", //this  should be replace by your server side method
            data: {
                selected_date: date,
                selected_hour:hour,
                current_date:current_date,
                current_hour: current_time,
                current_minute:minute,
            },
            dataType: 'json',
            success: function(data) {
                
                $('#pickup_minute').html(data.minute);
                // console.log(data.hours);
            }
        });
}

    ch = true;
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();

    var output = (month < 10 ? '0' : '') + month + '/' +
        (day < 10 ? '0' : '') + day + '/' + d.getFullYear();

    var output1 = $.datepicker.formatDate( "dd M yy (D)", new Date());
    var output2 = $.datepicker.formatDate('mm/dd/yy', new Date());

    //var dateObject = $("#datePicker").datepicker('getDate');
    var date = '<?php echo $this->session->userdata('pickup_date1')?>';
    var dt = new Date($.now());
    var time = dt.getHours();
    var minute = dt.getMinutes();
    var time1 ='<?php echo $this->session->userdata('pickup_hour')?>';
    var minute1 ='<?php echo $this->session->userdata('pickup_minute')?>';

    fetch_time(date,time,minute);

    if(time1!=''){
        $('#pickup_hour option[value='+time1+']').prop('selected',true);
    }
    if(minute1!=''){
        $('#pickup_minute option[value='+minute1+']').prop('selected',true);
    }

    
    $("#datePicker").on("change", function() {
        var dateObject = $("#datePicker").datepicker('getDate');
        var date = $.datepicker.formatDate('mm/dd/yy', dateObject);
        var dt = new Date($.now());
        var time = dt.getHours();
        var minute = dt.getMinutes();
         // time=23;
         // minute=15;
        var pickup_hour = '<?php $this->session->userdata('pickup_hour')?>';
        // alert(date);
        // alert($.datepicker.formatDate('mm/dd/yy', dateToday));
        fetch_time(date,time,minute);
    });
    $('#pickup_hour').on('change', function() {
        var dateObject1 = $("#datePicker").datepicker('getDate');
        var date1 = $.datepicker.formatDate('mm/dd/yy', dateObject1);
        var dt1 = new Date($.now());
        var time1 = dt.getHours() + 4;
        var current_time=dt.getHours();
        var minute = dt.getMinutes();
        // alert(date1);
        var pickup_hour = $("#pickup_hour option:selected").val();
        console.log(output);
        console.log(date1);

        fetch_minute(date1,pickup_hour,current_time,minute);
    });
    
    var validator;
    //    $('input').on('blur', function() {
    //     if ($("#inbound_step1_form").valid()) {
    //         $('.inward_custom_button_two').prop('disabled', false);  
    //     } else {
    //         $('.inward_custom_button_two').prop('disabled', 'disabled');
    //     }
    // });
    $('#flight_number').on('blur', function(e) {

        var flight_number = $('#flight_number').val();
        // alert(flight_number);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inbound/fetch_flight", //this  should be replace by your server side method
            data: {
                flight_number: flight_number
            },
            dataType: 'json',
            success: function(data) {
                common_success(data, flight_number);;
            }
        });
        //$(this).next('#datepicker').focus();
        event.preventDefault();
        return false;

    });
    $("#promo_code").on('blur', function(e) {

    var promo_code = $('#promo_code').val();
    // alert(promo_code);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>outbound/validate_promo_code", //this  should be replace by your server side method
        data: {
            promo_code: promo_code
        },
        dataType: 'json',
        success: function(data) {
            if (data['status'] == 'success') {
                $('#promo_code_error').html('Applied successfully');
                $('#promo_code_error').css("color", "green");
            }else {
                $('#promo_code_error').html('Invalid Promo Code');
                $('#promo_code_error').css("color", "red");
            }
        }
    });
    event.preventDefault();
    return false;

    });
    $('#flight_number').on('keypress', function(e) {

        if (e.which == 13) {
            var flight_number = $('#flight_number').val();
            // alert(flight_number);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>inbound/fetch_flight", //this  should be replace by your server side method
                data: {
                    flight_number: flight_number
                },
                dataType: 'json',
                success: function(data) {
                    common_success(data, flight_number);;

                }
            });
            //$(this).next('#datepicker').focus();
            event.preventDefault();
            return false;
        }
    });
    $('#flight_number').on('keydown', function(e) {
        if (e.which == 8) {
            console.log("Backspace");
            $('#flight_info_block').hide();
        }
        if (e.which == 9) {
            var flight_number = $('#flight_number').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>inbound/fetch_flight", //this  should be replace by your server side method
                data: {
                    flight_number: flight_number
                },
                dataType: 'json',
                success: function(data) {
                    common_success(data, flight_number);
                }
            });
            $(this).next('#datepicker').focus();
            $("#datepicker").focus();
            event.preventDefault();
            return false;
        }
    });

    function common_success(data, flight_number) {

        if (data === 0) {
            $('#flight_number-error').show();
            if (flight_number !== '') {
                $('#flight_number-error').html('Incorrect flight number');
            } else {
                $('#flight_number-error').html('Please enter flight number');
            }
            $('#flight_number').val('');
            $('#flight_info_block').hide();
            $('#airline_name_input').val('');
            $('#terminal_orig_input').val('');
            $('#terminal_dest_input').val('');
            $('#departuretime_input').val('');
            $('#arrivaltime_input').val('');
            $('#originName_input').val('');
            $('#destinationName_input').val('');
            $('#airport_select_input').val('');

        } else if (data === 2) {
            $('#flight_number-error').show();

            $('#flight_number-error').html('Sorry, service for this airport is not available');

            $('#flight_number').val('');
            $('#flight_info_block').hide();
            $('#airline_name_input').val('');
            $('#terminal_orig_input').val('');
            $('#terminal_dest_input').val('');
            $('#departuretime_input').val('');
            $('#arrivaltime_input').val('');
            $('#originName_input').val('');
            $('#destinationName_input').val('');
            $('#airport_select_input').val('');
        }else if (data === 10) {
            $('#flight_number-error').show();
           
            $('#flight_number-error').html('Sorry, service for this location is not available');
            
            $('#flight_number').val('');
            $('#flight_info_block').hide();
            $('#airline_name_input').val('');
            $('#terminal_orig_input').val('');
            $('#terminal_dest_input').val('');
            $('#departuretime_input').val('');
            $('#arrivaltime_input').val('');
            $('#originName_input').val('');
            $('#destinationName_input').val('');
            $('#airport_select_input').val('');

        } else {
            if (data != 1) {
                $('#flight_number-error').hide();
                $('#flight_error').html('');
                $('#flight_info_block').show();
                $("#airline_name_input-error").html('');
                $('#airline_name').html(data.airline_name);
                $('#terminal_orig').html(data.terminal_orig);
                $('#terminal_dest').html(data.terminal_dest);
                $('#departuretime').html(data.departuretime);
                $('#arrivaltime').html(data.arrivaltime);
                $('#originName').html(data.originName);
                $('#destinationName').html(data.destinationName);
                $('#airline_name_input').val(data.airline_name);
                $('#terminal_orig_input').val(data.terminal_orig);
                $('#terminal_dest_input').val(data.terminal_dest);
                $('#departuretime_input').val(data.departuretime);
                $('#arrivaltime_input').val(data.arrivaltime);
                $('#originName_input').val(data.originName);
                $('#destinationName_input').val(data.destinationName);
                $('#airport_select_input').val(data.airport_select);
                // validateForm();
            } else {
                $('#flight_number-error').show();
                $('#flight_number-error').html('This is not an Inbound flight number');
                $('#flight_number').val('');
                $('#flight_info_block').hide();
                $('#airline_name_input').val('');
                $('#terminal_orig_input').val('');
                $('#terminal_dest_input').val('');
                $('#departuretime_input').val('');
                $('#arrivaltime_input').val('');
                $('#originName_input').val('');
                $('#destinationName_input').val('');
                $('#airport_select_input').val('');

            }

        }
    }


    $("#datepicker").keydown(myfunction); // use keydown
    function myfunction(e) {
        if (e.keyCode === 13 || e.keyCode == 9) {
            e.stopPropagation();
            e.preventDefault();
            return false;
        }
    }





    $('.inward_custom_button').on('click', function() {
        $('#flight_error').html('');
    })


    <?php if($this->session->userdata('flight_number')!=''){ ?>
    // $('#flight_info_block').add();
    $('#go_btn').trigger('click');
    <?php } ?>
    <?php if($this->session->userdata('airline_name')!=''){ ?>
    $('#flight_info_block').add();
    <?php } ?>
    setTimeout(function() {
        $('#flight_number').focus();
        console.log('Focus');
    }, 1000);

    validator = $("#inbound_step1_form").validate({
        focusInvalid: false,
        ignore: [],
        rules: {
            flight_number: {
                required: true,
            },
            pickup_date: {
                required: true,
            },
            pickup_hour: {
                required: true,
            },
            pickup_minute: {
                required: true,
            },
            airline_name: {
                required: true,
            }

        },
        messages: {
            flight_number: {
                required: "Please enter flight number"
            },
            pickup_date: {
                required: "Please select pickup date"
            },
            airline_name: {
                required: "Please enter valid flight number"
            }

        },


    });

    let first_time_pickup = true;

    $('#pickup_hour').on('change', function() {
        pickup_hour_validation();
    })

    $('#pickup_minute').on('change', function() {
        pickup_hour_validation();
    })

    $('#inbound_step1_form').submit(function() {
        first_time_pickup = false;
        pickup_hour_validation();
    })

    function pickup_hour_validation() {
        console.log(first_time_pickup);
        if ($('#pickup_hour').val() === '' || $('#pickup_minute').val() === '') {
            if (!first_time_pickup) {
                $('#error_pickup').add();
                $('#error_pickup').show();
            }
        } else {
            first_time_pickup = false;
            $('#error_pickup').hide();
        }
    }
    $('#error_pickup_date').hide();

    function pickup_date_validation() {
        console.log(first_time_pickup);
        if ($('#pickup_hour').val() === '' || $('#pickup_minute').val() === '') {
            //if (!first_time_pickup) {
            $('#error_pickup_date').add();
            $('#error_pickup_date').show();
            //}
        } else {
            //first_time_pickup = false;
            $('#error_pickup_date').hide();
        }
    }

    $("#datePicker").on("change", function() {
        $("#datePicker-error").css({
            'display': 'none'
        });
        first_time_pickup = true;
    });

    // $('#inbound_step1_form').on('keyup change paste', 'input, select, textarea', function() {
    //     validateForm();
    // });

    // function validateForm() {
    //     console.log($('#inbound_step1_form').valid() + ' ' + $('#flight_info_block').css('display'));

    //     if ($('#inbound_step1_form').valid() && $('#flight_info_block').css('display') !== 'none') {
    //         $('.inward_custom_button').removeAttr('disabled');
    //     } else {
    //         $('.inward_custom_button').attr('disabled', true);
    //     }
    // }
    var $statusKey = $('.status-key');
    var $statusAjax = $('.status-ajax');
    var intervalId;

    // Fake ajax request. Just for demo
    // function make_ajax_request(e) {
    //     var flight_number = $('.autocomplete').val();
    //     // alert(flight_number);
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url();?>inward/fetch_flight", //this  should be replace by your server side method
    //         data: {
    //             flight_number: flight_number
    //         }, //this is parameter name , make sure parameter name is sure as of your sever side method
    //         //contentType: "application/json",
    //         dataType: "JSON",
    //         //async: false,
    //         success: function(data) {
    //             //alert(data.length);
    //             var str = '';
    //             for (var i = 0; i < data.length; i++) {
    //                 str = str + `<div class='search_list' id='searchlist${i}'>` + data[i].flight
    //                     .iataNumber + `</div>`;

    //             }
    //             //alert(data);
    //             // console.log(str);
    //             $statusAjax.html(str);
    //         }
    //     });
    // var that = this;
    // $statusAjax.html('That\'s enough waiting. Making now the ajax request');

    // intervalId = setTimeout(function(){
    //    $statusKey.html('Type here. I will detect when you stop typing');
    //    $statusAjax.html('');
    //    $(that).val(''); // empty field
    // },2000);
    //}


    // Display when the ajax request will happen (after user stops typing)
    // Exagerated value of 1.2 seconds for demo purposes, but in a real example would be better from 50ms to 200ms
    //     $('.autocomplete').on('keydown',
    //         _.debounce(make_ajax_request, 1300));
    // });

    // $('.search_list').on('click', function(){
    //     console.log(this);
    // })

    $(document).on("click", ".search_list", function() {
        let id = $(this).attr('id');
        var flight_number = $('#' + id).html();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inward/fetch_flight_details", //this  should be replace by your server side method
            data: {
                flight_number: flight_number
            },
            success: function(data) {
                console.log(data);
            }
        });
    });
});
</script>