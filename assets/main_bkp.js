$(function () {
    let num = 100;
    let cour_item_length = $(".carousel_inner .item").length;
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
        console.log(id);
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
            console.log("Play");
            jQuery("#menu4").click();
            scroll_play = true;
        }
    });

    function stop_video(param) {
        console.log("Stop Video");
        let iframe_src = $('#iframe_video' + param)[0].src.split("&");
        let i = iframe_src.indexOf("autoplay=1");
        iframe_src[i] = "";
        iframe_src.join("");
        console.log(iframe_src);
        jQuery('#iframe_video' + param)[0].src = iframe_src.join("");
    }

    $(".carousel-control-prev, .carousel-control-next").on("click", function () {
        stop_video(video_id);
        if ($(this)[0].className === "carousel-control-prev") {
            video_id > 1 ? video_id -= 1 : video_id = 3;
        } else {
            video_id < 3 ? video_id += 1 : video_id = 1;
        }
        // console.log(video_id);
    });


    // let view = 0;
    // let section = 1;
    // wheel_ready = true;
    // $('body').on({
    //     'mousewheel': function (e) {
    //         if (e.originalEvent.wheelDelta > view) {
    //             console.log("Up");
    //             section == 1 ? section = 1 : --section;
    //         }
    //         else {
    //             // jQuery('html,body').animate({ scrollTop: jQuery("#section" + section).offset().top }, 200);
    //             if (wheel_ready) {
    //                 console.log("Down");
    //                 section == 5 ? section = 5 : ++section;
    //                 jQuery('html,body').animate({ scrollTop: jQuery("#section" + section).offset().top }, 200);
    //             }
    //             wheel_ready = false;
    //             setTimeout(() => {
    //                 wheel_ready = true;
    //             }, 5000);

    //         }
    //         view = e.view.pageYOffset;

    //     }


    // });

    // $('#section2').on({
    //     'mousewheel': function (e) {
    //         console.log(e);
    //     }
    // })



    // $("#next").on("click", function () {
    //     if (num > 100 * (cour_item_length - 1)) {
    //         num = 0;
    //         $(".courouse_outer").animate({ 'margin-left': "-" + num + "vw" }, 0);
    //         num += 100;
    //         $("#next").click();
    //     } else {
    //         $(".courouse_outer").animate({ 'margin-left': "-" + num + "vw" }, 300);
    //         num += 100;
    //     }
    // });
    // $("#prev").on("click", function () {
    //     num -= 100;
    //     if (num < 0) {
    //         num = 100 * (cour_item_length - 1);
    //         $(".courouse_outer").animate({ 'margin-left': "-" + num + "vw" }, 0);
    //         $("#prev").click();
    //     }
    //     else {
    //         $(".courouse_outer").animate({ 'margin-left': "-" + num + "vw" }, 300);
    //     }
    // });

});