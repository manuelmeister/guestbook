/**
 * User: manuelmeister
 * Date: 12.02.14
 * Time: 15:13
 */
function inputField(form){
    var empt = document.forms[form]["username"].value;
    if (empt == "")
    {
        alert("Please input a Value");
        document.forms[form]["username"].addClass("red");
        return false;
    }
    else
    {
        alert('Code has accepted : you can try another');
        document.forms[form]["username"].removeClass("red");
        return true;
    }
}
