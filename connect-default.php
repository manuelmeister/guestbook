<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.02.14
 * Time: 14:09
 * 
 * Needs to be renamed to connect.php and filled in with the required values
 */
$db = new mysqli("localhost","username","password","database");
if(!$db)
{
    exit("Verbindungsfehler: ".mysqli_connect_error());
}
