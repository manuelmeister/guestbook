<?php

include 'connect.php';

$desired_username = $_POST['username'];
$check_desired_username = $db->prepare("SELECT * FROM user WHERE username = '?'");
$check_desired_username->bind_param('s', $desired_username);
$check_desired_username->execute();
echo json_encode($data);