<?php
class Model {

    private $db = null;

    public function __construct(){
        if($this->db == null){
            $this->db = new PDO("mysql:host=localhost, dbname=guestbook;", "dracheburg_user","pass");
        }
    }

    public function getPosts($first_post,$number_of_posts){
        $sql = $this->db->prepare("SELECT * FROM guestbook LIMIT :first_post,:number_of_posts");
        $sql->bindParam('first_post',$first_post,PDO::PARAM_INT);
        $sql->bindParam('number_of_posts',$number_of_posts,PDO::PARAM_INT);
        $sql->execute();

        $entries = array();

        while ($post = $sql->fetch()) {
            array_push($entries, $post);
        }

        return $entries;
    }

}