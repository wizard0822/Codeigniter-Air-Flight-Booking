$(function () {
    let num = 100;
    let cour_item_length = $("#section4 .carousel-item").length;
    // console.log(cour_item_length);
    let i = 1;
    let video_id = 1;
    let section_4_top = Math.floor(jQuery("#section4").offset().top);
    let scroll_play = false;
    jQuery('.fixed_menu').click(function () {
        var style = jQuery('.menu_items').css('display');
        jQuery('.menu_container').css('background', style !== 'none' ? 'transparent' : 'rgba(0, 0, 0, 0.8)');
        jQuery('.menu_items').slideToggle(200);
    });


    jQuery('.menu').click(function (e) {
        var id = jQuery(this).attr("section_no");
        // console.log(id);
        if (id == '4') {
            let iframe_src = $('#iframe_video1')[0].src.split("&");
            if (iframe_src.indexOf("autoplay=1") === - 1) {
                $('#iframe_video1')[0].src += "&autoplay=1";
            }
        }
        jQuery('html,body').animate({ scrollTop: jQuery("#section" + id).offset().top }, 200);
    });

    jQuery(window).scroll(function (e) {
        let current_target_scroll = Math.floor(e.currentTarget.scrollY);
        if ((current_target_scroll >= section_4_top) && !scroll_play) {
            // console.log("Play");
            jQuery("#menu4").click();
            scroll_play = true;
        }
    });

    function stop_video(param) {
        // console.log("Stop Video");
        let iframe_src = $('#iframe_video' + param)[0].src.split("&");
        let i = iframe_src.indexOf("autoplay=1");
        iframe_src[i] = "";
        iframe_src.join("");
        // console.log(iframe_src);
        jQuery('#iframe_video' + param)[0].src = iframe_src.join("");
    }

    $(".carousel-control-prev, .carousel-control-next").on("click", function () {
        stop_video(video_id);
        if ($(this)[0].className === "carousel-control-prev") {
            video_id > 1 ? video_id -= 1 : video_id = cour_item_length;
            $('#iframe_video' + video_id)[0].src += "&autoplay=1";
        } else {
            video_id < cour_item_length ? video_id += 1 : video_id = 1;
            $('#iframe_video' + video_id)[0].src += "&autoplay=1";
        }
    });


    // jQuery(".carousel").on("swiperight", function (e) {
    //     console.log("SWIPE");
    //     // $(this).carousel('prev');
    //     // e.preventDefault();
    //     // return false;
    // });
    // jQuery(".carousel").on("swipeleft", function (e) {
    //     console.log("SWIPE left");
    //     // $(this).carousel('next');
    //     // e.preventDefault();
    //     // return false;
    // });



    // $('.carousel').on('slide.bs.carousel', function () {
    //     console.log("slide Happens");
    //     // do something…
    // });

    jQuery(window).on("swipeleft", function (event) {
        console.log(event);
    });

});