<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 19.02.14
 * Time: 17:22
 */
require 'connect.php';
require 'settings.php';
include 'user.php';
include 'loader.php';

session_start();

if (isset($_POST["logout"])) {
    if (isset($_SESSION['login'])) {
        $_SESSION['login'] = 0;
        $_SESSION = array();
        session_destroy();
    }
}

$model = new Model();

$title = "";
$entry = "";
$antwort = "";
$error_msg = "";

/**
 * $db mysqli
 */
if (isset($_POST['login'])) {
    $error_msg = $model->login($_POST['username'],$_POST['password']);
}


if (isset($_POST['submit'])) {
    $error_msg = ($model->addPost($_SESSION['username'],$_POST['title'],$_POST['entry']))? 'Beitrag eingefügt.' : 'Es wurde keinen Text eingegeben.';
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

function login_field(){
    return '<form id="login" name="login" method="post" action="">
                <input class="login_field" type="text" name="username" placeholder="Benutzername">
                <input class="login_field" type="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Login">
            </form>';
}

if (isset($_POST['register'])) {
    $password = md5($_POST['password']);
    $username = clean($_POST['username']);
    $firstname = clean($_POST['firstname']);
    $familyname = clean($_POST['familyname']);

    if (strlen($username) == 0) {
        $error_msg .= 'Er wurde keinen Titel eingegeben.';
    } else {
        $sql = $db->query("INSERT INTO user (username, password, firstname, familyname) VALUES ( '$username', '$password', '$firstname', '$familyname');");
        if (!mysqli_error($db)) {
            $error_msg = 'Erfolgreich eingefügt';
        } else {
            $error_msg = mysqli_error($db);
        }
    }
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
