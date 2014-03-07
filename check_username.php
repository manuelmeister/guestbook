<?php

include 'model/model.php';
$model = new Model();

$desired_username = $_POST['username'];
$sql = $model->getDB()->prepare("SELECT * FROM user WHERE username = '$desired_username' LIMIT 1");
$sql->execute();
echo $sql->rowCount();