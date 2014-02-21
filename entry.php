<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 17.02.14
 * Time: 14:29
 */

class entry {

    //Attributes
    protected  $id = 0;
    public $datepublished = "1970-01-01 00:00:00";
    public $user = "Anonymous";
    public $title = "Title";
    public $content = "Testcontent";

    //Constructor
    function __construct($id,$timestamp,$user,$title,$content){
        $this->id = $id;
        $this->datepublished = $timestamp;
        $this->user = $user;
        $this->title = $title;
        $this->content = $content;
    }

    public function getHtml(){
        echo '<div class="entry">';
        if($_SESSION['login']){
            echo '<a href="index.php?action=delete&id='. $this->id .'" class="actions"><img src="img/delete-512.png" width="24px" height="24px"></a>';
        }
        echo '<h3>';
        echo $this->title;
        echo '</h3><a class="date">';
        echo $this->datepublished . " von " . $this->user;
        echo '</a><p>';
        echo $this->content;
            echo '</p></div>';

    }

    public function deleteEntry(){
        $sql = $db->query("DELETE FROM guestbook WHERE id = '$this->id'");
    }
}