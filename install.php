<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 23.02.14
 * Time: 22:18
 */

require 'connect.php';

session_start();
$_SESSION['login'] = 0;

include 'header.php';

$install = $db->query("CREATE TABLE guestbook (
id INT(6) NOT NULL AUTO_INCREMENT,
datepublished TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
username CHAR(20) DEFAULT NULL,
title CHAR(42) DEFAULT NULL,
content TEXT(140) DEFAULT NULL,
PRIMARY KEY (id)
) ENGINE = INNODB DEFAULT CHARSET = utf8;");
if(!$install){
    exit('<div class="entry error">Datenbankfehler: '.mysqli_connect_error().' und Fehlernummer:'.mysqli_errno($db).'</div>');
}

$install = $db->query("CREATE TABLE user (
id INT(6) NOT NULL AUTO_INCREMENT,
username CHAR(20) DEFAULT NULL,
password CHAR(32) DEFAULT NULL,
firstname TEXT(140) DEFAULT NULL,
familyname TEXT(140) DEFAULT NULL,
datejoined TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
admin BOOLEAN NOT NULL,
PRIMARY KEY (id)
) ENGINE = INNODB DEFAULT CHARSET = utf8;");
if(!$install)
{
    exit('<div class="entry error">Datenbankfehler: '.mysqli_connect_error().' und Fehlernummer:'.mysqli_errno($db).'</div>');
}else{
    echo '<div class="entry">Keinen Fehler gefunden! Alles Prima und gut installiert.</div>';
}

include 'footer.php';