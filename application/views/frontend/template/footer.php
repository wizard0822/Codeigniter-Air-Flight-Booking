    <section class="footer_above">
        <div class="container">
            <div class="footer_above_inner footer_block">
                <div class="footer_above_inner_one">
                    <div class="footer_above_inner_one_text_box_one">
                        <h4>Get In Touch</h4>
                        <div class="footer_above_text">
                            <span><img src="<?php echo $base_url;?>assets/frontend/images/footer_one.png"></span>
                            <span>444 Park Eden Road,Park<br> Eden, England.</span>
                        </div>
                        <div class="footer_above_text footer_above_text_block">
                            <span><img src="<?php echo $base_url;?>assets/frontend/images/footer_two.png"></span>
                            <span>+12345678901</span>
                        </div>
                        <div class="footer_above_text">
                            <span><img src="<?php echo $base_url;?>assets/frontend/images/footer_three.png"></span>
                            <span><a href="">custserv@skybound.taxi</a></span>
                        </div>
                    </div>
                </div>
                <div class="footer_above_inner_one">
                    <div class="footer_above_inner_one_text_box_two">
                        <h4>FAQ</h4>
                        <h5>Lorem ipsum dolor sit amet</h5>
                        <h5>Lorem Ipsum available</h5>
                        <h5>Ipsum generators on the Internet </h5>
                    </div>
                </div>
                <div class="footer_above_inner_one">
                    <div class="footer_above_inner_one_text_box_three">
                        <h4>Lorem ipsum dolor</h4>
                        <h5>Lorem ipsum dolor sit amet</h5>
                        <h5>Lorem Ipsum available</h5>
                        <h5>Ipsum generators on the Internet </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="copy_right">
        <div class="container">
            <div class="P_and_c">
                <p><a href="<?php echo base_url();?>privacy-policy"> Privacy Policy </a>&nbsp;|&nbsp;<a href="<?php echo base_url();?>terms-condition">Terms and Conditions</a></p>
                <h5>&copy; Copyright 2019-2020&nbsp;|&nbsp;Built and maintained in the UK |&nbsp;<a
                        href="#">SkyBound</a>
                </h5>
            </div>
        </div>
    </section>

    </body>
    <!-- js -->
    <script type="text/javascript" src="<?php echo $base_url;?>assets/frontend/js/jquery-2.1.4.min.js"></script>
    <!-- for bootstrap working -->
    <script src="<?php echo $base_url;?>assets/frontend/js/bootstrap.js"></script>
    <script src="<?php echo $base_url;?>assets/frontend/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="<?php echo $base_url;?>assets/frontend/vendor/jquery.validation/jquery.validate.min.js"></script>
    <script>
//let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
 var dt = new Date($.now());
 var time = dt.getHours();
 var minute = dt.getMinutes();
 // time=23;
 // minute=15;
 if(time=="19" && minute>="55")
 {
    var date = new Date();
    var dateToday = new Date(date.getTime() + 24 * 60 * 60 * 1000);
    var is_left_8='1';
 }
 else if(time<="19")
 {
    var dateToday = new Date();
    // alert(dateToday);
    var is_left_8='';
 }
 else
 {
    var date = new Date();
    var dateToday = new Date(date.getTime() + 24 * 60 * 60 * 1000);
    var is_left_8='1';
 }
 // alert(time);
 // alert(minute);
$('#datePicker').datepicker({
    uiLibrary: 'bootstrap4',
    dateFormat: "d MM yy (D)",
    // defaultDate: "+1w",
    minDate: dateToday,

}).removeClass('form-control');


$('#nav_bar_toggle').on('click', function($e) {
    // $e.stopPropagation();
    menuToggle();
});

$('.my_menu_holder').on('click', function($e) {
    if ($e.target.classList.contains('menu_overlay')) {
        menuToggle();
    }
})

$('.dropdown-toggle').on('click', function() {
    var winWidth = $(window).width();
    if (winWidth <= 991) {
        var menu_id = $(this).attr('menu_id');
        $('#' + menu_id).slideToggle(500, function() {
            $('#plus_minus').toggleClass('fa-plus fa-minus');
            $('.dropdown-toggle').toggleClass('menu_item_bg_blue');
        });
    }
})

function menuToggle() {
    $('#navbarSupportedContent').slideToggle(500, function() {
        $('body').toggleClass('body_fixed');
        $('.my_menu_holder').toggleClass('menu_overlay');
    })
}
    </script>
    <!-- //for bootstrap working -->
    <!-- //js -->
    <!-- <script type="text/javascript">
    $(document).ready(function() {
$('#signup').click(function(){
    <?php $this->session->unset_userdata('redirect_url');?>
});
$('#signin').click(function(){
    <?php $this->session->unset_userdata('redirect_url'); ?>
});
</script> -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script>
$(document).ready(function() {
    console.log("COOKIE", $.cookie('cookies-notification'));
    if ($.cookie('cookies-notification') != 'dismissed') {
        setTimeout(function() {
            $('#cookies-notification').slideToggle();
        }, 4000);

    } else {
        $('#cookies-notification').hide();

    }

    $('#dismiss-cookies-notification').click(function(e) {
        //      alert('hii');
        e.preventDefault();
        var height = $('#cookies-notification').height();
        var padding_cont = $('.section--slideshow .slider').css('padding-top');
        if (padding_cont !== undefined) var padding = padding_cont.replace(/px/g, '');

        $('.section--slideshow .slider').animate({
            'padding-top': (parseInt(padding) - parseInt(height) - 28) + 'px'
        }, 500);
        $.cookie('cookies-notification', 'dismissed', {
            expires: 365,
            path: '/'
        });
        $('#cookies-notification').slideToggle(500);

        if ($(window).scrollTop() > 135) {
            $('#bc-sf-filter-tree-h').addClass('fixed').css({
                'top': 86 + 'px'
            });
        } else {
            console.log('unset');
            $('#bc-sf-filter-tree-h').removeClass('fixed').css({
                'top': 'unset'
            });;
        }
    });
});
    </script>

    </html>