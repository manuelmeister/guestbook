<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 28.02.14
 * Time: 13:05
 */
include 'functions.php';
include 'header.php';
if (isset($_GET['id'])) {
    echo '<div id="content" style="clear: both">';

    $entry = $repository->getPostByID($_GET['id']);
    ob_start();
    include 'templates/single-post.php';
    $view = ob_get_clean();
    echo utf8_encode($view);

    echo '</div>';
} else {
    echo 'What?';
}
include 'footer.php';