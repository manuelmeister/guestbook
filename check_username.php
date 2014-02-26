<?php

include 'connect.php';

$desired_username = $_POST['username'];
$stmt = $db->query("SELECT * FROM user WHERE username = '$desired_username' LIMIT 1");
echo $stmt->num_rows;