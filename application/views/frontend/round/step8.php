<?php echo $header;?>
<?php echo $top_menu;?>
<section class="inward_menu_bottom">
    <div class="container">
        <form class="inward_menu_bottom_block" name="round_step8_form" id="round_step8_form" method="post"
            action="<?php echo base_url();?>return/step8" autocomplete="off">
            <div class="inward_main_block_holder">
                <div class="blue_header_form justify-content-center d-flex align-items-center">
                    <h5 class="font-weight-bold mb-0">INBOUND BOOKING DETAILS</h5>
                </div>
                <div class="inward_main_block_holder_one">
                    <div class="inward_menu_bottom_inner">
                        <div class="inward_two_block_holder">
                            <div class="british_airways">
                                <h4><?php echo $this->session->userdata('in_airline_name');?>
                                    <!-- <?php echo $this->session->userdata('flight_number');?> -->
                                </h4>
                                <!-- <h4>Early</h4> -->

                            </div>
                            <div class="british_airways_one mt-2">
                                <img src="<?php echo $base_url;?>assets/frontend/images/flight.png">
                                <img src="<?php echo $base_url;?>assets/frontend/images/ellipse-5.png">
                            </div>
                            <div class="dublin_main_block">
                                <?php if($this->session->userdata('in_originName')!='' || $this->session->userdata('in_destinationName')!='')
                            {?>
                                <div class="dublin_main_block_one">
                                    <div>
                                        <span><?php echo $this->session->userdata('in_originName');?> </span>
                                        <span class="d-block"><?php echo $this->session->userdata('in_terminal_orig');?> </span>
                                        <!-- <span class="dublin_block_destination_text">Departure:04-04-2019 |
                                            05:45pm</span> -->
                                    </div>
                                    <div>
                                        <!-- <span class="dublin_block_destination"><?php echo $this->session->userdata('destinationName');?> </span> -->
                                        <!-- <span class="dublin_block_destination_text">Arrival : 04-04-2019 | 09:0pm</span>-->
                                        <span class="dublin_block_destination-text-one">
                                            <?php echo $this->session->userdata('in_destinationName');?></span>
                                        <span class="d-block">
                                            <?php echo $this->session->userdata('in_terminal_dest');?></span>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="dublin_main_block_two">
                                <div class="dublin_main_block_two_holder1">
                                    <h4>Pickup Airport</h4>
                                    <div class="airport_name">
                                        <div class="airport_name_holder">
                                            <input type="text" name="airport_id" id="airport_id"
                                                placeholder="Enter Airport" value="<?php echo $airport_name;?>"
                                                readonly="readonly">
                                            <!--  <select name="airport_id"
                                                class="js-example-placeholder-single js-states form-control"
                                                id="airport_id" style="width: 300px">
                                                <option value="">Select Airport</option>
                                                <?php foreach ($airport_data as $key => $value) {
                                                                    # code...
                                                                ?>
                                                <option value="<?php echo $value['id'];?>"
                                                    <?php if($value['id']==$this->session->userdata('in_airport_id')){echo "selected";} else { ?><?php if($value['ICAO']==$this->session->userdata('in_airport_select')){echo "selected";}?><?php } ?>>
                                                    <?php echo $value['name'];?>
                                                </option>
                                                <?php } ?>
                                            </select> -->
                                            <input type="hidden" name="airport_address"
                                                value="<?php echo $airport_name;?>">
                                            <input type="hidden" name="airport_lat"
                                                value="<?php echo $airport_latitude;?>">
                                            <input type="hidden" name="airport_long"
                                                value="<?php echo $airport_longitude;?>">
                                        </div>
                                        <div class="airport_name_images">
                                            <img src="<?php echo $base_url;?>assets/frontend/images/flight_angle.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="dublin_main_block_two_holder1">
                                    <h4>Destination Location</h4>
                                    <div class="airport_name">
                                        <div class="airport_name_holder">
                                            <!-- <input type="text" name="airport" placeholder="Enter Destination Location"> -->
                                            <input id="searchMapDestination" class="mapControls" type="text"
                                                placeholder="Enter Destination Location" name="destination"
                                                value="<?php echo $this->session->userdata('in_desAddress');?>">
                                            <label id="zone-error" class="error" for="searchMapDestination"></label>
                                            <input id="desAddress" type="hidden" name="desAddress"
                                                value="<?php echo $this->session->userdata('in_desAddress');?>">
                                            <input id="desLattitude" type="hidden" name="desLattitude"
                                                value="<?php echo $this->session->userdata('in_desLattitude');?>">
                                            <input id="desLognitude" type="hidden" name="desLognitude"
                                                value="<?php echo $this->session->userdata('in_desLognitude');?>">
                                        </div>
                                        <div class="airport_name_images">
                                            <img src="<?php echo $base_url;?>assets/frontend/images/locator.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="dublin_main_block_two_holder1">
                                    <h4>Via Location</h4>
                                    <div class="airport_name">
                                        <div class="airport_name_holder">
                                            <!-- <input type="text" name="airport" placeholder="Enter Via Location"> -->
                                            <input id="searchMapVia" class="mapControls" type="text"
                                                placeholder="Enter Via Location" name="via">
                                            <label id="zone-error1" class="error" for="searchMapVia"></label>
                                        </div>
                                        <div class="airport_name_images">
                                            <img src="<?php echo $base_url;?>assets/frontend/images/ellipse-7.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dublin_main_block_inner">
                                <div id="bubble1" class="bubble">
                                    <div class="dublin_main_block_inner_one">
                                        <!-- <div class="dublin_main_block_inner_one">
                                                <h4>The Business Center</h4> -->
                                        <input type="text" name="viaAddress1" id="viaAddress1"
                                            class="dublin_main_block_input" disabled
                                            value="<?php echo $this->session->userdata('in_viaAddress1');?>">
                                        <input id="viaAddress_1" type="hidden" name="viaAddress_1"
                                            value="<?php echo $this->session->userdata('in_viaAddress1');?>">
                                        <input id="viaLattitude1" type="hidden" name="viaLattitude1"
                                            value="<?php echo $this->session->userdata('in_viaLattitude1');?>">
                                        <input id="viaLognitude1" type="hidden" name="viaLognitude1"
                                            value="<?php echo $this->session->userdata('in_viaLognitude1');?>">
                                        <!-- </div> -->
                                        <div class="dublin_main_block_inner_two via1" style="display: none">
                                            <i class="fas fa-times cross1"></i>
                                        </div>
                                    </div>
                                    <p class="text-center">Via Address 1</p>
                                </div>
                                <div id="bubble2" class="bubble">
                                    <div class="dublin_main_block_inner_one">
                                        <!-- <div class="dublin_main_block_inner_one">
                                                <h4>CF24 Wellfield Road</h4>
                                            </div> -->
                                        <input type="text" name="viaAddress2" id="viaAddress2"
                                            class="dublin_main_block_input" disabled
                                            value="<?php echo $this->session->userdata('in_viaAddress2');?>">
                                        <input id="viaAddress_2" type="hidden" name="viaAddress_2"
                                            value="<?php echo $this->session->userdata('in_viaAddress2');?>">
                                        <input id="viaLattitude2" type="hidden" name="viaLattitude2"
                                            value="<?php echo $this->session->userdata('in_viaLattitude2');?>">
                                        <input id="viaLognitude2" type="hidden" name="viaLognitude2"
                                            value="<?php echo $this->session->userdata('in_viaLognitude2');?>">
                                        <div class="dublin_main_block_inner_two via2" style="display: none">
                                            <i class="fas fa-times cross2"></i>
                                        </div>
                                    </div>
                                    <p class="text-center">Via Address 2</p>
                                </div>
                                <div id="bubble3" class="bubble">
                                    <div class="dublin_main_block_inner_one">
                                        <!-- <div class="dublin_main_block_inner_one">
                                                <h4>14 Tottenham Court</h4>
                                            </div> -->
                                        <input type="text" name="viaAddress3" id="viaAddress3"
                                            class="dublin_main_block_input" disabled
                                            value="<?php echo $this->session->userdata('in_viaAddress3');?>">
                                        <input id="viaAddress_3" type="hidden" name="viaAddress_3"
                                            value="<?php echo $this->session->userdata('in_viaAddress3');?>">
                                        <input id="viaLattitude3" type="hidden" name="viaLattitude3"
                                            value="<?php echo $this->session->userdata('in_viaLattitude3');?>">
                                        <input id="viaLognitude3" type="hidden" name="viaLognitude3"
                                            value="<?php echo $this->session->userdata('in_viaLognitude3');?>">
                                        <div class="dublin_main_block_inner_two via3" style="display: none">
                                            <i class="fas fa-times cross3"></i>
                                        </div>
                                    </div>
                                    <p class="text-center">Via Address 3</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="inward_main_block_holder_one">
                    <div class="inward_third_block">
                        <!-- <button class="inward_custom_button inward_custom_button_one" id="back"><span><i class="fas fa-arrow-left"></i></span><span>BACK</span></button>
                            <button class="inward_custom_button inward_custom_button_two" id="next"><span>NEXT</span><span><i class="fas fa-arrow-right"></i></span></button> -->
                        <!-- <a class="inward_custom_button inward_custom_button_one"
                            href="<?php echo base_url();?>inward"><span><i
                                    class="fas fa-arrow-left"></i></span><span>BACK</span></a> -->
                        <a class="inward_custom_button inward_custom_button_one_one"
                            href="<?php echo base_url();?>return/step7"><span>BACK</span></a>
                        <input type="submit" class="inward_custom_button inward_custom_button_three" name="submit"
                            value="CONTINUE">
                        <!--  <a class="inward_custom_button inward_custom_button_two" href="<?php echo base_url();?>inward/step3"><span>NEXT</span><span><i class="fas fa-arrow-right"></i></span></a> -->
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc&libraries=places&callback=initMap"
    async defer></script>

<script src="https://cdn.jsdelivr.net/gh/TarekRaafat/autoComplete.js@4.0.0/dist/js/autoComplete.min.js"></script>
<script>
function initMap() {
    var options = {
        // types: ['(cities)'],
        componentRestrictions: {
            country: "uk"
        }
    };
    var input = document.getElementById('searchMapDestination');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        //alert(place.formatted_address);
        var latitude=place.geometry.location.lat();
        var longitude=place.geometry.location.lng();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>round/fetch_zone", //this  should be replace by your server side method
            data: {
                latitude: latitude,
                longitude: longitude
            },
            // dataType: 'json',
            success: function(data) {
                // alert(data);
            if (data == 0) {
                // alert(1);
                $('#zone-error').show();
               
                $('#zone-error').html('Sorry, your address is not within our operating area');
                $('#searchMapDestination').val('');
                //$('#pickAddress').val('');
                // $('#pickLognitude').val('');
                // $('#pickLattitude').val('');
                 e.stopPropagation();
                 e.preventDefault();
                return false;
            }
            else
            {
                document.getElementById('desAddress').value = $('#searchMapDestination').val();
                document.getElementById('desLattitude').value = place.geometry.location.lat();
                document.getElementById('desLognitude').value = place.geometry.location.lng();
            }
        }
    });
    });

    var input1 = document.getElementById('searchMapVia');

    var autocomplete1 = new google.maps.places.Autocomplete(input1, options);

    autocomplete1.addListener('place_changed', function() {
        var place = autocomplete1.getPlace();
        //alert(place.formatted_address);
        //document.getElementById('viaAddress').value = place.formatted_address;
        var searchMapVia=$('#searchMapVia').val();
        var latitude=place.geometry.location.lat();
        var longitude=place.geometry.location.lng();
        if ($('#viaAddress1').val() == '') {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inbound/fetch_zone", //this  should be replace by your server side method
            data: {
                latitude: latitude,
                longitude: longitude
            },
            // dataType: 'json',
            success: function(data) {
                // alert(data);
            if (data == 0) {
                // alert(1);
                $('#zone-error1').show();
               
                $('#zone-error1').html('Sorry, your address is not within our operating area');
                $('#searchMapVia').val('');
                $('#bubble1').hide();
                //$('#pickAddress').val('');
                // $('#pickLognitude').val('');
                // $('#pickLattitude').val('');
                 e.stopPropagation();
                 e.preventDefault();
                return false;
            }
            else
            {
                reset_and_display(1, place);
                document.getElementById('viaAddress1').value = searchMapVia;
                document.getElementById('viaAddress_1').value = searchMapVia;
                document.getElementById('viaLattitude1').value = place.geometry.location.lat();
                document.getElementById('viaLognitude1').value = place.geometry.location.lng();
            }
        }
    });
        } else if ($('#viaAddress2').val() == '') {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inbound/fetch_zone", //this  should be replace by your server side method
            data: {
                latitude: latitude,
                longitude: longitude
            },
            // dataType: 'json',
            success: function(data) {
                // alert(data);
            if (data == 0) {
                // alert(1);
                $('#zone-error1').show();
               
                $('#zone-error1').html('Sorry, your address is not within our operating area');
                $('#searchMapVia').val('');
                $('#bubble2').hide();
                //$('#pickAddress').val('');
                // $('#pickLognitude').val('');
                // $('#pickLattitude').val('');
                 e.stopPropagation();
                 e.preventDefault();
                return false;
            }
            else
            {
                reset_and_display(2, place);
                document.getElementById('viaAddress2').value = searchMapVia;
                document.getElementById('viaAddress_2').value = searchMapVia;
                document.getElementById('viaLattitude2').value = place.geometry.location.lat();
                document.getElementById('viaLognitude2').value = place.geometry.location.lng();
             }
        }
    });
        } else if ($('#viaAddress3').val() == '') {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>inbound/fetch_zone", //this  should be replace by your server side method
            data: {
                latitude: latitude,
                longitude: longitude
            },
            // dataType: 'json',
            success: function(data) {
                // alert(data);
            if (data == 0) {
                // alert(1);
                $('#zone-error1').show();
               
                $('#zone-error1').html('Sorry, your address is not within our operating area');
                $('#searchMapVia').val('');
                $('#bubble3').hide();
                //$('#pickAddress').val('');
                // $('#pickLognitude').val('');
                // $('#pickLattitude').val('');
                 e.stopPropagation();
                 e.preventDefault();
                return false;
            }
            else
            {
                reset_and_display(3, place);
                document.getElementById('viaAddress3').value = searchMapVia;
                document.getElementById('viaAddress_3').value = searchMapVia;
                document.getElementById('viaLattitude3').value = place.geometry.location.lat();
                document.getElementById('viaLognitude3').value = place.geometry.location.lng();
            }
        }
    });
        }
        // document.getElementById('viaLattitude').value = place.geometry.location.lat();
        // document.getElementById('viaLognitude').value = place.geometry.location.lng();
    });

    function reset_and_display(param, place) {
        //console.log(place);
        var searchMapVia=$('#searchMapVia').val();
        document.getElementById('viaAddress' + param).value = searchMapVia;
        $('.via' + param).css("display", "flex");
        $('#searchMapVia').val('');
        $('#bubble' + param).show();
        if (param === 3) $('#searchMapVia').prop("disabled", true);

    }

}
$(document).ready(function() {
    $("#airport_id").on("change", function() {
        $("#airport_id-error").css({
            'display': 'none'
        });
    });
    $("#searchMapDestination").keydown(myfunction); // use keydown
    function myfunction(e) {
        if (e.keyCode === 13) {
            e.stopPropagation();
            e.preventDefault();

            return false;
        }
    }
    $("#searchMapVia").keydown(myfunction); // use keydown
    function myfunction(e) {
        if (e.keyCode === 13) {
            e.stopPropagation();
            e.preventDefault();

            return false;
        }
    }
    <?php if($this->session->userdata('in_desAddress')=='') { ?>
    setTimeout(function() {
        $('#searchMapDestination').focus();
        console.log('Focus');
    }, 1000);
    <?php } ?>
    //$("#airport_id").select2();
    <?php if($this->session->userdata('in_viaAddress1')!='' && $this->session->userdata('in_viaAddress2')=='' && $this->session->userdata('in_viaAddress3')=='') {?>
    // alert("ok1");
    $('#bubble1').show();
    $('.via1').show();
    document.getElementById('viaAddress1').value = '<?php echo $this->session->userdata('in_viaAddress1')?>';
    <?php } else if($this->session->userdata('in_viaAddress1')=='' && $this->session->userdata('in_viaAddress2')!='' && $this->session->userdata('in_viaAddress3')!='') {?>
    // alert("ok1");
    $('#bubble2').show();
    $('#bubble3').show();
    $('.via2').show();
    $('.via3').show();
    document.getElementById('viaAddress2').value = '<?php echo $this->session->userdata('in_viaAddress2')?>';
    document.getElementById('viaAddress3').value = '<?php echo $this->session->userdata('in_viaAddress3')?>';
    <?php } else if($this->session->userdata('in_viaAddress1')!='' && $this->session->userdata('in_viaAddress2')!='' && $this->session->userdata('in_viaAddress3')==''){?>
    // alert("ok");
    $('#bubble1').show();
    $('#bubble2').show();
    $('.via1').show();
    $('.via2').show();
    document.getElementById('viaAddress1').value = '<?php echo $this->session->userdata('in_viaAddress1')?>';
    document.getElementById('viaAddress2').value = '<?php echo $this->session->userdata('in_viaAddress2')?>';
    <?php } else if($this->session->userdata('in_viaAddress1')!='' && $this->session->userdata('in_viaAddress2')=='' && $this->session->userdata('in_viaAddress3')!=''){?>
    // alert("ok");
    $('#bubble1').show();
    $('#bubble3').show();
    $('.via1').show();
    $('.via3').show();
    document.getElementById('viaAddress1').value = '<?php echo $this->session->userdata('in_viaAddress1')?>';
    document.getElementById('viaAddress3').value = '<?php echo $this->session->userdata('in_viaAddress3')?>';
    <?php } else if($this->session->userdata('in_viaAddress3')!='' && $this->session->userdata('in_viaAddress1')!='' && $this->session->userdata('in_viaAddress2')!=''){?>
    $('#bubble1').show();
    $('#bubble2').show();
    $('#bubble3').show();
    $('.via1').show();
    $('.via2').show();
    $('.via3').show();
    document.getElementById('viaAddress1').value = '<?php echo $this->session->userdata('in_viaAddress1')?>';
    document.getElementById('viaAddress2').value = '<?php echo $this->session->userdata('in_viaAddress2')?>';
    document.getElementById('viaAddress3').value = '<?php echo $this->session->userdata('in_viaAddress3')?>';
    $('#searchMapVia').prop("disabled", true);
    <?php } else if($this->session->userdata('in_viaAddress3')=='' && $this->session->userdata('in_viaAddress1')!='' && $this->session->userdata('in_viaAddress2')!=''){?>
    $('#bubble1').show();
    $('#bubble2').show();
    $('.via1').show();
    $('.via2').show();
    document.getElementById('viaAddress1').value = '<?php echo $this->session->userdata('in_viaAddress1')?>';
    document.getElementById('viaAddress2').value = '<?php echo $this->session->userdata('in_viaAddress2')?>';
    <?php } else {?>
    $('#bubble1').hide();
    $('#bubble2').hide();
    $('#bubble3').hide();
    $('.via1').show();
    $('.via2').show();
    $('.via3').show();
    <?php } ?>
    $(".js-example-placeholder-single").select2({
        allowClear: true
    });
    $(".cross1").click(function() {
        //alert("ok");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>round/via4_address_destroy",
            data: {

            },
            success: function(data) {
                if (data == 1) {
                    reset_and_display_none(1)
                    document.getElementById('viaAddress1').value = '';
                    document.getElementById('viaAddress_1').value = '';
                    document.getElementById('viaLattitude1').value = '';
                    document.getElementById('viaLognitude1').value = '';
                }
            }
        });
    });
    $(".cross2").click(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>round/via5_address_destroy",
            data: {

            },
            success: function(data) {
                if (data == 1) {
                    reset_and_display_none(2)
                    document.getElementById('viaAddress2').value = '';
                    document.getElementById('viaAddress_2').value = '';
                    document.getElementById('viaLattitude2').value = '';
                    document.getElementById('viaLognitude2').value = '';
                }
            }
        });

    });
    $(".cross3").click(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>round/via6_address_destroy",
            data: {

            },
            success: function(data) {
                if (data == 1) {
                    reset_and_display_none(3)
                    document.getElementById('viaAddress3').value = '';
                    document.getElementById('viaAddress_3').value = '';
                    document.getElementById('viaLattitude3').value = '';
                    document.getElementById('viaLognitude3').value = '';
                }
            }
        });

    });

    function reset_and_display_none(param) {
        document.getElementById('viaAddress' + param).value = "";
        $('#searchMapVia').prop("disabled", false);
        $('#bubble' + param).hide();
    }


    $("#round_step8_form").validate({
        rules: {
            airport_id: {
                required: true,
            },
            destination: {
                required: true,
            },
        },
        messages: {
            airport_id: {
                required: "Please select one airport option"
            },
            destination: {
                required: "Please enter destination location"
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
    $('#searchMapDestination').keyup(function() {// use keydown
        $('.inward_custom_button_three').attr('type', 'submit');
        $('#desAddress').val('');
        $('#desLognitude').val('');
        $('#desLattitude').val('');
    });
    $('.inward_custom_button_three').on('click', function(e) {
        let attr = $('.inward_custom_button_three').attr('type');
        console.log(attr);
        if (attr === 'submit') {
            $('#zone-error').hide();
        } else {
            $('#zone-error').show();
            $('#zone-error').html('Please choose valid address');
            e.stopPropagation();
            e.preventDefault();
            return false;
        }
    });
    //$('#id_vehicletype').on('change', function() {
        $(".inward_custom_button_three").on("click", function(e){
        var value = $('#desAddress').val();
        //alert(value);
        if (value ==='') {
                //alert("ok");
                $('.inward_custom_button_three').attr('type', 'button');
                $('#zone-error').show();
                $('#zone-error').html('Please choose valid address');
                    e.stopPropagation();
                    e.preventDefault();
                    return false;
                //$('#text-info-24').show();
               //  setTimeout(function(){
               //   window.location.href = "<?php echo base_url();?>outbound";
               // }, 3000);
               
            }
            else 
            {
                $('.inward_custom_button_three').attr('type', 'submit');
                $('#zone-error').hide();
            }
    });   
});
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" async defer></script> -->