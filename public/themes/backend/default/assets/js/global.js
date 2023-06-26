function getPersons(name, url, token, person_id) {

    $.ajax({
        headers: {headers: {'csrftoken': token}},
        url: url,
        type: 'get',
        cache: false,
        data: ''/*{ 'userid': name}*/, //see the $_token
        datatype: 'html',
        beforeSend: function () {
            //something before send
        },
        success: function (data) {
            console.log('success');
            console.log(data);
            //success
            //var data = $.parseJSON(data);
            if (data.success == true) {
                //user_jobs div defined on page
                $('#' + person_id).html(data.html);
                $('#' + person_id).trigger("chosen:updated");
            } else {
                $('#' + person_id).html(data.html);
            }
        },
        error: function (xhr, textStatus, thrownError) {
            //alert(xhr + "\n" + textStatus + "\n" + thrownError);
            $('#' + person_id).html('');
            $('#' + person_id).trigger("chosen:updated");
        }
    });
}
//---------------------------------------------------------------------------------------------------------
function deleteCover(url, token) {

    $.ajax({
        headers: {headers: {'csrftoken': token}},
        url: url,
        type: 'get',
        cache: false,
        data: ''/*{ 'userid': name}*/, //see the $_token
        datatype: 'json',
        beforeSend: function () {
            //something before send
        },
        success: function (data) {
            console.log('success');
            console.log(data);

        },
        error: function (xhr, textStatus, thrownError) {
            //alert(xhr + "\n" + textStatus + "\n" + thrownError);
        }
    });
}
//---------------------------------------------------------------------------------------------------------
function getBooks(name, url, token, book_id) {

    $.ajax({
        headers: {headers: {'csrftoken': token}},
        url: url,
        type: 'get',
        cache: false,
        data: ''/*{ 'userid': name}*/, //see the $_token
        datatype: 'html',
        beforeSend: function () {
            //something before send
        },
        success: function (data) {
            console.log('success');
            console.log(data);
            //success
            //var data = $.parseJSON(data);
            if (data.success == true) {
                //user_jobs div defined on page
                $('#' + book_id).html(data.html);
                $('#' + book_id).trigger("chosen:updated");
            } else {
                $('#' + book_id).html(data.html);
            }
        },
        error: function (xhr, textStatus, thrownError) {
            //alert(xhr + "\n" + textStatus + "\n" + thrownError);
            $('#' + book_id).html('');
            $('#' + book_id).trigger("chosen:updated");
        }
    });
}
//-----------------------------------------------------------------------------------
function getUsers(name, url, token, user_id) {

    $.ajax({
        headers: {headers: {'csrftoken': token}},
        url: url,
        type: 'get',
        cache: false,
        data: ''/*{ 'userid': name}*/, //see the $_token
        datatype: 'html',
        beforeSend: function () {
            //something before send
        },
        success: function (data) {
            console.log('success');
            console.log(data);
            //success
            //var data = $.parseJSON(data);
            if (data.success == true) {
                //user_jobs div defined on page
                $('#' + user_id).html(data.html);
                $('#' + user_id).trigger("chosen:updated");
            } else {
                $('#' + user_id).html(data.html);
            }
        },
        error: function (xhr, textStatus, thrownError) {
            //alert(xhr + "\n" + textStatus + "\n" + thrownError);
            $('#' + user_id).html('');
            $('#' + user_id).trigger("chosen:updated");
        }
    });
}

