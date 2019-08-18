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
            <form autocomplete="off" action="<?php echo $base_url;?>signin" name="signin_form" id="signin_form"
                method="post" enctype="multipart/form-data">
                <div class="email_holder mb-4 position-relative">
                    <input type="email" name="email" placeholder="Email Address" id="email" class="email">
                </div>
                <div class="password_holder mb-4 position-relative">
                    <input type="password" placeholder="Password" name="password" id="password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon custom_button_eye"
                        id="show_password"></span>
                </div>
                <div class="remember_password">
                    <div class="remember">
                        <span>
                            <label class="checkbox_container">Remember Me
                                <input type="checkbox" name="remember_me">
                                <span class="checkmark"></span>
                            </label>
                        </span>
                        <span></span>
                    </div>
                    <div class="password forget_password">
                        <a href="<?php echo base_url();?>forgot-password">Forgot Password?</a>
                    </div>
                    <!-- <div class="password forget_password">
                    <?php if($this->session->userdata('resend_otp_link')!=''){?>
                        <a href="<?php echo $this->session->userdata('resend_otp_link');?>">Resend OTP</a>
                    <?php } ?>
                    </div> -->
                </div>
                <div class="signin_buttom signup_button">
                    <input type="submit" name="signin" id="signin_btn" value="Sign In" class="signin_custom_button">
                     
                </div>
            </form>
            <p>Don't have an account?<a href="<?php echo base_url();?>signup"><span> Sign Up</span></a></p>
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
    $("form[name='signin_form']").validate({
        rules: {
            email: {
                required: true,
                email: true


            },
            password: {
                required: true,

            }
        },
        messages: {
            email: {
                required: "Email field is required",
                email: "Please enter valid email"

            },
            password: {
                required: "Password field is required",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>