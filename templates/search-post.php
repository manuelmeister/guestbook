<?php
$tools_visibility_string = 'hidden';
if (isset($_SESSION['login'])) {
    if ($_SESSION['login']) {
        if ($entry['username'] == $_SESSION['username'] || $_SESSION['admin']) {
            $tools_visibility_string = '';
        }
    }
}
$output = "<div class='entry'>";
if (isset($_SESSION['login'])) {
    if ($_SESSION['login']) {
        if ($entry['username'] == $_SESSION['username'] || $_SESSION['admin']) {
            $output .= "<div class='tools'>
                    <form action='edit.php' method='post'>
                        <input name='id' value='" . $entry['id'] . "' type='hidden'>
                        <input type='submit' name='edit' value='' class='edit'>
                    </form>
                    <form action='index.php' method='post'>
                        <input name='id' value='" . $entry['id'] . "' type='hidden'>
                        <input type='submit' name='delete' value='' class='delete'>
                    </form>
                </div>";
        }
    }
}
$output .= "<h3>
                    <a href='post.php?id=" . $entry['id'] . "'>";
$output .= preg_replace('/(' . $keyword . ')/i', '<b class="marked">$1</b>', $entry['title']);
$output .= "</a>
                </h3>
                <p class='date'>" . $entry['datepublished'] . " von
                    <a href='user-overview.php?user=" . $entry['username'] . "'>";
$output .= preg_replace('/(' . $keyword . ')/i', '<b class="marked">$1</b>', $entry['username']);
$output .= '</a>
                </p>
                <p>';
$output .= preg_replace('/(' . $keyword . ')/i', '<b class="marked">$1</b>', $entry['content']);
$output .= '</p>
            </div>';
echo $output;