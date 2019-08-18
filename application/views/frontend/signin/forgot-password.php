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
            <form autocomplete="off" action="<?php echo $base_url;?>forgot-password" name="forgotpass_form"
                id="forgotpass_form" method="post" enctype="multipart/form-data">
                <small class="pb-2 font_80per d-block text-center">Please enter your email address to search for your
                    account.</small>
                <div class="email_holder mb-4 position-relative">
                    <input type="email" name="email" placeholder="Email Address" id="email" class="email">
                </div>
                <div class="signin_buttom">
                    <input type="submit" name="forgotpass" id="forgotpass_btn" value="Submit"
                        class="signin_custom_button">
                </div>
            </form>
        </div>
    </div>
</section>
<?php echo $footer;?>
<script type="text/javascript">
$(document).ready(function() {

    $("form[name='forgotpass_form']").validate({
        rules: {
            email: {
                required: true,
                email: true


            }
        },
        messages: {
            login_email: {
                required: "Email field is required",
                email: "Please enter valid email"

            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>