function loading(id, address, element, params, callbackFunc, callBackFuncParams) {
    openLoading();
    $.ajax({
        url: address,
        data: params,
        datatype: 'html',
        success: function (result) {
            $(element).html(result);
            closeloading();
            $('#' + id).modal('toggle');
            $('#' + id).on('hidden.bs.modal', function () {
                remove_modal();
            });

            $('#' + id + " .close").on('click', function () {
                remove_modal();
                $('.modal-backdrop').remove();
            });

            if (typeof callbackFunc !== "undefined") {
                if (typeof callBackFuncParams !== "undefined")
                    callbackFunc(callBackFuncParams);
                else
                    callbackFunc();
            }
        },
        error: function (result) {
            alert('there is some errors . please refresh your page or try later...')
        },
        complete: function (result) {
        }
    });
}

function popUp(id, address, params, callbackFunc, callBackFuncParams) {
    $('body').prepend("<div id='pop_up_modal'></div>");
    loading(id, address, $("#pop_up_modal"), params, callbackFunc, callBackFuncParams);
}

function modalCloser() {
    $(".modalCloser").click(function (e) {
        $('#pop_up_modal').fadeOut(400);
        setTimeout(function () {
            $("#pop_up_modal").remove();
        }, 410);
        $('body').css('overflow', 'auto');
    });
}

function remove_modal() {
    $('#pop_up_modal').fadeOut(400);
    setTimeout(function () {
        $("#pop_up_modal").remove();
    }, 410)
    $('body').css('overflow', 'auto');
}

toastr.options = {
    rtl: true,
    closeButton: true,
    debug: false,
    "newestOnTop": false,
    progressBar: true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "7000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
};

function openLoading() {
    $('body').loadingModal();
    $('body').loadingModal('animation', 'foldingCube');
}

function closeloading() {
    $('body').loadingModal('destroy');
}

// close_loading();

function follow(url, token, person_id, organization_id, category_id, award_id, user_id) {
    user_id = user_id || "0";

    $.ajax({
        url: url,
        type: 'post',
        cache: false,
        data: {
            "_token": token,
            "person_id": person_id,
            'organization_id': organization_id,
            'award_id': award_id,
            'category_id': category_id,
            'user_id': user_id,
        },
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.success) {
                //  toastr.success(data.message);
            } else {
                // toastr.error(data.message);
            }
        },
        error: function (xhr, textStatus, thrownError) {
            toastr.error(__the_operation_failed);
        }
    });
}

function getUrlParameter(sParam) {
    const queryString = window.location.hash;
    //const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const value = urlParams.get(sParam);
    if (value == null) return '0';
    return value;
}

var getUrlParameterWithUrl = function getUrlParameterWithUrl(url, sParam) {
    var queryString = url.split('?');
    const urlParams = new URLSearchParams(queryString[1]);
    const value = urlParams.get(sParam);
    return value;
};

var getAllParameter = function getAllParameter() {
    var sParameterName = '';
    if (!window.location.hash) {
        sParameterName = 'page=1&sort=1&';
    } else {
        var url = window.location.hash.replace('#/&', '');
        var sURLVariables = url.split('&');
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sParameterName + sURLVariables[i] + '&';
        }
    }
    sParameterName = sParameterName.substr(0, sParameterName.length - 1);
    return sParameterName;
};

var getAllParameterASymbol = function getAllParameterASymbol(symbol, url) {
    var urlASymbol = url.split(symbol);
    var sPageURL = urlASymbol[1];
    var sParameterName = '';
    var sURLVariables = sPageURL.split('&');
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sParameterName + sURLVariables[i] + '&';
    }
    sParameterName = sParameterName.substr(0, sParameterName.length - 1);
    return sParameterName;
};

function replaceUrlParam(paramName, paramValue) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const value = urlParams.get(paramName);
    var url = window.location.href;
    if (value == null) {
        if (paramValue != '') {
            window.location.href = url + '&' + paramName + '=' + paramValue;
        }
    } else {
        if (paramValue != '' && paramValue != value) {
            window.location.href = url.replace(paramName + '=' + value, paramName + '=' + paramValue);
        }
    }
}

function generateChechBoxValueToUrl(div) {
    var selected = '';
    $('#' + div + ' input:checked').each(function () {
        selected += $(this).attr('data-id') + ',';
    });
    selected = selected.substr(0, selected.length - 1);
    return selected;
}


function likeComment(like, book_comment_id, url, token) {
    $.ajax({
        url: url,
        type: 'post',
        cache: false,
        data: {
            "_token": token,
            'like': like,
            'book_comment_id': book_comment_id,
        },
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.success) {
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        },
        error: function (xhr, textStatus, thrownError) {
            toastr.error(__the_operation_failed);
        }
    });
}

function likeQuotation(quotation_id, quotation_count_place, url, token) {
    $.ajax({
        url: url,
        type: 'post',
        cache: false,
        data: {
            "_token": token,
            'quotation_id': quotation_id,
        },
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.success) {
                if (quotation_count_place != '') {
                    $(quotation_count_place).text(data.like_count);
                }
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        },
        error: function (xhr, textStatus, thrownError) {
            toastr.error(__the_operation_failed);
        }
    });
}

function checkdir(body, place) {
    if (body.charAt(0).charCodeAt(0) < 200) {
        $(place).css('direction', 'ltr');
        $(place).css('text-align', 'left');
    } else {
        $(place).css('direction', 'rtl');
        $(place).css('text-align', 'right');
    }
}


function add_to_basket(token, textile_id, unit_measurement, color, type, image, title, slug, requested_amount,requested_size) {
    openLoading();
    $.ajax({
        url: config.routes.add_to_basket_url,
        type: 'post',
        cache: false,
        data: {
            "_token": token,
            'textile_id': textile_id,
            'unit_measurement': unit_measurement,
            'color': color,
            'type': type,
            'image': image,
            'title': title,
            'slug': slug,
            'requested_amount': requested_amount,
            'requested_size': requested_size,
        },
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.success) {
                refresh_basket();
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
            closeloading();
        },
        error: function (xhr, textStatus, thrownError) {
            toastr.error(__the_operation_failed);
            closeloading();
        }
    });
}

function refresh_basket(product_id, count) {
    $.ajax({
        url: config.routes.refresh_basket_url,
        type: 'get',
        cache: false,
        data: {
            "_token": config.routes.token,
        },
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (data) {

            if (data.basket_count==0) $('.header_basket').hide();
            else $('.header_basket').show();
            $('.header_basket').html(data.basket_count);
        },
        error: function (xhr, textStatus, thrownError) {
            toastr.error(__the_operation_failed);
        }
    });
}

refresh_basket();

function add_to_bookmark(url, token, textile_id) {
    openLoading();
    $.ajax({
        url: url,
        type: 'post',
        cache: false,
        data: {
            "_token": token,
            'textile_id': textile_id,
        },
        datatype: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.success) {
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
            closeloading();
        },
        error: function (xhr, textStatus, thrownError) {
            toastr.error(__the_operation_failed);
            closeloading();
        }
    });
}
