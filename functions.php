<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 19.02.14
 * Time: 17:22
 */
include "connect.php";
include "entry.php";

if (isset($_POST["logout"])) {
    if (session_status() == PHP_SESSION_ACTIVE) {
        $_SESSION = array();
        session_destroy();
    }
    $_SESSION['login'] = 0;
} else {
    session_start();
    $_SESSION['login'] = 0;
}

$title = "";
$entry = "";
$antwort = "";
$error_msg = "";
/**
 * $db mysqli
 */
if (isset($_POST["login"])) {
    $username = $db->real_escape_string($_POST["username"]);

    $password = md5($_POST["password"]);

    $result = $db->query("SELECT username, password FROM users WHERE username='$username' LIMIT 1");
    if($result->num_rows > 0){
        $user = $result->fetch_object();

        if ($user->password == $password) {
            $_SESSION["login"] = 1;
            $_SESSION["username"] = $username;
        } else {
            $error_msg = "Falsches Passwort.";
            $_SESSION["login"] = false;
        }}else{
        $error_msg = "Falscher Benutzername oder falsches Passwort.";
        $_SESSION["login"] = false;
    }
}


if (isset($_POST["Submit"])) {
    $_SESSION['login'] = 1;
    $username = $_SESSION["username"];
    $title = trim($_POST["title"]);
    if (strlen($title) == 0 || $title == "Titel"){
        $error_msg .= "Er wurde keinen Titel eingegeben. ";
    }
    $entry = trim($_POST["entry"]);
    if (strlen($entry) == 0 || $entry == "Text"){
        $error_msg .= "Er wurde keinen Text eingegeben. ";
    } else {
        $error_msg = "";
        $sql = $db->query("INSERT INTO guestbook (username, title, content) VALUES ( '$username', '$title', '$entry');");
        $name = "";
        $title = "";
        $entry = "";
    }
}

if (isset($_GET["action"]) && $_GET["action"] == 'delete') {
    $_SESSION['login'] = 1;
    $id = $_GET['id'];
    $db->query("DELETE FROM guestbook where id='$id'");
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
}