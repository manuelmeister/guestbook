<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 23.02.14
 * Time: 00:26
 */
include 'loader.php';
$controller = new Controller();
if (isset($_GET['controller'])) {
    $controller->switch_action($_GET['controller']);
}
include 'header.php';
?>
    <div id="content" style="clear: both">
        <div class="entry">
            <form action="index.php?controller=save" method="post" class="editform">
                <p>Zuletzt bearbeitet
                    am <?php echo $controller->clean_encode($controller->selected_entry->datepublished) ?>
                    von <?php echo $controller->clean_encode($controller->selected_entry->username) ?></p>
                <input type="hidden" name="id"
                       value="<?php echo $controller->clean_encode($controller->selected_entry->id) ?>"/>
                <input type="text" name="title"
                       value="<?php echo $controller->clean_encode($controller->selected_entry->title) ?>"
                       class="title1" placeholder="Titel"/>
                <input type="text" name="content"
                       value="<?php echo $controller->clean_encode($controller->selected_entry->content) ?>"
                       class="content" placeholder="Text"/>
                <input type="submit" name="save" value="Ändern"/>
            </form>

        </div>
    </div>
<?php
include 'footer.php';