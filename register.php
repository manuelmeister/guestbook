<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.02.14
 * Time: 08:02
 */

require_once 'library/recaptchalib.php';
require 'loader.php';

$controller = new Controller();
if (isset($_GET['controller'])) {
    $controller->switch_action($_GET['controller']);
}
include 'header.php';
?>
    <div id="content" style="clear: both">
        <div class="entry registercontainer">
            <h2>Registrieren</h2>
            <script type="text/javascript">
                var RecaptchaOptions = {
                    theme : 'custom',
                    custom_theme_widget: 'recaptcha_widget'
                };
            </script>
            <form name="registerform" method="post" action="register.php?controller=register" class="register">
                                <div id="recaptcha_widget" style="display:none">

                                    <div id="recaptcha_image"></div>
                                    <div class="recaptcha_only_if_incorrect_sol" style="color:red">Falsch, probiere noch einmal.</div>

                                    <span class="recaptcha_only_if_image">Gib die Wörter ein:</span>
                                    <span class="recaptcha_only_if_audio">Gib die Nummern ein:</span>

                                    <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />

                                    <div><a href="javascript:Recaptcha.reload()">Neues Captcha</a></div>
                                    <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Audio Captcha</a></div>
                                    <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Bild Captcha</a></div>

                                    <div><a href="javascript:Recaptcha.showhelp()">Help</a></div>

                                </div>

                                <script type="text/javascript"
                                        src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $controller->publickey;?>">
                                </script>
                                <noscript>
                                    <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $controller->publickey;?>"
                                            height="300" width="500" frameborder="0"></iframe><br>
                                    <textarea name="recaptcha_challenge_field" rows="3" cols="40">
                                    </textarea>
                                    <input type="hidden" name="recaptcha_response_field"
                                           value="manual_challenge">
                                </noscript>
                <div class="field">
                    <label class="field__label" for="username">Username</label>
                    <input class="field__input" type="text" name="username" placeholder="Username"
                           id="username_inputfield" onblur="check_username()" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" required/>

                    <p class="usernameinfo registerinfo" id="resister-username-check"></p>
                </div>
                <div class="field">
                    <label class="field__label" for="password">Password</label>
                    <input class="field__input" type="password" name="password" placeholder="Password" required/>
                </div>
                <div class="field">
                    <label class="field__label" for="email">E-mail</label>
                    <input class="field__input" type="email" name="email" placeholder="E-mail" required/>
                </div>
                <div class="field">
                    <label class="field__label" for="firstname">Vorname</label>
                    <input class="field__input" type="text" name="firstname" placeholder="Vorname" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];}?>" />
                </div>
                <div class="field">
                    <label class="field__label" for="familyname">Nachname</label>
                    <input class="field__input" type="text" name="familyname" placeholder="Nachname" value="<?php if(isset($_POST['familyname'])){echo $_POST['familyname'];}?>" />
                </div>
                <input type="submit" name="register" value="Registrieren" id="register-submit">

                <p><?php echo $controller->error_msg; ?></p>
            </form>
        </div>
    </div>
<?php include 'footer.php';