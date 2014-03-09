<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.02.14
 * Time: 08:02
 */
include 'loader.php';
$controller = new Controller();
if (isset($_GET['controller'])) {
    $controller->switch_action($_GET['controller']);
}
include 'header.php';
?>
    <div id="content" style="clear: both">
        <div class="entry registercontainer">
            <h2>Registrieren</h2>

            <form name="registerform" method="post" action="register.php?controller=register" class="register">
                <div class="field">
                    <label class="field__label" for="username">Username</label>
                    <input class="field__input" type="text" name="username" placeholder="Username"
                           id="username_inputfield" onblur="check_username()" required/>

                    <p class="usernameinfo registerinfo" id="resister-username-check"></p>
                </div>
                <div class="field">
                    <label class="field__label" for="password">Password</label>
                    <input class="field__input" type="password" name="password" placeholder="Password" required/>
                </div>
                <div class="field">
                    <label class="field__label" for="firstname">Vorname</label>
                    <input class="field__input" type="text" name="firstname" placeholder="Vorname" required/>
                </div>
                <div class="field">
                    <label class="field__label" for="familyname">Nachname</label>
                    <input class="field__input" type="text" name="familyname" placeholder="Nachname" required/>
                </div>
                <input type="submit" name="register" value="Registrieren">

                <p><?php echo $controller->error_msg; ?></p>
            </form>
        </div>
    </div>
<?php include 'footer.php';