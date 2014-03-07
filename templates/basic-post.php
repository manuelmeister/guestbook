<?php
$tools_visibility_string = 'hidden';
if (isset($_SESSION['login'])) {
    if ($_SESSION['login']) {
        if ($entry['username'] == $_SESSION['username'] || $_SESSION['admin']) {
            $tools_visibility_string = '';
        }
    }
}
echo "<div class='entry'>
    <div class='tools $tools_visibility_string'>
        <form action='edit.php' method='post'>
            <input name='id' value='".$entry['id']."' type='hidden'>
            <input type='submit' name='edit' value='' class='edit'>
        </form>
        <form action='index.php' method='post'>
            <input name='id' value='".$entry['id']."' type='hidden'>
            <input type='submit' name='delete' value='' class='delete'>
        </form>
    </div>
    <h3><a href='post.php?id=".$entry['id']."'>".$entry['title']."</a></h3>
    <p class='date'>".$entry['datepublished']." von <a href='user-overview.php?user=".$entry['username']."'>".$entry['username']."</a></p>

    <p>".$entry['content']."</p>
</div>";