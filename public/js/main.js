$(document).ready(function () {
    $('.welcome-slider, .sidebar .ads').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 5000,
        speed: 500,
    });

    $(".customer-say .customer-slider").slick({
        dots: false,
        infinite: true,
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplaySpeed: 5000,
        speed: 500,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.form-group .form-control').each( function () {
        var val = $(this).val();
        if (val == null || val == ""){
            $(this).siblings('label').animate({
                top: '0.375rem',
                background: 'transparent'
            }, 300);
        }else {
            $(this).siblings('label').animate({
                top: -15,
                background: '#f5f5f5'
            }, 300);
        }
    });

    $('.form-group .form-control').keyup( function () {
        var val = $(this).val();
        if (val == null || val == ""){
            $(this).siblings('label').animate({
                top: '0.375rem',
                background: 'transparent'
            }, 300);
        }else {
            $(this).siblings('label').animate({
                top: -15,
                background: '#f5f5f5'
            }, 300);
        }
    });

    $(".user-dashboard .navbar .toggle_sidebar").click(function () {
        toggleSidebar();
    });

    function toggleSidebar(){
        var windowWidth = window.innerWidth;
        var sidebarValue = $(".user-dashboard .sidebar").css('left');
        if (windowWidth > 991){
            if (sidebarValue == '0px'){
                $(".user-dashboard .sidebar").css('left', '-250px');
                $(".user-dashboard .content").animate({marginLeft: 0},200);
            }else {
                $(".user-dashboard .sidebar").css('left', '0px');
                $(".user-dashboard .content").animate({marginLeft: 250},200);
            }
        }else {
            if (sidebarValue == '0px'){
                $(".user-dashboard .sidebar").css('left', '-250px');
                $(".user-dashboard .navbar").animate({paddingLeft: 15},200);
                $(".user-dashboard .content").animate({marginLeft: 0},200);
            }else {
                $(".user-dashboard .sidebar").css('left', '0px');
                $(".user-dashboard .content").animate({marginLeft: 0},200);
                $(".user-dashboard .navbar").animate({paddingLeft: 250},200);
            }
        }
    }


    function wowAnimation(){
        new WOW({
            offset: 100,
            mobile: true
        }).init()
    }
    wowAnimation()

});