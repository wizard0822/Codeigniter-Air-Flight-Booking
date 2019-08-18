  <?php echo $header;?>
  <?php echo $top_menu;?>
  <style>
.flag-container {
    display: none;
}
  </style>
  <section class="inward_menu_bottom">
      <div class="container">
          <form class="inward_menu_bottom_block" name="inbound_step4_form" id="inbound_step4_form" method="post"
              action="<?php echo base_url();?>inbound/step4" autocomplete="off">
              <div class="inward_main_block_holder step_four_inward_main_block_holder">
                  <div class="inward_main_block_holder_one">
                      <div class="blue_header_form justify-content-center d-flex align-items-center">
                          <h5 class="font-weight-bold mb-0">INBOUND BOOKING DETAILS</h5>
                      </div>
                      <div class="inward_menu_bottom_inner">
                          <!--  <h5 class="text-center font_18 primary_text_color font-weight-bold mt-2 mb-4">INBOUND
                              BOOKING DETAILS
                          </h5> -->
                          <div class="inward_five_block">
                              <form id="form1" name="form1">
                                  <div class="inward_five_block_inner_one">
                                      <div class="inward_five_block_one">
                                          <p>Customer Name</p>
                                          <div>
                                              <input id="myInput1" type="text"
                                                  value="<?php echo $details[0]['customer_name'];?>" readonly="readonly"
                                                  class="customar_name_holder" name="myInput1" />
                                              <span id="myInput1div" class="error orange_error"></span>
                                          </div>
                                      </div>
                                      <div class="inward_five_block_one">
                                          <p>Email Address</p>
                                          <!-- <h4><?php echo $details[0]['customer_email'];?></h4> -->
                                          <div>
                                              <input id="myInput2" type="email"
                                                  value="<?php echo $details[0]['customer_email'];?>"
                                                  readonly="readonly" class="customar_name_holder" name="myInput2" />
                                              <span id="myInput2div" class="error orange_error"></span>
                                          </div>
                                      </div>
                                      <div class="inward_five_block_one">
                                          <p>Contact No</p>
                                          <div class="d-flex align-items-center position-relative numbers_holder_step4">
                                              <!-- <span class="mr-1">+</span> -->
                                              <input readonly="readonly" id="number_show"
                                                  oninput="this.value=this.value.replace(/[^0-9\+]/g,'')" type="text"
                                                  class="no_outline number_holder_step4"
                                                  style="width: 43px; text-align:center;"
                                                  value="<?php echo $details[0]['customer_country_code'];?>"
                                                  maxlength="5" minlength="2" name="myInput4">
                                              <span id="myInput4div" class="error orange_error"></span>
                                              <input id="myInput3" type="text"
                                                  value="<?php echo $details[0]['customer_telephone'];?>"
                                                  readonly="readonly" class="customar_name_holder pl-1"
                                                  oninput="this.value=this.value.replace(/[^0-9]/g,'')" name="myInput3"
                                                  maxlength="11" minlength="10" />
                                              <span id="myInput3div" class="error orange_error"></span>

                                          </div>
                                      </div>
                                  </div>
                                  <div class="inward_five_block_inner_one_holder" id="myButton">
                                      <div class="inward_five_block_one">
                                          <!-- <img src="<?php echo $base_url;?>assets/frontend/images/edit.png"> -->
                                          <p class="secondary_color font-weight-bold">Edit</p>

                                      </div>
                                  </div>

                                  <div class="inward_step_4_save" id="save">
                                      <div class="inward_five_block_one">
                                          <!-- <img src="<?php echo $base_url;?>assets/frontend/images/save.png"> -->
                                          <p class="secondary_color font-weight-bold cursor_pointer">Done</p>

                                      </div>
                                  </div>
                              </form>
                          </div>
                          <div class="inward_six_block">

                              <div class="inward_six_block_one_inner_one">
                                  <p>Pickup Location</p>
                                  <h4><?php echo $details[0]['address'];?></h4>
                              </div>
                              <div class="inward_six_block_one_inner_one">
                                  <p>Destination Location</p>
                                  <h4><?php echo $details[0]['destination_address'];?></h4>
                              </div>
                              <div class="inward_six_block_one_inner_one">
                                  <p>Pickup Date</p>
                                  <h4><?php if($details[0]['pickup_date']!=''){echo date("d F Y (D)",strtotime($details[0]['pickup_date']));}?>
                                  </h4>
                              </div>
                              <div class="inward_six_block_one_inner_one">
                                  <p>Pickup Time</p>
                                  <h4><?php echo $details[0]['pickup_time'];?></h4>
                              </div>
                              <div class="inward_six_block_one_inner_one">
                                  <p>Number of Passengers</p>
                                  <h4><?php echo $details[0]['no_passengers'];?></h4>
                              </div>



                              <div class="inward_six_block_one_inner_one">
                                  <p>Vehicle Type</p>
                                  <h4><?php echo $vehicle_details[0]['name'];?></h4>
                              </div>



                              <div class="inward_six_block_one_inner_one">
                                  <p>Number of Large Cases</p>
                                  <h4><?php echo $details[0]['no_large_cases'];?></h4>
                              </div>



                              <div class="inward_six_block_one_inner_one">
                                  <p>Number of Cabin Cases</p>
                                  <h4><?php echo $details[0]['no_cabin_cases'];?></h4>
                              </div>
                          </div>

                          <?php if($details[0]['notes']!='')
                          {?>
                          <div class="notes mb-3">
                              <p class="primary_text_color mb-0">Driver Notes</p>
                              <p><?php echo $details[0]['notes'];?> </p>
                          </div>
                          <?php } ?>


                          <div class="d-flex inward_four_progress">
                              <div class="d-flex align-items-center left_part">
                                  <div class="text-right">
                                      <p><?php echo $details[0]['address'];?> </p>
                                      <!-- <p class="d-block"> Airport </p> -->
                                      <i class="fas fa-angle-down my-3"></i>

                                  </div>
                                  <div class="image mx-2">
                                      <img src="<?php echo $base_url;?>assets/frontend/images/location_one.png">
                                  </div>
                                  <!-- <span><img src="<?php echo $base_url;?>assets/frontend/images/location_one.png"></span> -->
                              </div>
                              <div class="center_part">
                                  <?php if(!empty($details[0]['via1_address'])){?><div class="inside_div">
                                      <p><?php echo $details[0]['via1_address'];?></p>
                                      <i class="fas fa-angle-down my-3"></i>

                                  </div><?php } ?>
                                  <?php if(!empty($details[0]['via2_address'])){?><div class="mx-2 inside_div">
                                      <p><?php echo $details[0]['via2_address'];?></p>
                                      <i class="fas fa-angle-down my-3"></i>
                                  </div><?php } ?>
                                  <?php if(!empty($details[0]['via3_address'])){?><div class="inside_div">
                                      <p><?php echo $details[0]['via3_address'];?></p>
                                      <i class="fas fa-angle-down my-3"></i>

                                  </div><?php } ?>
                              </div>
                              <div class="d-flex align-items-center right_part">
                                  <div class="downing_block mx-2"><img
                                          src="<?php echo $base_url;?>assets/frontend/images/location_one.png"></div>
                                  <div class="text-left">
                                      <p><?php echo $details[0]['destination_address'];?>
                                          <!-- <span class="d-block">Street</span> -->
                                      </p>
                                  </div>
                              </div>
                          </div>
                          <!-- <div>
                          <label>Tips</label>
                          <input type="text" name="tips" id="tips" placeholder="Tips" value="">
                          </div> -->
                          <div class="inward_seven_block p-0">
                              <!-- <div class="driver_tip">
                                <input type="text" name="tips" class="form-control" placeholder="Tip For Driver" aria-label="Recipient's username" aria-describedby="basic-addon2" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                              </div> -->
                              <h1>£<?php echo $customer_price;?></h1>
                          </div>
                      </div>
                  </div>
                  <div class="inward_main_block_holder_one">
                      <div class="inward_third_block">
                          <a class="inward_custom_button inward_custom_button_one_one"
                              href="<?php echo base_url();?>inbound/step3"><span>BACK</span></a>
                          <input type="submit"
                              class="inward_custom_button inward_custom_button_three inward_custom_button_two_color"
                              name="submit" value="MAKE PAYMENT">
                          <!-- <button class="inward_custom_button inward_custom_button_two inward_custom_button_two_color" id="next">MAKE
                                PAYMENT -->
                          </button>
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
                  looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                  distribution
                  of letters, as opposed to using 'Content here, content here', making it look like readable English.
                  Many
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
  <script src="<?php echo base_url();?>assets/frontend/js/intlTelInput-jquery.min.js"></script>

  <script>
$(document).ready(function() {
    document.getElementById('myButton').onclick = function() {
        document.getElementById('myInput1').removeAttribute('readonly');
        $('#myInput3').removeAttr('readonly').addClass('pl-5');
        document.getElementById('myInput2').removeAttribute('readonly');
        $('.flag-container').show();
        $('.numbers_holder_step4').addClass('edit_on')
        $('#number_show').removeAttr('readonly').css({
            'position': 'absolute',
            'top': '50%',
            'left': '5px',
            'transform': 'translateY(-50%)',
            'z-index': '9999'
        });
        $('#myInput3').removeAttr('readonly').css({
            'position': 'absolute',
            'top': '50%',
            'transform': 'translateY(-50%)'
        });
        setTimeout(function() {
            $('#myInput1').focus();
            console.log('Focus');
        }, 1000);
        $('#myButton').hide();
        $('#save').show();
    };
    $('#myButton').on('click', function() {
        $('.inward_custom_button_two_color').prop('disabled', true);
        $('.inward_custom_button_two_color').addClass("disabled");
    });

    $('#save').on('click', function() {

        document.getElementById('myInput1').setAttribute('readonly', 'readonly');
        document.getElementById('myInput2').setAttribute('readonly', 'readonly');
        document.getElementById('myInput3').setAttribute('readonly', 'readonly');
        document.getElementById('number_show').setAttribute('readonly', 'readonly');


        $('.inward_custom_button_two_color').prop('disabled', true);
        $('.inward_custom_button_two_color').addClass("disabled");
        var cName = $("#myInput1").val();
        var cEmail = $("#myInput2").val();
        var cPhone = $("#myInput3").val();
        var cCode = $("#number_show").val();
        if (cName == '') {
            document.getElementById('myInput1').removeAttribute('readonly');
            document.getElementById('myInput2').removeAttribute('readonly');
            document.getElementById('myInput3').removeAttribute('readonly');
            document.getElementById('number_show').removeAttribute('readonly');
            setTimeout(function() {
                $('#myInput1').focus();
                console.log('Focus');
            }, 1000);
            $('#myInput1div').html("Please enter name");
        } else if (cEmail == '') {
            document.getElementById('myInput2').removeAttribute('readonly');
            document.getElementById('myInput1').removeAttribute('readonly');
            document.getElementById('myInput3').removeAttribute('readonly');
            document.getElementById('number_show').removeAttribute('readonly');
            setTimeout(function() {
                $('#myInput2').focus();
                console.log('Focus');
            }, 1000);
            $('#myInput2div').html("Please enter email");
        } else if (IsEmail(cEmail) == false) {
            document.getElementById('myInput2').removeAttribute('readonly');
            document.getElementById('myInput1').removeAttribute('readonly');
            document.getElementById('myInput3').removeAttribute('readonly');
            document.getElementById('number_show').removeAttribute('readonly');
            setTimeout(function() {
                $('#myInput2').focus();
                console.log('Focus');
            }, 1000);
            $('#myInput2div').html("Invalid Email address");
            //return false;
        } else if (cPhone == '') {
            document.getElementById('myInput3').removeAttribute('readonly');
            document.getElementById('myInput1').removeAttribute('readonly');
            document.getElementById('myInput2').removeAttribute('readonly');
            document.getElementById('number_show').removeAttribute('readonly');
            setTimeout(function() {
                $('#myInput3').focus();
                console.log('Focus');
            }, 1000);
            $('#myInput3div').html("Please enter phone");
        } else if (cCode == '') {
            document.getElementById('myInput3').removeAttribute('readonly');
            document.getElementById('myInput1').removeAttribute('readonly');
            document.getElementById('myInput2').removeAttribute('readonly');
            document.getElementById('number_show').removeAttribute('readonly');
            setTimeout(function() {
                $('#number_show').focus();
                console.log('Focus');
            }, 1000);
            $('#myInput4div').html("Please enter country code");
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>inbound/save_customer_details",
                data: {
                    cName: cName,
                    cEmail: cEmail,
                    cPhone: cPhone,
                    cCode: cCode,
                },
                success: function(data) {
                    if (data == 1) {
                        $('#myButton').show();
                        $('#save').hide();
                        window.location.reload();
                    } else {

                    }
                }
            });
        }

    })

    function IsEmail(cEmail) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(cEmail)) {
            return false;
        } else {
            return true;
        }
    }
});
  </script>