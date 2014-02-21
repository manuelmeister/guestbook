<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.02.14
 * Time: 14:09
 */
$db = new mysqli("localhost","username","password","database");
if(!$db)
{
    exit("Verbindungsfehler: ".mysqli_connect_error());
}