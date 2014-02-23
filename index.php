<?php

include 'functions.php';
include 'header.php';
?>
    <div id="content" style="clear: both">
        <?php

        if ($_SESSION["login"]) {
            echo '<div id="add">
            <h2>Beitragen</h2>
            <form method="post" action="index.php" id="form">
                <input type="text" name="title" placeholder="Titel">
                <input type="text" name="entry" placeholder="Text" id="textarea">
                <input type="submit" name="Submit" value="Senden">
            </form>
        </div>';

        }
        if($error_msg != ""){
            echo '<div class="entry error">'.$error_msg.'</div>';
        }

        $rs = $db->query("SELECT * FROM guestbook ORDER BY datepublished DESC");
        $totalRows_rs = $rs->num_rows;

        $entries = Array();

        while ($r = $rs->fetch_object()){
            ${'entry_' . $r->id} = new entry($r->id,$r->datepublished,$r->username,$r->title,$r->content);
            array_push($entries,${'entry_' . $r->id});
        }

        $entry_template = file_get_contents('entry.html');
        foreach($entries as $e){
            echo $e->getHtml($entry_template);
        }

        ?>
    </div>
<?php include('footer.php'); ?>