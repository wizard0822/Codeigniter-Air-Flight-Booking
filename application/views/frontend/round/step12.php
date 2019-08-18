<?php echo $header;?>
<?php echo $top_menu;?>

<section class="inward_menu_bottom">
    <div class="container">

        <form class="inward_menu_bottom_block" method="post" name="return_step12_form" id="return_step12_form"
            method="post" action="<?php echo base_url();?>return/step12" autocomplete="off">
            <div class="inward_main_block_holder">
                <div class="blue_header_form justify-content-center d-flex align-items-center">
                    <h5 class="font-weight-bold mb-0">INBOUND BOOKING DETAILS</h5>
                </div>
                <div class="inward_main_block_holder_one twelve_main">
                    <div class="inward_menu_bottom_inner twelve_main_holder">
                        <div class="thirteen">
                            <div class="thirteen_one">
                                <h3>Select tip amount</h3>
                            </div>
                            <div class="thirteen_two">
                                <?php if($this->session->userdata('in_tips')!=5){ ?>
                                <div class="thirteen_two_inner color_change tips" id="tip1" sec-id="1" tip="5">
                                    <h6>£ 5</h6>
                                </div>
                                <?php } else {?>
                                <div style="background-color: #1097d6; color: #fff"
                                    class="thirteen_two_inner color_change tips" id="tip1" sec-id="1" tip="5">
                                    <h6>£ 5</h6>
                                </div>
                                <?php } ?>
                                <?php if($this->session->userdata('in_tips')!=10){ ?>
                                <div class="thirteen_two_inner color_change tips" id="tip2" sec-id="2" tip="10">
                                    <h6>£ 10</h6>
                                </div>
                                <?php } else {?>
                                <div style="background-color: #1097d6; color: #fff"
                                    class="thirteen_two_inner color_change tips" id="tip2" sec-id="2" tip="10">
                                    <h6>£ 10</h6>
                                </div>
                                <?php } ?>
                                <?php if($this->session->userdata('in_tips')==15){ ?>
                                <div style="background-color: #1097d6; color: #fff"
                                    class="thirteen_two_inner color_change tips" id="tip3" sec-id="3" tip="15">
                                    <h6>£ 15</h6>
                                </div>
                                <?php } else {?>
                                <div class="thirteen_two_inner color_change tips" id="tip3" sec-id="3" tip="15">
                                    <h6>£ 15</h6>
                                </div>
                                <?php } ?>
                                <?php if($this->session->userdata('in_tips')==20){ ?>
                                <div style="background-color: #1097d6; color: #fff"
                                    class="thirteen_two_inner color_change tips" id="tip4" sec-id="4" tip="20">
                                    <h6>£ 20</h6>
                                </div>
                                <?php } else {?>
                                <div class="thirteen_two_inner color_change tips" id="tip4" sec-id="4" tip="20">
                                    <h6>£ 20</h6>
                                </div>
                                <?php } ?>
                                <?php if($this->session->userdata('in_tips')==20 || $this->session->userdata('in_tips')==15 || $this->session->userdata('in_tips')==10 || $this->session->userdata('in_tips')==5){ ?>
                                <div class="thirteen_two_inner color_change tips" id="tip5" sec-id="5" tip="other">
                                    <h6>Other</h6>
                                </div>
                                <?php } else { ?>
                                <div style="background-color: #1097d6; color: #fff"
                                    class="thirteen_two_inner color_change tips" id="tip5" sec-id="5" tip="other">
                                    <h6>Other</h6>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="input_with_icon_holder mt-4 w-50" style="display:none;" id="tip_value">
                                <div class="input_part position-relative">
                                    <div class="icon_part d-flex justify-content-center align-items-center">
                                        <i class="fas fa-pound-sign"></i>
                                    </div>
                                    <?php if($this->session->userdata('in_tips')=='') {?>
                                    <input id="tip_id" name="tips" placeholder="Enter Amount"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="text" value="5"
                                        class="form-control">
                                    <?php } else { ?>
                                    <input id="tip_id" name="tips" placeholder="Enter Amount"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="text"
                                        value="<?php echo $this->session->userdata('in_tips');?>" class="form-control">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inward_main_block_holder_one">
                    <div class="inward_third_block">
                        <!-- <button class="inward_custom_button inward_custom_button_one inward_custom_button_one_border return_custom_button_one_color" id="back"><span>NO</span></button>
                            <button class="inward_custom_button inward_custom_button_two return_custom_button_two_color" id="next"><span>
                                    YES</span>

                            </button> -->
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

<script>
$(function() {
    <?php if($this->session->userdata('in_tips')=='') {?>
    $('.tips').animate({
        'background-color': '#fff',
        'color': '#000'
    }, 100, function() {
        $('#tip1').animate({
            'background-color': '#1097d6',
            'color': '#fff'
        }, 100);
    })
    <?php } ?>
    <?php if($this->session->userdata('in_tips')=='5' || $this->session->userdata('in_tips')=='10' || $this->session->userdata('in_tips')=='15' || $this->session->userdata('in_tips')=='20' || $this->session->userdata('in_tips')==''){?>
    $('#tip_value').css('display', 'none');
    <?php } else {?>
    $('#tip_value').css('display', 'block');
    <?php } ?>
    $('.tips').on('click', function() {
        let tip = $(this).attr('tip');
        console.log(tip);
        let sec_Id = $(this).attr('sec-id');
        tip === 'other' ? other_tip() : non_other_tip(tip);
        $('.tips').animate({
            'background-color': '#fff',
            'color': '#000'
        }, 100, function() {
            $('#tip' + sec_Id).animate({
                'background-color': '#1097d6',
                'color': '#fff'
            }, 100);
        })

    })

    function other_tip() {
        console.log('tip');
        $('#tip_value').fadeIn();
        $('#tip_id').val('')
    }

    function non_other_tip(tip) {
        console.log(tip);
        $('#tip_value').hide();
        $('#tip_id').val(tip)
    }
})
</script>