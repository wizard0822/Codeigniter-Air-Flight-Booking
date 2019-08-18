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
            <form autocomplete="off" action="<?php echo $base_url;?>verify-account/<?php echo $id;?>" name="account_verify_form" id="account_verify_form"
                method="post" enctype="multipart/form-data">
                <div class="tel_holder mb-4">
                    <div class="position-relative">
                        <input type="text" name="verification_code" id="verification_code" placeholder="Enter Verification Code" value="<?php echo $verification_code;?>">
                    </div>
                    <div class="resend_verify_code">
                    <a href="<?php echo $base_url;?>signup/resend_verification_code/<?php echo $id;?>" class="signin_custom_button">Resend verification Code</a>
                    </div>
                </div>
                <div class="signin_buttom signup_button">
                    <input type="submit" name="submit" id="verify_btn" value="Submit" class="signin_custom_button">
                </div>
            </form>
        </div>
    </div>
</section>
<?php echo $footer;?>
<script type="text/javascript">
$(document).ready(function() {
    $("#account_verify_form").validate({
        rules: {
            verification_code: {
                required: true,
            }
        },
        messages: {
            verification_code: {
                required: "Verification code field is required"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>