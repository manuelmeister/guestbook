function check_username() {
    var username = $('#username_inputfield').val();
    if (username != "") {
        $.ajax({
            method: 'POST',
            url: "check_username.php",
            data: {'username': username},
            success: function (username_exists) {
                console.log(username_exists);
                if(username_exists == 1){
                    $('#resister-username-check').text("Diesen Benutzernamen gibt es bereits!");
                }else{
                    $('#resister-username-check').text("");
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
    $('#errordiv').delay(1000).fadeOut('slow');
})
