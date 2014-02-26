function check_username() {
    var username = $('#username_inputfield').val();
    if (username != "") {
        $.ajax({
            method: 'POST',
            url: "check_username.php",
            dataType: 'json',
            data: {'username': username},
            success: function (data) {
                console.log(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus);
            }
        })
    }
}

$(document).ready(function () {
    $('#username_inputfield').on('blur', check_username());
})