<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 24.02.14
 * Time: 10:31
 */

include 'loader.php';
$controller = new Controller();
if (isset($_GET['controller'])) {
    $controller->switch_action($_GET['controller']);
}
include 'header.php';
?>
    <div class="entry">
        <form action="search.php" method="get" class="searchform">
            <h3>Erweiterte Suche</h3>
            <label for="search-keyword">Suchbegriff</label>
                <input type="search" name="search-keyword" placeholder="Suchbegriff eingeben"/></br>
            <label for="search-user">User</label>
                <input type="search" name="search-user" placeholder="Benutzernamen eingeben"/>
            <input type="submit" name="search" value="Suchen"/>
        </form>
    </div>
<?php
if (isset($_GET['search'])) {
    if(isset($_GET['search-keyword']) && !empty($_GET['search-keyword'])){
        $keyword = $controller->clean_encode($_GET['search-keyword']);
        $found_entries = $controller->repository->getPostsByKeyword($keyword);
        $numbers_of_entries = count($found_entries);
        if ($numbers_of_entries) {
            echo "<div class='entry'>$numbers_of_entries Einträge für: $keyword</div>";
        }
        if ($found_entries) {
            ob_start();
            foreach ($found_entries as $entry) {
                include 'templates/search-post.php';
            }
            $view = ob_get_clean();
            echo utf8_encode($view);
        } else {
            echo "<div class='entry error'>Nichts für \"$keyword\" gefunden!</div>";
        }
    }
    if(isset($_GET['search-user']) && !empty($_GET['search-user'])){
        $keyword = $controller->clean_encode($_GET['search-user']);
        $found_users = $controller->repository->getUsersByKeyword($keyword);
        $numbers_of_users = count($found_users);
        if ($numbers_of_users) {
            echo "<div class='entry'>$numbers_of_users Benutzer für: $keyword</div>";
        }
        if ($found_users) {
            ob_start();
            foreach ($found_users as $user) {
                include 'templates/user.php';
            }
            $view = ob_get_clean();
            echo utf8_encode($view);
        } else {
            echo "<div class='entry error'>Keinen Benutzer mit \"$keyword\" gefunden!</div>";
        }
    }
}
include 'footer.php';