<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 28.02.14
 * Time: 13:05
 */
include 'loader.php';
$controller = new Controller();
if (isset($_GET['controller'])) {
    $controller->switch_action($_GET['controller']);
}
include 'header.php';
echo '<div id="content" style="clear: both">';
if (isset($_GET['user'])) {
    $selected_username = $_GET['user'];

    //Show user
    $user = $controller->repository->getUserProfile($selected_username);
    ob_start();
    include 'templates/user.php';
    $view = ob_get_clean();

    //Show entries made by user
    $entries = $controller->repository->getPostsByUser($selected_username);
    ob_start();
    foreach ($entries as $entry) {
        include 'templates/user-overview-post.php';
    }
    $view .= ob_get_clean();
    echo utf8_encode($view);

}
echo '</div>';
include 'footer.php';