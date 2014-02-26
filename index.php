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
                <input type="text" name="title" placeholder="Titel"/>
                <input type="text" name="entry" placeholder="Text"/>
                <input type="submit" name="submit" value="Senden"/>
            </form>
        </div>';

        }
        if ($error_msg != "") {
            echo '<div class="entry error">' . $error_msg . '</div>';
        }

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
        }else{
            $current_page = 0;
        }

        $first_entry = $current_page * $ENTRY_SHOWN_PER_PAGE;

        $num_rs_db = $db->query("SELECT id FROM guestbook");
        $number_rows = $num_rs_db->num_rows;

        $stmt = $db->prepare("SELECT * FROM guestbook ORDER BY datepublished DESC LIMIT ?,? ");
        $stmt->bind_param('ss', $first_entry, $ENTRY_SHOWN_PER_PAGE);
        $stmt->execute();
        $rs = $stmt->get_result();

        $displayed_rows = $rs->num_rows;

        $last_page = ($number_rows - ($number_rows % $ENTRY_SHOWN_PER_PAGE)) / $ENTRY_SHOWN_PER_PAGE;

        if ($current_page == 0) {
            $prev_page = 0;
        } else {
            $prev_page = $current_page - 1;
        }

        if ($current_page == $last_page) {
            $next_page = $current_page;
        } else {
            $next_page = $current_page + 1;
        }

        $entries = Array();

        while ($r = $rs->fetch_object()) {
            ${'entry_' . $r->id} = new entry($r->id, $r->datepublished, $r->username, $r->title, $r->content);
            array_push($entries, ${'entry_' . $r->id});
        }

        $entry_template = file_get_contents('entry.html');
        foreach ($entries as $e) {
            echo $e->getHtml($entry_template);
        }

        echo "<div class='entry-nav'>
            <nav>
                <ul>
                    <div>
                        <li><a href='index.php?page=0'>Erste Seite</a></li>
                        <li><a href='index.php?page=$prev_page'><img src='img/arrow-left-512.png' width='20px' height='20px' style='float: left;margin-right: 5px'>Vorherige Seite</a></li>
                    </div>
                    <div class='left-entry-nav'>
                        <li><a href='index.php?page=$next_page'>Nächste Seite<img src='img/arrow-right-512.png' width='20px' height='20px' style='float: right;margin-left: 5px'></a></li>
                        <li><a href='index.php?page=$last_page'>Letzte Seite</a></li>
                    </div>
                </ul>
            </nav>
        </div>";

        ?>

    </div>
<?php include('footer.php'); ?>