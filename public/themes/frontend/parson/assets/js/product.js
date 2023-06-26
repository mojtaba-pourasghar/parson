jQuery(document).ready(function ($) {
    // Get current path and find target link
    var path = window.location.pathname.split("/").pop();

    // Account for home page with empty path
    if (path == '') {
        path = 'index.php';
    }
    // profile menu active
    var target = $('.fabric-type-box a[href="' + path + '"]');
    // Add active class to target link
    target.addClass('active');
});
// fabric single slider
const swiper = new Swiper('.single-fabric-slider .swiper-container', {
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
    },
    slidesPerView: 1,
    autoplay: {
        delay: 3000,
        stopOnLastSlide: false,
        pauseOnMouseEnter: false,
    },
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    centeredSlides: true,
});

//color property box
$(document).ready(function () {
    $('.color-property-box .color-box .color').click(function (e) {
        e.preventDefault();
        $('.color-property-box .color-box .color').removeClass('active');
        $(this).addClass('active');
    });
});

$('document').ready(function () {
    // product carousel
    $('#carousel-off-product').owlCarousel({
        autoplay: false,
        //  autoplayTimeout:2800,
        autoWidth: true,
        rtl: true,
        margin: 5,
        items: 4,
        nav: true,
        dots: false

    });
    $(".owl-next").html('<i class="fas fa-angle-right slider-nav-btn"></i>');
    $(".owl-prev").html('<i class="fas fa-angle-left slider-nav-btn"></i>');

});
//fabric size

$("#main_radio").click(function () {
    $("#main_radio").attr('class', 'fabric-type active');
    $("#sample_radio").attr('class', 'fabric-type');
    $(".sample_property").hide(1000);
    $(".main_property").show(1000);
});

$("#sample_radio").click(function () {
    $("#sample_radio").attr('class', 'fabric-type active');
    $("#main_radio").attr('class', 'fabric-type');
    $(".main_property").hide(1000);
    $(".sample_property").show(1000);
});
$(document).ready(function () {

    var metr = 0;
    var cantimetr = 0;
    $("#main_radio").attr('class', 'fabric-type active');
    $(".sample_property").hide();
    var metrnum = 1;
    $('#centimeter_plus').click(function () {
        if (!checkAvilableAmount())
            $('#cantimetr').val($('#cantimetr').val() - 20);
        if ($('#cantimetr').val() == 100) {
            $('#cantimetr').val(0);
            $('#metr').val(parseInt($('#metr').val()) + 1);
        }
        calculateSum();
    });
    $('#centimeter_minus').click(function () {
        calculateSum();
    });

    $('#meter_plus').click(function () {
        if (!checkAvilableAmount()) {
            $('#metr').val($('#metr').val() - 2);
        }
        calculateSum();
    });

    $('#meter_minus').click(function () {
        calculateSum();
    });

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function calculateSum() {
        metr = $('#metr').val();
        cantimetr = $('#cantimetr').val();
        var totalTextile = parseInt(metr) + cantimetr / 100;

        var sum_price = totalTextile * _sum_discount_price;

        var res = [];
        for (let i = 0; i < price_pattern.length; i++) {
            var valData = price_pattern[i].toString();
            var valNew = valData.split(',');
            if (totalTextile >= valNew[0] && totalTextile <= valNew[1])
                sum_price = sum_price - (sum_price * valNew[2]);
        }
        sum_price = Math.trunc(sum_price);
        $('#sum_price').text(addCommas(sum_price) + 'ریال ');
        $('#sum_price_input').val(sum_price);
    }

    function checkAvilableAmount() {
        var totalTextile = parseInt(metr) + cantimetr / 100;
        if (_avaiable_amount < totalTextile) {
            toastr.error('مقدار بیشتر موجود نمیباشد');
            return false;
        }
        return true;
    }

});



