<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.02.14
 * Time: 08:02
 */

require("connect.php");
$error_msg = "";

if (isset($_POST["register"])) {
    $password = md5($_POST["password"]);
    $username = $_POST["username"];
    $username = trim($username);
    if (strlen($username) == 0){
        $error_msg .= "Er wurde keinen Titel eingegeben. ";
    } else {
        $sql = $db->query("INSERT INTO user (username, password) VALUES ( '$username', '$password');");
    }
}

?><!DOCTYPE html>
<html lang="de-CH">
<head>
    <title>Testsite</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
    <a href="index.php" id="logo"><h1>Guestbook</h1></a>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Registrieren</a></li>
        </ul>
    </nav>
    <div id="content" style="clear: both">
        <div class="entry registercontainer">
            <h2>Registrieren</h2>
            <form name="registerform" method="post" action="register.php">
                <div class="field">
                    <label class="field__label" for="username">Username</label>
                    <input class="field__input" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="field">
                    <label class="field__label" for="password">Password</label>
                    <input class="field__input" type="password" name="password" placeholder="Password">
                </div>
                <div class="field">
                    <label class="field__label" for="firstname">Vorname</label>
                    <input class="field__input" type="text" name="firstname" placeholder="Vorname">
                </div>
                <div class="field">
                    <label class="field__label" for="familyname">Nachname</label>
                    <input class="field__input" type="text" name="familyname" placeholder="Nachname">
                </div>
                <input type="submit" name="register" value="Registrieren">
                <p><?php
                echo $error_msg;
                    ?></p>
            </form>
        </div>
    </div>
<?php include 'footer.php';