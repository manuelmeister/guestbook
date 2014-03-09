<?php
$output = '<div class="entry">';
if (isset($_SESSION['login'])) {
    if ($_SESSION['login']) {
        if ($entry['username'] == $_SESSION['username'] || $_SESSION['admin']) {
            $output .= "<div class='tools'>
                    <form action='edit.php?controller=edit' method='post'>
                        <input name='id' value='" . $entry['id'] . "' type='hidden'>
                        <input type='submit' name='edit' value='' class='edit'>
                    </form>
                    <form action='index.php?controller=delete' method='post'>
                        <input name='id' value='" . $entry['id'] . "' type='hidden'>
                        <input type='submit' name='delete' value='' class='delete'>
                    </form>
                </div>";
        }
    }
}
$output .= "<h3>
                    <a href='post.php?id=" . $entry['id'] . "'>" . $entry['title'] . "</a>
                </h3>
                <p class='date'>" . $entry['datepublished'] . " von <a>" . $entry['username'] . "</a></p>
                <p>" . $entry['content'] . "</p>
           </div>";
echo $output;