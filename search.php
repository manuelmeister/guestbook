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
            <input type="search" name="val" placeholder="Suchbegriff"/>
            <input type="submit" name="search" value="Suchen"/>
        </form>
    </div>
<?php
if (isset($_GET['search'])) {
    $keyword = $_GET['val'];
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
include 'footer.php';