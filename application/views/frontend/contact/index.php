<?php echo $header;?>
<?php echo $top_menu;?>

<section class="contact">
    <div class="container">
        <div class="contact_block contact_block_holder">
            <h3>Contact</h3>
            <div class="input_field">
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
                <form name="contact_form" id="contact_form" method="post" action="<?php echo base_url();?>contact">
                    <div class="name_field">
                        <div class="form-group contact_input">
                            <label for="exampleInputEmail1" class="label_text">First Name*</label>
                            <input type="text" name="first_name" class="form-control form_input" aria-label="First Name"
                                id="first_name" aria-describedby="firstName">
                        </div>
                        <div class="form-group contact_input">
                            <label for="exampleInputEmail1" class="label_text">Last Name*</label>
                            <input type="text" name="last_name" class="form-control form_input" aria-label="Last Name"
                                id="last_name" aria-describedby="lastName">
                        </div>
                    </div>
                    <div class="name_field">
                        <div class="form-group contact_input">
                            <label for="exampleInputEmail1" class="label_text">Email*</label>
                            <input type="email" name="email" class="form-control form_input" id="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group contact_input">
                            <label for="exampleInputEmail1" class="label_text">Phone*</label>
                            <input type="text" name="phone" class="form-control form_input contact_phone"
                                aria-label="Phone Number" id="phone" aria-describedby="phoneNo"
                                oninput="this.value=this.value.replace(/[^0-9\.]/g,'');">
                        </div>
                    </div>
                    <div class="form-group contact_input">
                        <label for="exampleInputEmail1" class="label_text">Message</label>
                        <textarea name="message" class="form-control form_input form_textarea" aria-label="Message"
                            id="message" aria-describedby="Message"></textarea>
                    </div>
                    <div class="d-flex justify-content-center contact_custom_button ">
                        <input type="submit" class="btn btn-danger  btn_red" name="submit" value="Submit">
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<?php echo $footer;?>
<script type="text/javascript">
$('document').ready(function() {
    setTimeout(function() {
        $('.alert-danger').hide();
    }, 2000);
    setTimeout(function() {
        $('.alert-success').hide();
    }, 2000);
    $("#contact_form").validate({
        focusInvalid: false,
        ignore: [],
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 11
            }
        },
        messages: {
            first_name: {
                required: "Please enter first name"
            },
            last_name: {
                required: "Please enter last name"
            },
            email: {
                required: "Please enter email"
            },
            phone: {
                required: "Please enter phone",
                minlength: "Phone should be atleast 10 characters",
                maxlength: "Phone should be maximum 11 characters"
            }
        },
        // submitHandler: function(form) {
        //     form.submit();
        // }
    });
})
</script>