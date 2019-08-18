<?php echo $header;?>
<?php echo $top_menu;?>

<section class="inward_menu_bottom">
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
        <form class="inward_menu_bottom_block" method="post" name="round_step13_form" id="round_step13_form"
            method="post" action="<?php echo base_url();?>return/step13" autocomplete="off">
            <div class="inward_main_block_holder">

                <div class="inward_main_block_holder_one">
                    <div class="text-center pt-4 px-25px position-relative">
                        <div class="r_pay_opt payment_options pt-0 justify-content-end d-inline-flex width_200">
                            <img class="w-50"
                                src="http://www.bitpastel.org/skybound-main/assets/frontend/images/payment-img.png">
                        </div>
                        <div>
                            <?php if($this->session->userdata('out_tips')!='' && $this->session->userdata('in_tips')==''){
						$amount = $this->session->userdata('out_customer_price') + $this->session->userdata('out_tips') + $this->session->userdata('in_customer_price');
                        $driver_tips = $this->session->userdata('out_tips');
                        }else if($this->session->userdata('in_tips')!='' && $this->session->userdata('out_tips')==''){
                        $amount = $this->session->userdata('out_customer_price') + $this->session->userdata('in_customer_price') + $this->session->userdata('in_tips');
                        $driver_tips = $this->session->userdata('in_tips');
                        }else if($this->session->userdata('out_tips')!='' && $this->session->userdata('in_tips')!=''){
                        $amount = $this->session->userdata('out_customer_price') + $this->session->userdata('in_customer_price') + $this->session->userdata('in_tips') + $this->session->userdata('out_tips');
                        $driver_tips = $this->session->userdata('in_tips') + $this->session->userdata('out_tips');
						}else{
						$amount = $this->session->userdata('out_customer_price') + $this->session->userdata('in_customer_price');
                        $driver_tips = '';
                        } ?>
                            <h1 class="mb-0 font-weight-1000 primary_text_color font_40">£<?php echo $amount;?></h1>
                            <div class="text-center primary_text_color d-flex justify-content-center">
                                <p>
                                    <span>Outbound Cost</span> (<small> Amount:
                                        £<?php echo $this->session->userdata('out_customer_price');?>
                                    </small> <?php if($this->session->userdata('out_tips') !=''){?> + <small>Driver
                                        Tip: £<?php echo $this->session->userdata('out_tips');?> </small><?php } ?>
                                    </small> )
                                </p>
                                <p class="px-3"> | </p>
                                <p>
                                    <span>Inbound Cost</span> (<small> Amount:
                                        £<?php echo $this->session->userdata('in_customer_price');?>
                                    </small> <?php if($this->session->userdata('in_tips') !=''){?> + <small>Driver
                                        Tip: £<?php echo $this->session->userdata('in_tips');?> </small><?php } ?>
                                    </small> )
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="inward_menu_bottom_inner">
                        <div class="input-group mb-3">
                            <input autofocus type="tel" name="card_number" id="card_number" class="form-control"
                                placeholder="Card Number" aria-label="Card Number" aria-describedby="basic-addon2">

                        </div>
                    </div>
                    <div class="card_down_step">
                        <div class="inward_main_block_holder_one">
                            <div class="inward_menu_bottom_inner">

                                <div class="input-group mb-3">
                                    <input type="tel" id="expiry_date" name="expiry_date" class="form-control"
                                        placeholder="Expire Date(mm/yy)" aria-label="Expiry Date"
                                        aria-describedby="basic-addon2">

                                </div>
                            </div>
                        </div>

                        <div class="inward_main_block_holder_one">
                            <div class="inward_menu_bottom_inner">

                                <div class="input-group mb-3">
                                    <input type="password" id="cvv" name="cvv" class="form-control" placeholder="CVV"
                                        aria-label="CVV" aria-describedby="basic-addon2" maxlength="4" minlength="3"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="inward_main_block_holder_one">
                    <div class="inward_third_block">
                        <!-- <button class="inward_custom_button" id="next"><span>NEXT</span><span><i class="fas fa-arrow-right"></i></span></button> -->
                        <!-- <a class="inward_custom_button" href="<?php echo base_url();?>inward/step2"><span>NEXT</span><span><i class="fas fa-arrow-right"></i></span></a> -->
                        <input type="submit" id="" class="inward_custom_button inward_custom_button_two" name="submit"
                            value="PAY">

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="loader_overlay">
    <div class="loader_holder d-flex justify-content-center align-items-center">
        <div class="text-center">
            <i class="fas fa-spinner mr-2 loader"></i>
            <h4 class="mt-2">Please wait sending your booking...</h4>
        </div>
    </div>
</div>
<?php echo $footer;?>
<script src="http://bseth99.github.io/projects/jquery-ui/jquery.maskedinput-ben.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/jQuery-Simple-Mask/src/jquery.SimpleMask.js"></script>
<script>
$(document).ready(function($) {
    /*setTimeout(function() {
        $('.alert-danger').hide();
    }, 2000);*/
    // $('#expiry_date').inputmask({
    //     format: 'xx/xx',
    // });
    //$('#card_number').mask("9999 9999 9999 9999");
    // $('#card_number').simpleMask({
    //     'mask': ['#### #### #### ####']
    // })
    // $("#expiry_date")
    //     .mask(
    //         '99/99', {
    //             validate: function(fld, cur) {
    //                 // 0 == month; 1 == day; 2 == year
    //                 var mm = parseInt(fld[0]),
    //                     yy = parseInt(fld[1]),
    //                     vl = true;

    //                 if (!(mm >= 1 && mm < 13) && cur == 0) {
    //                     fld[0] = '12';
    //                     vl = false;
    //                 }

    //                 if (!(yy >= 1976 && yy < 2199) && cur == 2 && fld[1].replace('_', '').length == 4) {
    //                     fld[1] = '2012';
    //                     vl = false;
    //                 }

    //                 return vl;
    //             }
    //         });


    $('#card_number').keypress(function($e) {
        $('.alert-danger').hide();
        let value = $e.target.value;
        let length = value.length;
        if ($e.charCode >= 48 && $e.charCode <= 57) {
            length > 18 ? $e.preventDefault() : length === 4 || length === 9 || length === 14 ? $e
                .target
                .value = $e.target.value + ' ' : '';
        } else {
            $e.preventDefault();
        }
    });


    $("#expiry_date").keypress(function($e) {
        let value = $e.target.value;
        let length = value.length;
        if ($e.charCode >= 48 && $e.charCode <= 57) {
            length > 4 ? $e.preventDefault() : length === 2 ? $e.target.value = $e.target.value + '/' :
                '';
        } else {
            $e.preventDefault();
        }
    });


    $("#round_step13_form").validate({
        rules: {
            card_number: {
                required: true,
            },
            expiry_date: {
                required: true,
            },
            cvv: {
                required: true,
            }
        },
        messages: {
            card_number: {
                required: "Please enter card number"
            },
            expiry_date: {
                required: "Please enter expiry date"
            },
            cvv: {
                required: "Please enter cvv number"
            }
        },
        // submitHandler: function(form) {
        //     form.submit();
        // }
    });


    $('#round_step13_form').on('submit', function() {
        if ($('#round_step13_form').valid()) {
            $('.loader_overlay').fadeIn(100);
        }
    });

    $('#round_step13_form').on('submit', function() {
        if ($('#round_step13_form').valid()) {
            $('.loader_overlay').fadeIn(5, function() {
                $(`#submit`).attr('disabled', true);
            });
        }
    });

});
</script>