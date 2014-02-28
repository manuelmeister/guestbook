<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 28.02.14
 * Time: 13:05
 */
include 'functions.php';
include 'header.php';
if(isset($_GET['id'])){
    echo '<div id="content" style="clear: both">';
    $id = $_GET['id'];

    $rs = $db->query("SELECT * FROM guestbook WHERE id='$id' LIMIT 1");

    while ($r = $rs->fetch_object()) {
        $selected_entry = new entry($r->id, $r->datepublished, $r->username, $r->title, $r->content);
    }

    $entry_template = file_get_contents('templates/single-entry.html');
    echo $selected_entry->getHtml($entry_template);

    echo '</div>';
}
include 'footer.php';