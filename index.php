<?php
include 'functions.php';
include 'header.php';
?>
    <div id="content" style="clear: both">
        <?php
        if (isset($_SESSION['login'])) {
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
        }

        if ($error_msg != "") {
            echo '<div id="errordiv" class="entry">' . $error_msg . '</div>';
        }

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
        } else {
            $current_page = 0;
        }

        $model = new Model();

        $first_entry = $current_page * $ENTRY_SHOWN_PER_PAGE;

        $number_rows = $model->getNumbersOfPosts();
        $last_page = ($number_rows - ($number_rows % $ENTRY_SHOWN_PER_PAGE)) / $ENTRY_SHOWN_PER_PAGE;

        if($current_page > $last_page){
            header("HTTP/1.0 404 Not Found");
            echo '<p class="entry error">Fehler 404: Seite nicht Gefunden!</p>';
        }else{
            $stmt = $db->prepare("SELECT * FROM guestbook ORDER BY datepublished DESC LIMIT ?,? ");
            $stmt->bind_param('ss', $first_entry, $ENTRY_SHOWN_PER_PAGE);
            $stmt->execute();
            $rs = $stmt->get_result();

            $displayed_rows = $rs->num_rows;


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

            $entries = $model->getPosts($first_entry,$ENTRY_SHOWN_PER_PAGE);

            ob_start();
            foreach ($entries as $entry) {
                include 'templates/basic-post.php';
            }
            $view = ob_get_clean();

            echo utf8_encode($view);


            function page_request($current_page, $i)
            {
                return ($i == $current_page ? "<li class='current-page'><a href='index.php?page=$i'>$i</a></li>" : "<li><a href='index.php?page=$i'>$i</a></li>");
            }

            function getPagesNav($current_page, $last_page)
            {
                $page_items_shown = 5;
                $output = '<div class="page-nav">';
                if ($last_page > $page_items_shown) {
                    $i = 0;
                    $j1 = $j2 = $current_page - ($page_items_shown-1)/2;
                    $k1 = $k2 = $current_page + ($page_items_shown-1)/2;
                    if($j1 > 1){
                        $output .= "<li><a href='index.php?page=0'>0</a></li>";
                        $output .= "<li><a>...</a></li>";
                    }elseif($j1 == 1){
                        $output .= "<li><a href='index.php?page=0'>0</a></li>";
                    }
                    while ($i < $page_items_shown) {
                        if ($j2 < 0) {
                            $j2++;
                            $k2++;
                        } elseif ($k2 > $last_page) {
                            $k2--;
                            $j2--;
                        } else {
                            $output .= page_request($current_page, $j2);
                            $j2++;
                            $i++;
                        }
                    }
                    if($k1 < $last_page-1){
                        $output .= "<li><a>...</a></li>";
                        $output .= "<li><a href='index.php?page=$last_page'>$last_page</a></li>";
                    }elseif($k1 == $last_page-1){
                        $output .= "<li><a href='index.php?page=$last_page'>$last_page</a></li>";
                    }
                } else {
                    for ($i = 0; $i < $last_page; $i++) {
                        $output .= page_request($current_page, $i);
                    }
                }
                $output .= '</div>';
                return $output;
            }

            echo "<div class='entry-nav'>
            <nav>
                    <div>
                        <li><a href='index.php?page=0'><img src='img/first-512.png' width='20px' height='20px' style='float: left;margin-right: 5px'>Erste Seite</a></li>
                        <li><a href='index.php?page=$prev_page'><img src='img/arrow-left-512.png' width='20px' height='20px' style='float: left;margin-right: 5px'>Vorherige Seite</a></li>
                    </div>";
            echo getPagesNav($current_page, $last_page);
            echo "      <div class='left-entry-nav'>
                        <li><a href='index.php?page=$next_page'>Nächste Seite<img src='img/arrow-right-512.png' width='20px' height='20px' style='float: right;margin-left: 5px'></a></li>
                        <li><a href='index.php?page=$last_page'>Letzte Seite<img src='img/last-512.png' width='20px' height='20px' style='float: right;margin-left: 5px'></a></li>
                    </div>
            </nav>
        </div>";
        }



        ?>

    </div>
<?php include('footer.php'); ?>