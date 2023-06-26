$(document).ready(function () {
// start main tab
    $('.main-tab-nav .tab-item:first-of-type').addClass('active');
    $('.main-tab-content').hide();
    $('.main-tab-content:last').css({"display": "flex"});

// Click function

    if (getUrlParameter('#active')==0){
        location.hash = 'active=home-tab';
    }else{
        var activeTab = '#'+getUrlParameter('#active');
        $('.main-tab-nav .tab-item').removeClass('active');
        $("."+activeTab.replace('#','')).addClass('active');
        $('.main-tab-content').hide();
        $(activeTab).fadeIn();
    }

    $('.main-tab-nav .tab-item').click(function () {

        $('.main-tab-nav .tab-item').removeClass('active');
        $(this).addClass('active');
        $('.main-tab-content').hide();

        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();
        location.hash = 'active=' + activeTab.replace('#','');
        return false;
    });

    //if (getUrlParameter())


// end main tab

// start category tab
    $('.category-nav .category-tab-item:first-of-type').addClass('active');
    $('.category-tab-content').hide();
    $('.category-tab-content:first').css({"display": "flex"});
// end category tab

    $('.category-nav .category-tab-item').click(function () {
        $('.category-nav .category-tab-item').removeClass('active');
        $(this).addClass('active');
        $('.category-tab-content').hide();
        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();

        return false;

    });
// start main new tab
    $('.main-new-nav .new-tab-item:first-of-type').addClass('active');
    $('.main-new-content').hide();
    $('.main-new-content:first').css({"display": "flex"});
    $('.main-new-nav .new-tab-item').click(function () {
        $('.main-new-nav .new-tab-item').removeClass('active');
        $(this).addClass('active');
        $('.main-new-content').hide();
        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();

        return false;
    });
// start new tab
    $('.new-nav .new-tab-item:first-of-type').addClass('active');
    $('.new-tab-content').hide();
    $('.new-tab-content:first').css({"display": "flex"});
// end new tab
    $('.new-nav .new-tab-item').click(function () {
        $('.new-nav .new-tab-item').removeClass('active');
        $(this).addClass('active');
        $('.new-tab-content').hide();
        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();

        return false;
    });
});
