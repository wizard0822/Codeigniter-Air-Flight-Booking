<?php echo $header;?>
<?php echo $top_menu;?>
<!-- <section class="signin_form">
    <div class="signin_form_main_block">
        <div class="signin_form_main_block_inner">
            <div class="siginin_logo">
                <img src="<?php echo $base_url;?>assets/frontend/images/logo.png">
            </div>
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
            <form autocomplete="off" action="<?php echo $base_url;?>profile" name="profile_form" id="profile_form"
                method="post" enctype="multipart/form-data">
                <div class="name_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="fname" id="fname" placeholder="First Name"
                            value="<?php echo $details['firstname'];?>">
                    </div>
                    <div class="position-relative">
                        <input type="text" name="lname" id="lname" placeholder="Last Name" class="second_name"
                            value="<?php echo $details['lastname'];?>">
                    </div>
                </div>
                <div class="email_holder mb-4">
                    <div class="position-relative">
                        <input type="email" name="email" id="email" placeholder="Email Address" class="email"
                            value="<?php echo $details['email_address'];?>">
                        <label
                            style="color: #c10000;font-size: 0.9em;line-height: 18px;padding: 5px 0 0; display: none;"
                            id="invalid_email" for="emailid">Email-id is invalid</label>

                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="phone" id="phone" placeholder="Telephone"
                            value="<?php echo $details['telephone'];?>">
                    </div>
                </div>
                <!-- <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="address1" id="address1" placeholder="Address1" value="<?php echo $details['address1'];?>">
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="address2" id="address2" placeholder="Address2" value="<?php echo $details['address2'];?>">
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="address3" id="address3" placeholder="Address3" value="<?php echo $details['address3'];?>">
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="address4" id="address4" placeholder="Address4" value="<?php echo $details['address4'];?>">
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="address5" id="address5" placeholder="Address5" value="<?php echo $details['address5'];?>">
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="postcode" id="postcode" placeholder="Postcode" value="<?php echo $details['postcode'];?>">
                    </div>
                </div> 
                <div class="signin_buttom signup_button">
                    <input type="submit" name="submit" id="profile_btn" value="Submit" class="signin_custom_button">
                </div>
            </form>
        </div>
    </div>
</section> -->


<section class="tab_holder_profile">
    <div class="container ">
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
        <div class="br-6  tabs_container">
            <div class="tabs d-flex">
                <div class="btn tab active_tab w-50 p-3 d-flex justify-content-center" id="tab1" sec_id="1">
                    <h4>My Account</h4>
                </div>
                <div class="btn tab non_active_tab w-50 p-3 d-flex justify-content-center" id="tab2" sec_id="2">
                    <h4>Change Password</h4>
                </div>
            </div>

            <div class="tab_content_holder">
                <div class="tab_content" id="tab_content1">
                    <form autocomplete="off" action="<?php echo $base_url;?>profile" name="profile_form"
                        id="profile_form" method="post" enctype="multipart/form-data">
                        <input id="tab1" name="tab1" value="tab1" type="hidden">
                        <div class="d-grid profile_tab_inputs p-3">
                            <div>
                                <label class="primary_text_color" for="fname">
                                    <h4>First Name</h4>
                                </label>
                                <div class="input_with_icon_holder ">
                                    <div class="input_part position-relative">
                                        <div class="icon_part d-flex justify-content-center align-items-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <input id="fname" name="fname" placeholder="Enter First Name" type="text"
                                            class="form-control" value="<?php echo $details['firstname'];?>">
                                    </div>
                                </div>
                            </div>


                            <div>
                                <label class="primary_text_color" for="lname">
                                    <h4>Last Name</h4>
                                </label>
                                <div class="input_with_icon_holder">
                                    <div class="input_part position-relative">
                                        <div class="icon_part d-flex justify-content-center align-items-center">
                                            <i class="fas fa-user"></i>
                                        </div>

                                        <input id="lname" placeholder="Enter Last Name" type="text" class="form-control"
                                            name="lname" value="<?php echo $details['lastname'];?>">
                                    </div>
                                </div>
                            </div>


                            <div>
                                <label class="primary_text_color" for="email">
                                    <h4> Email Address </h4>
                                </label>
                                <div class="input_with_icon_holder">
                                    <div class="input_part position-relative">
                                        <div class="icon_part d-flex justify-content-center align-items-center">
                                            <i class="fas fa-envelope"></i>
                                        </div>

                                        <input id="email" name="email" placeholder="Enter Email Address" type="text"
                                            class="form-control" value="<?php echo $details['email_address'];?>">
                                    </div>
                                </div>
                            </div>


                            <div>
                                <label class="primary_text_color" for="phone">
                                    <h4>Telephone</h4>
                                </label>
                                <div class="input_with_icon_holder edit_profile_phone">
                                    <div class="input_part position-relative">

                                        <div class="icon_part d-flex justify-content-center align-items-center">
                                            <i class="fas fa-phone phone_rotate"></i>
                                        </div>
<!-- id="phone" -->
                                        <div class="d-flex">
                                            <input style="padding-left : 60px; width: 120px;border-right: 0; border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; opacity: 0;" type="text" name="country_code" id="phone"  oninput="this.value=this.value.replace(/[^0-9\+]/g,'');"
                                             class="form-control" value="<?php echo $details['country_code'];?>" id="country_code" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                              <input style="padding-left: 15px; border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important" placeholder="Enter Telephone" type="text" class="form-control"
                                            value="<?php echo $details['telephone'];?>" name="phone" 
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                            style="padding-left: 104px;" maxlength="11">
                                        </div>
                                       



                                        <!-- <input type="hidden" name="country_code1" id="country_code1" value="+44"> -->
                                    </div>
                                </div>
                            </div>






                        </div>


                        <div class="btn_holder d-flex justify-content-end pr-3 pb-3 mt-2">
                            <div>
                                <button class="btn btn_cancel profile_btn mr-1"
                                    onClick="window.location.href='<?php echo base_url();?>profile';">Cancel</button>
                                <input type="submit" name="submit" value="Save" class="btn button_yellow profile_btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab_content" id="tab_content2">
                <form autocomplete="off" action="<?php echo $base_url;?>change-password" name="change_password_form"
                    id="change_password_form" method="post" enctype="multipart/form-data">
                    <input id="tab2" name="tab2" value="tab2" type="hidden">
                    <div class="d-grid profile_tab_inputs profile_password p-3">
                        <div class="old_password_container">
                            <label class="primary_text_color" for="first_name">
                                <h4>Old Password</h4>
                            </label>
                            <div class="input_with_icon_holder ">
                                <div class="input_part position-relative">
                                    <div class="icon_part d-flex justify-content-center align-items-center">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <!--  <input id="first_name" placeholder="Enter Old Password" type="text"
                                        class="form-control"> -->
                                    <input type="password" type="password" id="old_password" name="old_password"
                                        placeholder="Old Password" class="form-control">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                                        id="show_old_password"></span>
                                </div>
                            </div>
                        </div>


                        <div>
                            <label class="primary_text_color" for="last_name">
                                <h4>New Password</h4>
                            </label>
                            <div class="input_with_icon_holder">
                                <div class="input_part position-relative">
                                    <div class="icon_part d-flex justify-content-center align-items-center">
                                        <i class="fas fa-lock"></i>
                                    </div>

                                    <!--  <input id="last_name" placeholder="Enter New Password" type="text"
                                        class="form-control"> -->
                                    <input type="password" type="password" value="" id="new_password"
                                        name="new_password" placeholder="New Password" class="form-control">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                                        id="show_new_password"></span>
                                </div>
                            </div>
                        </div>


                        <div>
                            <label class="primary_text_color" for="email">
                                <h4> Confirm Password </h4>
                            </label>
                            <div class="input_with_icon_holder">
                                <div class="input_part position-relative">
                                    <div class="icon_part d-flex justify-content-center align-items-center">
                                        <i class="fas fa-lock"></i>
                                    </div>

                                    <!--  <input id="email" placeholder="Confirm Password" type="text" class="form-control"> -->
                                    <input type="password" type="password" value="" id="confirm_password"
                                        name="confirm_password" placeholder="Confirm Password" class="form-control">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                                        id="show_confirm_password"></span>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="btn_holder d-flex justify-content-end pr-3 pb-3 mt-2">
                        <div>
                            <button class="btn btn_cancel profile_btn mr-1"
                                onClick="window.location.href='<?php echo base_url();?>profile';">Cancel</button>
                            <!-- <input type="submit" value="Save" class="btn button_yellow profile_btn"> -->
                            <input type="submit" name="submit" id="change_btn" value="Save"
                                class="btn button_yellow profile_btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

<?php echo $footer;?>
<script type="text/javascript">
$(function() {
    $('.tab').on('click', function() {
        console.log("$(this)");
        let sec_id = $(this).attr('sec_id');
        $('.tab').removeClass('active_tab').addClass('non_active_tab');
        $('#tab' + sec_id).removeClass('non_active_tab').addClass('active_tab');
        $('.tab_content').hide();
        $('#tab_content' + sec_id).fadeIn();
    })
})

$(document).ready(function() {
    <?php if($this->session->userdata('tab')=='tab1'){?>
    // alert(1);
    $('#tab2').removeClass('active_tab').addClass('non_active_tab');
    $('#tab1').removeClass('non_active_tab').addClass('active_tab');
    $('.tab_content').hide();
    $('#tab_content1').fadeIn();
    <?php } else if($this->session->userdata('tab')=='tab2') { ?>
    // alert(1);
    $('#tab1').removeClass('active_tab').addClass('non_active_tab');
    $('#tab2').removeClass('non_active_tab').addClass('active_tab');
    $('.tab_content').hide();
    $('#tab_content2').fadeIn();
    <?php } ?>
    $("#profile_form").validate({
        rules: {
            fname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo base_url();?>profile/register_email_exists",
                    type: "post",
                    data: {
                        email: function() {
                            return $("#email").val();
                        }
                    }
                }
            },
            country_code: {
            required: true,
            minlength: 2,
            maxlength: 5
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 11
                // },
                // password: {
                //     required: true,
                //     minlength: 8,
                //     passwordErrorStrong: true
            }
        },
        messages: {
            fname: {
                required: "First name field is required"
            },
            email: {
                required: "Email field is required",
                email: "Please enter valid email",
                remote: 'Email already used. Profile update with another account.'
            },
            country_code: {
                required: "Country code field is required",
                minlength: "Phone should be atleast 2 characters",
                maxlength: "Phone should be maximum 5 characters"
            },
            phone: {
                required: "Phone Number field is required",
                minlength: "Phone should be atleast 10 characters",
                maxlength: "Phone should be maximum 11 characters"
                // },
                // password: {
                //     required: "Password field is required",
                //     minlength: "Password should be atleast 8 characters"
            }
        },
        // submitHandler: function(form) {
        //     form.submit();
        // }
    });
    $('#profile_btn').click(function() {
        var emailid = $('#email').val();
        if (emailid != '') {
            if (IsEmail(emailid) == false) {
                $('#invalid_email').css("display", "block");;
                return false;
            }
        }
    });
});

function IsEmail(emailid) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(emailid)) {
        return false;
    } else {
        return true;
    }
}
</script>
<script src="<?php echo base_url();?>assets/frontend/js/intlTelInput-jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#phone").intlTelInput({
        initialCountry: 'gb',
        utilsScript: "http://www.bitpastel.org/skybound-main/assets/frontend/js/utils.js",
    });

    $('#phone').on("countrychange", function() {
        let flag_code = $(".selected-flag").attr('title').split(':')[1].replace(/ /g, '');
        console.log(flag_code);
        $('#country_code').val(flag_code);
    });

    $("#show_old_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#old_password').attr('type') == 'text') {
            $('#old_password').attr('type', 'password');
        } else {
            $('#old_password').attr('type', 'text');
        }

    });
    $("#show_new_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#new_password').attr('type') == 'text') {
            $('#new_password').attr('type', 'password');
        } else {
            $('#new_password').attr('type', 'text');
        }

    });
    $("#show_confirm_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#confirm_password').attr('type') == 'text') {
            $('#confirm_password').attr('type', 'password');
        } else {
            $('#confirm_password').attr('type', 'text');
        }

    });
    jQuery.validator.addMethod("passwordErrorStrong", function(value, element) {
        var strongRegex = new RegExp("^(?=.{10,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp(
            "^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$",
            "g");
        var enoughRegex = new RegExp("(?=.{7,}).*", "g");
        if (value.length < 8) {
            return false;
        } else {
            if (false == enoughRegex.test(value)) {
                return false;
            } else if (strongRegex.test(value)) {
                return true;
            } else if (mediumRegex.test(value)) {
                return true;
            } else {
                return false;
            }


        }
    }, "Oops! Add letter(s), number(s) and/or symbol(s)!");
    $("#change_password_form").validate({
        rules: {
            old_password: {
                required: true,
            },

            new_password: {
                required: true,
                minlength: 8,
                passwordErrorStrong: true
            },
            confirm_password: {
                equalTo: "#new_password"
            },

        },
        messages: {
            old_password: {
                required: "Old password field is required",
            },
            new_password: {
                required: "New password field is required",
                minlength: "Password should be atleast 8 characters"

            },
            confirm_password: {
                required: "Confirm password does not matched!",
            },
        },
    });
});
</script>

<script src="https://unpkg.com/jquery-input-mask-phone-number@1.0.4/dist/jquery-input-mask-phone-number.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/intlTelInput-jquery.min.js"></script>

<script>
$(document).ready(function($) {
    $('#phone1').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });


    $("#phone").intlTelInput({
        initialCountry:'gb' ,
        utilsScript: "http://www.bitpastel.org/skybound-main/assets/frontend/js/utils.js",
    });

    $('#phone').on("countrychange", function() {
        let flag_code = $(".selected-flag").attr('title').split(':')[1].replace(/ /g, '');
        console.log(flag_code);
        $('#country_code').val(flag_code);
    });

});
</script>