<?php
class Model {

    private $db = null;

    public function __construct(){
        if($this->db == null){
            $this->db = new PDO("mysql:host=localhost; dbname=dracheburg", "dracheburg_user", "pfadi4ever");
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

    /**
     * @return INT
     */
    public function getNumbersOfPosts(){
        $sql = $this->db->prepare("SELECT COUNT(*) FROM guestbook");
        $sql->execute();
        return $sql->fetch(PDO::FETCH_NUM)[0];
    }

}