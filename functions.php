<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 19.02.14
 * Time: 17:22
 */
require "connect.php";
include "entry.php";

if (isset($_POST["logout"])) {
    if (session_status() == PHP_SESSION_ACTIVE) {
        $_SESSION = array();
        session_destroy();
    }
    $_SESSION['login'] = 0;
} else {
    if (session_id() == "") {
        session_start();
    }
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

    $result = $db->query("SELECT username, password, admin FROM user WHERE username='$username' LIMIT 1");
    if ($result->num_rows > 0) {
        $user = $result->fetch_object();

        if ($user->password == $password) {
            $_SESSION["login"] = 1;
            $_SESSION["username"] = $username;
            $_SESSION["admin"] = $user->admin;
        } else {
            $error_msg = "Falsches Passwort.";
            $_SESSION["login"] = false;
        }
    } else {
        $error_msg = "Falscher Benutzername oder falsches Passwort.";
        $_SESSION["login"] = false;
    }
}


if (isset($_POST["Submit"])) {
    $_SESSION['login'] = 1;
    $username = $_SESSION["username"];
    $title = utf8_decode(trim($_POST["title"]));
    if (strlen($title) == 0 || $title == "Titel") {
        $error_msg .= "Er wurde keinen Titel eingegeben. ";
    }
    $entry = utf8_decode(trim($_POST["entry"]));
    if (strlen($entry) == 0 || $entry == "Text") {
        $error_msg .= "Er wurde keinen Text eingegeben. ";
    } else {
        $error_msg = "";

        $sql = $db->query("INSERT INTO guestbook (username, title, content) VALUES ( '$username', '$title', '$entry');");
        $name = "";
        $title = "";
        $entry = "";
    }
}

if (isset($_POST['edit'])) {
    $_SESSION['login'] = 1;
    $id = $_POST['id'];
    $db_entry = $db->query("SELECT datepublished, username, title, content FROM guestbook WHERE id='$id'");
    $selected_entry = $db_entry->fetch_object();
    $selected_user = utf8_encode($selected_entry->username);
    $selected_last_edit = utf8_encode($selected_entry->datepublished);
    $selected_title = utf8_encode($selected_entry->title);
    $selected_content = utf8_encode($selected_entry->content);
}

if (isset($_POST['save'])) {
    $_SESSION['login'] = 1;
    $selected_id = $_POST['id'];
    $selected_title = utf8_decode($_POST['title']);
    $selected_content = utf8_decode($_POST['content']);
    $db_entry = $db->query("UPDATE guestbook SET title = '$selected_title', content = '$selected_content' WHERE id='$selected_id'");
}

if (isset($_POST['delete'])) {
    $_SESSION['login'] = 1;
    $id = $_POST['id'];
    $db->query("DELETE FROM guestbook WHERE id='$id'");
}

function clean(&$var)
{
    return utf8_decode(trim($var));
}

if (isset($_POST["register"])) {
    $password = md5($_POST["password"]);
    $username = clean($_POST["username"]);
    $firstname = clean($_POST["firstname"]);
    $familyname = clean($_POST["familyname"]);

    if (strlen($username) == 0) {
        $error_msg .= "Er wurde keinen Titel eingegeben. ";
    } else {
        $sql = $db->query("INSERT INTO user (username, password, firstname, name) VALUES ( '$username', '$password', '$firstname', '$familyname');");
        if (!mysqli_error($db)) {
            $error_msg = 'Erfolgreich eingefügt';
        } else {
            $error_msg = mysqli_error($db);
        }
    }
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
}