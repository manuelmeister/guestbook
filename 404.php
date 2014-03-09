<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 03.03.14
 * Time: 15:11
 */
include 'loader.php';
include 'header.php';
header("HTTP/1.0 404 Not Found");
echo '<div id="content" style="clear: both">
        <div class="entry error">404 Seite nicht gefunden!</div>
      </div>';
include 'footer.php';