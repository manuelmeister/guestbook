<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.02.14
 * Time: 08:02
 */
include 'functions.php';
include 'header.php';
?>
    <div id="content" style="clear: both">
        <div class="entry registercontainer">
            <h2>Registrieren</h2>

            <form name="registerform" method="post" action="register.php">
                <div class="field">
                    <label class="field__label" for="username">Username</label>
                    <input class="field__input" type="text" name="username" placeholder="Username"
                           id="username_inputfield" onblur="check_username()" required/>
                </div>
                <div class="field">
                    <label class="field__label" for="password">Password</label>
                    <input class="field__input" type="password" name="password" placeholder="Password"/>
                </div>
                <div class="field">
                    <label class="field__label" for="firstname">Vorname</label>
                    <input class="field__input" type="text" name="firstname" placeholder="Vorname"/>
                </div>
                <div class="field">
                    <label class="field__label" for="familyname">Nachname</label>
                    <input class="field__input" type="text" name="familyname" placeholder="Nachname"/>
                </div>
                <input type="submit" name="register" value="Registrieren">

                <p><?php echo $error_msg; ?></p>
            </form>
        </div>
    </div>
<?php include 'footer.php';