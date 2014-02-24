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
include 'footer.php';