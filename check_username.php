<?php

include 'loader.php';

$controller = new Controller();
if (isset($_GET['controller'])) {
    $controller->switch_action($_GET['controller']);
}
$desired_username = $controller->clean_encode($_POST['username']);
$sql = $controller->db->prepare("SELECT * FROM user WHERE username = '$desired_username' LIMIT 1");
$sql->execute();
echo $sql->rowCount();