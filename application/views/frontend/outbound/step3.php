<?php echo $header;?>
<?php echo $top_menu;?>
<section class="inward_menu_bottom">
    <div class="container">
        <form class="inward_menu_bottom_block" name="outbound_step3_form" id="outbound_step3_form" method="post"
            action="<?php echo base_url();?>outbound/step3" autocomplete="off">
            <div class="inward_menu_bottom_block">
                <div class="inward_main_block_holder">
                    <div class="blue_header_form justify-content-center d-flex align-items-center">
                        <h5 class="font-weight-bold mb-0">OUTBOUND BOOKING DETAILS</h5>
                    </div>
                    <div class="inward_main_block_holder_one">
                        <div class="inward_menu_bottom_inner">
                            <div class="inward_two_block_holder">
                                <div class="british_airways">
                                    <h4><?php echo $this->session->userdata('airline_name');?></h4>
                                    <!-- <h4>Early</h4> -->

                                </div>
                                <div class="british_airways_one mt-2">
                                    <img src="<?php echo $base_url;?>assets/frontend/images/flight.png">
                                    <img src="<?php echo $base_url;?>assets/frontend/images/ellipse-5.png">
                                </div>
                                <div class="dublin_main_block">
                                    <?php if($this->session->userdata('originName')!='' || $this->session->userdata('destinationName')!='')
                            {?>
                                    <div class="dublin_main_block_one">
                                        <div>
                                            <span><?php echo $this->session->userdata('originName');?></span>
                                            <span class="d-block"><?php echo $this->session->userdata('terminal_orig');?> </span>
                                            <!--  <span class="dublin_block_destination_text">Departure : 04-04-2019 |
                                                05:45pm</span> -->
                                        </div>
                                        <div>
                                            <!-- <span class="dublin_block_destination"><?php echo $this->session->userdata('destinationName');?> </span> -->
                                            <!-- <span class="dublin_block_destination_text">Arrival : 04-04-2019 |
                                                09:30pm</span>-->
                                            <span class="dublin_block_destination-text-one">
                                                <?php echo $this->session->userdata('destinationName');?></span>
                                            <span class="d-block">
                                            <?php echo $this->session->userdata('terminal_dest');?></span>
                                        </div>

                                    </div>
                                    <?php } ?>
                                    <div class="dublin_main_block_two">
                                        <div class="dublin_main_block_two_holder1">
                                            <h4>Vehicle Type</h4>
                                            <div class="airport_name">
                                                <div class="airport_name_holder">
                                                    <!-- <input type="text" name="airport" placeholder="Enter Airport"> -->
                                                    <div
                                                        class="custom_select_holder pl-5 select_round border_form_color">
                                                        <label class="select_rounded_label" for="id_vehicletype"><i
                                                                class="fas fa-caret-down"></i></label>
                                                        <select name="id_vehicletype"
                                                            class="border_unset glow_off  form-control"
                                                            id="id_vehicletype">
                                                            <!-- <option value="">Select Vehicle</option> -->
                                                            <option value="">Please Select</option>
                                                            <?php foreach ($vehicle_data as $key => $value) {
                                                                    # code...
                                                                ?>
                                                            <option value="<?php echo $value['id'];?>"
                                                                <?php if($value['id']==$this->session->userdata('id_vehicletype')){echo "selected";}?>>
                                                                <?php echo $value['name'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="airport_name_images">
                                                    <img
                                                        src="<?php echo $base_url;?>assets/frontend/images/frontal-taxi-cab.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dublin_main_block_two_holder1">
                                            <h4>Number of Passangers</h4>
                                            <div class="airport_name">
                                                <div class="airport_name_holder">
                                                    <!-- <input type="text" name="airport" placeholder="Enter Airport"> -->
                                                    <div
                                                        class="custom_select_holder pl-5 select_round border_form_color">
                                                        <label class="select_rounded_label" for="no_passengers"><i
                                                                class="fas fa-caret-down"></i></label>
                                                        <select name="no_passengers"
                                                            class="border_unset glow_off  form-control"
                                                            id="no_passengers">
                                                            <!-- <option value="">Please Select</option> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="airport_name_images">
                                                    <img
                                                        src="<?php echo $base_url;?>assets/frontend/images/man-user.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dublin_main_block_two_holder1">
                                            <h4>Number of Large Cases</h4>
                                            <div class="airport_name">
                                                <div class="airport_name_holder">
                                                    <!-- <input type="text" name="airport" placeholder="Enter Airport"> -->
                                                    <div
                                                        class="custom_select_holder pl-5 select_round border_form_color">
                                                        <label class="select_rounded_label" for="no_large_cases"><i
                                                                class="fas fa-caret-down"></i></label>
                                                        <select name="no_large_cases"
                                                            class="border_unset glow_off  form-control"
                                                            id="no_large_cases">
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="airport_name_images">
                                                    <img
                                                        src="<?php echo $base_url;?>assets/frontend/images/suitcase-with-white-details.png">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="dublin_main_block_two_holder1">
                                            <h4>Number of Cabin Cases</h4>
                                            <div class="airport_name">
                                                <div class="airport_name_holder">
                                                    <!-- <input type="text" name="airport" placeholder="Enter Airport"> -->
                                                    <div
                                                        class="custom_select_holder pl-5 select_round border_form_color">
                                                        <label class="select_rounded_label" for="no_cabin_cases"><i
                                                                class="fas fa-caret-down"></i></label>
                                                        <select name="no_cabin_cases"
                                                            class="border_unset glow_off  form-control"
                                                            id="no_cabin_cases">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="airport_name_images">
                                                    <img
                                                        src="<?php echo $base_url;?>assets/frontend/images/baggage.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dublin_main_block_two_holder1 mt-4">
                                        <h4>Notes to Driver</h4>
                                        <textarea class="select_round" name="notes" id="exampleFormControlTextarea2"
                                            rows="2"
                                            placeholder="Please enter notes..."><?php echo $this->session->userdata('notes');?></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="inward_main_block_holder_one">
                        <div class="inward_third_block">
                            <!-- <a class="inward_custom_button inward_custom_button_one"
                                href="<?php echo base_url();?>inward/step2"><span><i
                                        class="fas fa-arrow-left"></i></span><span>BACK</span></a> -->
                            <label class="error-custom" id="text-info-24">Pickup time must be at at least 24 hours in
                                the future</label>
                            <a class="inward_custom_button inward_custom_button_one_one"
                                href="<?php echo base_url();?>outbound/step2"><span>BACK</span></a>
                            <input  type="submit" class="inward_custom_button inward_custom_button_three check_login"
                                name="submit" value="CONTINUE">
                            <!-- <button class="inward_custom_button inward_custom_button_two" id="next"><span>BOOK</span><span><i
                                        class="fas fa-arrow-right"></i></span></button> -->
                        </div>
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

<script>
$(document).ready(function() {
    //$("#airport_id").select2();

    // $('.select_rounded_label').on('click', function(){
    // let id = $(this).attr('for');
    // console.log();
    // var size = $('#'+ id + ' option').size();
    // if (size != $('#'+ id).prop('size')) {
    //     $("#"+id).prop('size', size);
    // } else {
    //     $("#"+id).prop('size', 1);
    // }
    // });
    var str = "";
    var str1 = "";
    var str2 = "";
    if ($("#id_vehicletype option:selected").val() == '') {
        str += '<option value="">Please Select</option>';
        str1 += '<option value="">Please Select</option>';
        str2 += '<option value="">Please Select</option>';
        $("#no_passengers").html(str);
        $("#no_large_cases").html(str1);
        $("#no_cabin_cases").html(str2);
    } else {
         <?php //if($this->session->userdata('no_passengers')!='' AND $this->session->userdata('no_large_cases')!='' AND $this->session->userdata('no_cabin_cases')!=''){?>
            var id_vehicletype = $("#id_vehicletype option:selected").val();
            //var id_vehicletype = $("#id_vehicletype option:selected").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_passenger", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype
            },
                success: function(data) {
                    $("#no_passengers").html(data);
                }
            });
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_large_case", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype
            },
                success: function(data1) {
                    $("#no_large_cases").html(data1);
                }
            });
            var no_passengers = $("#no_passengers option:selected").val();
            var no_large_cases = $("#no_large_cases option:selected").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_small_case", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype,
                no_passengers: no_passengers,
                no_large_cases: no_large_cases
            },
                success: function(data2) {
                    $("#no_cabin_cases").html(data2);
                }
            });
        <?php //} ?>
        }
    
    $('#id_vehicletype').on('change', function() {
        var str = "";
        var str1 = "";
        var str2 = "";
        if ($("#id_vehicletype option:selected").val() == '') {
            str += '<option value="">Please Select</option>';
            str1 += '<option value="">Please Select</option>';
            str2 += '<option value="">Please Select</option>';
            $("#no_passengers").html(str);
            $("#no_large_cases").html(str1);
            $("#no_cabin_cases").html(str2);
        }
        else
        {
            var id_vehicletype = $("#id_vehicletype option:selected").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_passenger", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype
            },
                success: function(data) {
                    $("#no_passengers").html(data);
                    $("#no_passengers option:selected").prop('selected',false);
                }
            });
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_large_case", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype
            },
                success: function(data1) {
                    $("#no_large_cases").html(data1);
                    $("#no_large_cases option:selected").prop('selected',false);
                }
            });
            str += '<option value="">Please Select</option>';
            $("#no_cabin_cases").html(str);
            // var no_passengers = $("#no_passengers option:selected").val();
            // var no_large_cases = $("#no_large_cases option:selected").val();
            // $.ajax({
            // type: "POST",
            // url: "<?php echo base_url();?>outbound/fetch_small_case", //this  should be replace by your server side method
            // data: {
            //     id_vehicletype: id_vehicletype,
            //     no_passengers: no_passengers,
            //     no_large_cases: no_large_cases
            // },
            //     success: function(data2) {
            //         $("#no_cabin_cases").html(data2);
            //     }
            // });
        }
    });

    $('#no_passengers').on('change', function() {
        var str = "";
        if ($("#id_vehicletype option:selected").val() == '') {
            str += '<option value="">Please Select</option>';
            $("#no_cabin_cases").html(str);
        }
        else
        {
            var id_vehicletype = $("#id_vehicletype option:selected").val();
            var no_passengers = $("#no_passengers option:selected").val();
            var no_large_cases = $("#no_large_cases option:selected").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_small_case", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype,
                no_passengers: no_passengers,
                no_large_cases: no_large_cases
            },
                success: function(data) {
                    $("#no_cabin_cases").html(data);
                    $("#no_cabin_cases option:selected").prop('selected',false);
                }
            });
        }

    });

    $('#no_large_cases').on('change', function() {
        var str = "";
        if ($("#id_vehicletype option:selected").val() == '') {
            str += '<option value="">Please Select</option>';
            $("#no_cabin_cases").html(str);
        }
        else
        {
            var id_vehicletype = $("#id_vehicletype option:selected").val();
            var no_passengers = $("#no_passengers option:selected").val();
            var no_large_cases = $("#no_large_cases option:selected").val();
            $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>outbound/fetch_small_case", //this  should be replace by your server side method
            data: {
                id_vehicletype: id_vehicletype,
                no_passengers: no_passengers,
                no_large_cases: no_large_cases
            },
                success: function(data) {
                    $("#no_cabin_cases").html(data);
                    $("#no_cabin_cases option:selected").prop('selected',false);
                }
            });
        }
    });


 

    $("#outbound_step3_form").validate({
        rules: {
            id_vehicletype: {
                required: true,
            },
            no_passengers: {
                required: true,
            },
            no_large_cases: {
                required: true,
            },
            no_cabin_cases: {
                required: true,
            }
        },
        messages: {
            id_vehicletype: {
                required: "Please select a vehicle type"
            },
            no_passengers: {
                required: "Please select no. of passengers"
            },
            no_large_cases: {
                required: "Please select no. of large cases"
            },
            no_cabin_cases: {
                required: "Please select no. of cabin cases"
            }
        },
        // submitHandler: function(form) {
        //     form.submit();
        // }
    });

    // $('#searchMapVia').change(function(){
    //    var via= $('#viaAddress').val();
    //    alert(via);
    // }); 
    
    // validateForm();
    // $('#outbound_step3_form').on('keyup change paste', 'input, select, textarea', function() {

    //     validateForm();
    // });

    // function validateForm() {
    //     console.log($('#outbound_step3_form').valid() + ' ' + $('#flight_info_block').css('display'));
    //     if ($('#outbound_step3_form').valid()) {
    //         $('#contune_btn').removeAttr('disabled');
    //     } else {
    //         $('#contune_btn').attr('disabled', true);
    //     }
    // }
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var output = (month < 10 ? '0' : '') + month + '/' +
        (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
    var date = '<?php echo $this->session->userdata('pickup_date1')?>';
    //alert(date);
    //alert(output);
    $('.inward_custom_button_three').on('click', function() {
        let attr = $('.inward_custom_button_three').attr('type');
        console.log(attr);
        if (attr === 'submit') {
            $('#text-info-24').hide();
        } else {
            $('#text-info-24').show();
        }
    });
    //$('#id_vehicletype').on('change', function() {
        // $(".inward_custom_button_three").on("click", function(){
        // var value = parseInt($('#id_vehicletype').val());
        // if (value === 2 || value === 3 || value === 6) {
        //     if(output == date)
        //     {
        //         //alert("ok");
        //         $('.inward_custom_button_three').attr('type', 'button');
        //         $('#text-info-24').show();
        //        //  setTimeout(function(){
        //        //   window.location.href = "<?php echo base_url();?>outbound";
        //        // }, 3000);
               
        //     }
        //     else 
        //     {
        //         $('.inward_custom_button_three').attr('type', 'submit');
        //         $('#text-info-24').hide();
        //     }
        // } else {
        //     $('.inward_custom_button_three').attr('type', 'submit');
        //     $('#text-info-24').hide();
        // }
        $('#id_vehicletype').on('change', function() {
        // $(".inward_custom_button_three").on("click", function(){
        var id_vehicletype = parseInt($('#id_vehicletype').val());
        
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>outbound/fetch_notice_period", //this  should be replace by your server side method
                data: {
                    id_vehicletype: id_vehicletype,
                },
                    success: function(data) {
                         if(data!=1)
                         {
                            // alert(data);
                            $('.inward_custom_button_three').attr('type', 'button');
                            $('#text-info-24').show();
                            $("#text-info-24").html(data);
                         }
                         else
                         {
                            // alert("ok");
                            $('.inward_custom_button_three').attr('type', 'submit');
                            $('#text-info-24').hide();
                         }
                        //$("#no_cabin_cases option:selected").prop('selected',false);
                    }
                });
        
    });
});
</script>