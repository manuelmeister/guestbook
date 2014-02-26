function check_username() {
    var username = $('#username_inputfield').val();
    if (username != "") {
        $.ajax({
            method: 'POST',
            url: "check_username.php",
            data: {'username': username},
            success: function (username_exists) {
                if(username_exists){
                    $('.usernameinfo').text("Diesen Benutzernamen gibt es bereits!");
                }else{
                    $('.usernameinfo').text("");
                }
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