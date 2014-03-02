<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 28.02.14
 * Time: 13:05
 */
include 'functions.php';
include 'header.php';
echo '<div id="content" style="clear: both">';
if(isset($_GET['user'])){
    $selected_username = $_GET['user'];

    //Show user
    $user_db = $db->query("SELECT * FROM user WHERE username='$selected_username' LIMIT 1");
    $u = $user_db->fetch_object();
    $user = new user($u->id,$u->username,$u->firstname,$u->familyname,$u->userjoined,$u->admin);
    $user_template = file_get_contents('templates/user.html');
    echo $user->getHtml($user_template);

    //Show entries made by user
    $rs_db = $db->query("SELECT * FROM guestbook WHERE username='$selected_username'");
    $entries = Array();
    while ($r = $rs_db->fetch_object()) {
        ${'entry_' . $r->id} = new entry($r->id, $r->datepublished, $r->username, $r->title, $r->content);
        array_push($entries, ${'entry_' . $r->id});
    }
    $entry_template = file_get_contents('templates/entry.html');
    foreach ($entries as $e) {
        echo $e->getHtml($entry_template);
    }

}
echo '</div>';
include 'footer.php';