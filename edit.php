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
        <form action="index.php" method="post">
            <input type="text" name="title" value="''"/>
            <input type="text" name="content" value="''"/>
            <input type="submit" name="edit" value="Ändern"/>
        </form>

        </div>
    </div>
<?php
include 'footer.php';