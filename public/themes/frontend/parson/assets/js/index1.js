$('document').ready(function () {
    $('#top-fabric-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 2800,
        loop: true,
        rtl: true,
        margin: 0,
        items: 1,
        nav: true,
        dots: true,
        dotsData: true,
    });
    $(".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
    $(".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');


    $('#main-slider').owlCarousel({
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        rtl: true,
        margin: 0,
        items: 1,
        nav: true,
        dots: true

    });

    $('#carousel-off-product').owlCarousel({
        autoplay: false,
        //  autoplayTimeout:2800,
        autoWidth: true,
        loop: false,
        rtl: true,
        margin: 5,
        items: 4,
        nav: true,
        dots: false

    });
    $(".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
    $(".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');

// circle slider
    var swiper = new Swiper('.fabric-slider-circle .swiper-container', {
        slidesPerView: 1,
        spaceBetween: 5,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        centeredSlides: true,
        navigation: {
            nextEl: '.slideNext-btn',
            prevEl: '.slidePrev-btn'

        },
        // init: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2800,
            disableOnInteraction: false,
        },
        breakpoints: {
            '@0.00': {
                slidesPerView: 5,
                spaceBetween: 5,
            },

        }
    });
    $('#fabric-off-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 2800,
        loop: false,
        rtl: true,
        margin: 0,
        items: 1,
        nav: false,
        dots: false

    });
    $('#carousel-off-product').owlCarousel({
        autoplay: false,
        //  autoplayTimeout:2800,
        autoWidth: true,
        loop: false,
        rtl: true,
        margin: 5,
        items: 4,
        nav: true,
        dots: false

    });
    $(".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
    $(".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');

    var swiper = new Swiper('.swiper-container#carousel-off-product', {
        watchSlidesProgress: true,
        watchSlidesVisibility: true,
        loop: false,
        grabCursor: true,
        navigation: {
            prevEl: '.swiper-button-prev',
            nextEl: '.swiper-button-next',

        },
        slidesPerView: 3,

    })

    $('#carousel-top-product').owlCarousel({
        autoplay: false,
        // autoplayTimeout:2800,
        autoWidth: true,
        loop: false,
        rtl: true,
        margin: 5,
        items: 4,
        nav: true,
        dots: false

    });
    $(".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
    $(".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');

// start timer
    $('document').ready(function () {
        $('#countdown4').ClassyCountdown({
            end: $.now() + 65000,
            labels: true,
            style: {
                element: "",
                textResponsive: .7,
                days: {
                    gauge: {
                        thickness: .05,
                        bgColor: "rgba(255,255,255,0.05)",
                        fgColor: "#fe5e54"
                    },
                    textCSS: 'font-family:\'ByekanNum\'; font-size:25px; font-weight:500; color:#000;'
                },
                hours: {
                    gauge: {
                        thickness: .05,
                        bgColor: "rgba(255,255,255,0.05)",
                        fgColor: "#fe5e54"
                    },
                    textCSS: 'font-family:\'ByekanNum\'; font-size:25px; font-weight:500; color:#000;'
                },
                minutes: {
                    gauge: {
                        thickness: .05,
                        bgColor: "rgba(255,255,255,0.05)",
                        fgColor: "#fe5e54"
                    },
                    textCSS: 'font-family:\'ByekanNum\'; font-size:25px; font-weight:500; color:#000;'
                },
                seconds: {
                    gauge: {
                        thickness: .05,
                        bgColor: "rgba(255,255,255,0.05)",
                        fgColor: "#fe5e54"
                    },
                    textCSS: 'font-family:\'ByekanNum\'; font-size:25px; font-weight:500; color:#000;'
                }

            },
            onEndCallback: function () {
                console.log("Time out!");
            }
        });
    });
});
