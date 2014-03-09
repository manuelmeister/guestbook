<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 23.02.14
 * Time: 00:26
 */
include 'functions.php';
include 'header.php';
?>
    <div id="content" style="clear: both">
        <div class="entry">
            <form action="index.php" method="post" class="editform">
                <p>Zuletzt bearbeitet am <?php echo clean_encode($selected_entry->datepublished) ?>
                    von <?php echo clean_encode($selected_entry->username) ?></p>
                <input type="hidden" name="id" value="<?php echo clean_encode($selected_entry->id) ?>"/>
                <input type="text" name="title" value="<?php echo clean_encode($selected_entry->title) ?>"
                       class="title1" placeholder="Titel"/>
                <input type="text" name="content" value="<?php echo clean_encode($selected_entry->content) ?>"
                       class="content" placeholder="Text"/>
                <input type="submit" name="save" value="Ändern"/>
            </form>

        </div>
    </div>
<?php
include 'footer.php';