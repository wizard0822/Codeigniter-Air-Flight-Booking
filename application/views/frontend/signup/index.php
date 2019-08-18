<?php echo $header;?>
<?php echo $top_menu;?>
<section class="signin_form">
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
            <form autocomplete="off" action="<?php echo $base_url;?>signup" name="signup_form" id="signup_form"
                method="post" enctype="multipart/form-data">
                <div class="name_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="fname" id="fname" placeholder="First Name"
                            value="<?php echo $fname;?>">
                    </div>
                    <div class="position-relative">
                        <input type="text" name="lname" id="lname" placeholder="Last Name" class="second_name"
                            value="<?php echo $lname;?>">
                    </div>
                </div>
                <div class="email_holder mb-4">
                    <div class="position-relative">
                        <input type="email" name="email" id="email" placeholder="Email Address" class="email"
                            value="<?php echo $email;?>">
                        <label
                            style="color: #c10000;font-size: 0.9em;line-height: 18px;padding: 5px 0 0; display: none;"
                            id="invalid_email" for="emailid">Email-id is invalid</label>

                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative input-group">
                        <!-- <div class="input-group-prepend country_code_box">

                            <span class="country-code input-group-text" id="basic-addon1">
                                <select name="country_code" id="country_code">
                                    
                                    <?php foreach ($country_code as $key => $value) { ?>


                                    <option <?php if($value=='44 (GB)') { ?>selected <?php } ?>
                                        value="<?php echo $value;?>">
                                        <?php echo $value;?></option>
                                    <?php } ?>
                                </select>
                            </span>
                        </div> -->

                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Telephone"
                            value="<?php echo $phone;?>" maxlength="11"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'');" style="padding-left:50px;">

                        <input type="hidden" name="country_code" id="country_code" value="+44">
                    </div>
                </div>
                <div class="password_holder mb-4">
                    <div class="position-relative">
                        <input type="password" id="password" placeholder="Password" name="password"
                            value="<?php echo $password;?>">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                            id="show_password"></span>
                    </div>
                </div>
                <div class="signin_buttom signup_button">
                    <input type="submit" name="signup" id="signup_btn" value="Sign Up" class="signin_custom_button">
                </div>
            </form>
            <p>Already Registered? <a href="<?php echo base_url();?>signin"><span> Sign In</span></a></p>
        </div>
    </div>
</section>
<?php echo $footer;?>
<script type="text/javascript">
$(document).ready(function() {

    $("#show_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#password').attr('type') == 'text') {
            $('#password').attr('type', 'password');
        } else {
            $('#password').attr('type', 'text');
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
    $("#signup_form").validate({
        rules: {
            fname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo base_url();?>signup/register_email_exists",
                    type: "post",
                    data: {
                        email: function() {
                            return $("#email").val();
                        }
                    }
                }
            },
            country_code: {
                required: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 11
            },
            password: {
                required: true,
                minlength: 8,
                passwordErrorStrong: true
            }
        },
        messages: {
            fname: {
                required: "First name field is required"
            },
            email: {
                required: "Email field is required",
                email: "Please enter valid email",
                remote: 'Email already used. Signup with another account.'
            },
            country_code: {
                required: "Country code field is required",
            },
            phone: {
                required: "Phone Number field is required",
                minlength: "Phone should be atleast 10 characters",
                maxlength: "Phone should be maximum 11 characters"
            },
            password: {
                required: "Password field is required",
                minlength: "Password should be atleast 8 characters"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#signup_btn').click(function() {
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