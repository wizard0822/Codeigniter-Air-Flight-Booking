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
            <form autocomplete="off" action="<?php echo $base_url;?>reset-password/<?php echo $id;?>"
                name="resetpass_form" id="resetpass_form" method="post" enctype="multipart/form-data">
                <div class="password_holder mb-4 position-relative">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                        id="show_password"></span>
                </div>
                <div class="password_holder mb-4 position-relative">
                    <input type="password" placeholder="Confirm Password" name="c_password" id="c_password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                        id="show_c_password"></span>
                </div>
                <div class="signin_buttom">
                    <input type="submit" name="resetpass" id="resetpass_btn" value="Submit"
                        class="signin_custom_button">
                </div>
            </form>
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
    $("#show_c_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($('#c_password').attr('type') == 'text') {
            $('#c_password').attr('type', 'password');
        } else {
            $('#c_password').attr('type', 'text');
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
                //$('#passstrength').html('More Characters');
                return false;
            } else if (strongRegex.test(value)) {
                //$('#passstrength').className = 'ok';
                // $("#weekMsg").hide();
                return true;
                //$('#passstrength').html('<span class="testresult strongPass"><span>Strong</span></span>');
            } else if (mediumRegex.test(value)) {
                //$('#passstrength').className = 'alert';
                // $("#weekMsg").hide();
                return true;
                //$('#passstrength').html('<span class="testresult goodPass"><span>Ok</span></span>');
            } else {
                // $('#passstrength').className = 'error';
                // $("#weekMsg").show();
                return false;
                //$('#passstrength').html('<span class="testresult badPass"><span>Weak</span></span>');
            }


        }
    }, "Oops! Add letter(s), number(s) and/or symbol(s)!");
    $("form[name='resetpass_form']").validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                passwordErrorStrong: true

            },
            c_password: {
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Password field is required",
                minlength: "Password should be atleast 8 characters"
            },
            c_password: {
                required: "Confirm password does not matched!"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>