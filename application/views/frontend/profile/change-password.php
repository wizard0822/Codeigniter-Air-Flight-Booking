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
            <form autocomplete="off" action="<?php echo $base_url;?>change-password" name="change_password_form" id="change_password_form"
                method="post" enctype="multipart/form-data">
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="password" type="password" id="old_password" name="old_password" placeholder="Old Password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                            id="show_old_password"></span>
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="password" type="password" value="" id="new_password" name="new_password" placeholder="New Password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                            id="show_new_password"></span>
                    </div>
                </div>
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="password" type="password" value="" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                            id="show_confirm_password"></span>
                    </div>
                </div>
                
                <div class="signin_buttom signup_button">
                    <input type="submit" name="submit" id="change_btn" value="Submit" class="signin_custom_button">
                </div>
            </form>
        </div>
    </div>
</section>

    <?php echo $footer;?>
<script type="text/javascript">
$(document).ready(function() {
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
        rules:{
                old_password:{
                    required:true,
                },
                
                new_password:{
                    required:true,
                    minlength:8,
                    passwordErrorStrong: true
                },
                confirm_password:{ 
                    equalTo: "#new_password"
                },
                
            },
            messages:{
                old_password:{
                    required:"Old password field is required",
                },
                new_password:{
                    required:"New password field is required",
                    minlength:"Password should be atleast 8 characters"
                
                },
                confirm_password:{
                    required:"Confirm password does not matched!",
                },
            },
        });
    });
    
</script>
