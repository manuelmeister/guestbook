<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 24.02.14
 * Time: 10:31
 */

include 'functions.php';
include 'header.php';
?>
    <div class="entry">
        <form action="search.php" method="post" class="searchform">
            <input type="text" name="searchvalue" placeholder="Suchbegrif"/>
            <input type="submit" name="search" value="Suchen"/>
        </form>
    </div>
<?php
if (isset($_POST['search'])) {
    $search_value = $_POST['searchvalue'];
    $found_entries = Array();
    $db_entry = $db->query("SELECT * FROM guestbook WHERE title LIKE '%$search_value%' OR content LIKE '%$search_value%' OR username LIKE '%$search_value%'");
    while ($found_entry = $db_entry->fetch_object()) {
        ${'entry_' . $found_entry->id} = new entry($found_entry->id, $found_entry->datepublished, $found_entry->username, $found_entry->title, $found_entry->content);
        array_push($found_entries, ${'entry_' . $found_entry->id});
    }
    if($found_entries){
        $entry_template = file_get_contents('entry.html');
        foreach ($found_entries as $e) {
            echo str_replace(array(
                $search_value,ucwords($search_value),ucfirst($search_value)
            ), array(
                "<b class='marked'>$search_value</b>",'<b class="marked">'.ucwords($search_value).'</b>','<b class="marked">'.ucfirst($search_value).'</b>'
            ), $e->getHtml($entry_template));
        }
    }else{
        echo "<div class='entry error'>Nichts für \"$search_value\" gefunden!</div>";
    }
}
include 'footer.php';