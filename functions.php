<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 19.02.14
 * Time: 17:22
 */

require 'settings.php';
include 'loader.php';

session_start();

if (isset($_POST["logout"])) {
    if (isset($_SESSION['login'])) {
        $_SESSION['login'] = 0;
        $_SESSION = array();
        session_destroy();
    }
}

$db = new PDO("mysql:host=localhost; dbname=dracheburg", "dracheburg_user", "pfadi4ever");

$repository = new Repository($db);

$error_msg = "";

if (isset($_POST['login'])) {
    $error_msg = ($repository->login($_POST['username'], $_POST['password'])) ? 'Erfolgreich Eingeloggt' : 'Username oder Passwort falsch';
}

if (isset($_POST['submit'])) {
    $error_msg = ($repository->addPost($_SESSION['username'], $_POST['title'], $_POST['entry'])) ? 'Beitrag eingefügt.' : 'Es wurde keinen Text eingegeben.';
}

if (isset($_POST['edit'])) {
    $selected_entry = $repository->editPost($_POST['id']);
}

if (isset($_POST['save'])) {
    $repository->updatePost($_POST['id'], utf8_decode($_POST['title']), utf8_decode($_POST['content']));
}

if (isset($_POST['delete'])) {
    $repository->deletePost($_POST['id']);
}

function clean_decode(&$var)
{
    return utf8_decode(trim($var));
}

function clean_encode(&$var)
{
    return utf8_encode($var);
}

if (isset($_POST['register'])) {
    $repository->register(clean_decode($_POST['username']), md5($_POST['password']), clean_decode($_POST['firstname']), clean_decode($_POST['familyname']));
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
