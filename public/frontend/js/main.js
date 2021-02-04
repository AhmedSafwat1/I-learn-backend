$(window).on("load", function () { });
$(document).ready(function () {
    if ($(window).width() <= 991) {
        $(".mo-nav").wrap('<div class="xs-nav"></div>')
        $('.drop-down .nav-anchor').click(function () {
            $(this).siblings().slideToggle(300);
        });

        $('.mo-menu-ico').click(function () {
            $(".xs-nav").fadeIn(400);
            $(".mo-nav").addClass("nav-in");
            $("body").addClass("overflow");
        });

        $('.xs-nav').click(function () {
            $(".xs-nav").fadeOut(400);
            $(".mo-nav").removeClass("nav-in");
            $("body").removeClass("overflow");
        });
        $('.mo-nav').click(function (e) {
            e.stopPropagation();
        });
        ////////////////////
        $('.serch-ico').click(function () {
            $(".search-cont").slideToggle(300);
        });



    }
    if ($(window).width() >= 991) {
        new WOW().init();
        $(window).scroll(function () {
            var scrollVal = $(this).scrollTop() - 173;
            if ($(this).scrollTop() >= 173) {
                $('main').css('background-position-y', + scrollVal + 'px');
            } else {
                $('main').css('background-position-y', '0');
            }
        });
    }
    /////////Main Slider/////////
    $('.latest-img').owlCarousel({
        margin: 30,
        rtl: document.dir == 'rtl' ? true : false,
        dots: true,
        responsive: {
            0: {
                items: 1,
            },
            500: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        }
    });
    /////////////////////
  
});

$('input[type=radio][name=for]').change(function () {
    if (this.value == 'Myself') {
        $(".from").hide();
    }
    else if (this.value == 'Some one Else') {
        $(".from").show();
    }
});