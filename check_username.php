<?php

include 'functions.php';


$desired_username = $_POST['username'];
$sql = $db->prepare("SELECT * FROM user WHERE username = '$desired_username' LIMIT 1");
$sql->execute();
echo $sql->rowCount();