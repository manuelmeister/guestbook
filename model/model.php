<?php
class Model {

    private $db = null;

    public function __construct(){
        if($this->db == null){
            $this->db = new PDO("mysql:host=localhost; dbname=dracheburg", "dracheburg_user", "pfadi4ever");
        }
    }

    public function getPosts($first_post,$number_of_posts){
        $sql = $this->db->prepare("SELECT * FROM guestbook ORDER BY datepublished DESC LIMIT :first_post,:number_of_posts ");
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

    public function addPost($username,$title,$content){
        $title = utf8_decode(trim($title));
        if (strlen($title) == 0) {
            return false;
        }
        $content = utf8_decode(trim($content));
        if (strlen($content) == 0) {
            return false;
        } else {
            $sql = $this->db->prepare("INSERT INTO guestbook (username, title, content) VALUES ( '$username', '$title', '$content');");
            $sql->execute();
            return true;
        }
    }

    /**
     * @param $username
     * @param $password
     * @return bool|string
     */
    public function login($username,$password){
        $username = htmlentities($username);
        $password = md5($password);

        $sql = $this->db->prepare("SELECT username, password, admin FROM user WHERE username='$username' LIMIT 1");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $user = $sql->fetch(PDO::FETCH_OBJ);

            if ($user->password == $password) {
                $_SESSION['login'] = 1;
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = $user->admin;
                return false;
            } else {
                $_SESSION['login'] = false;
                return 'Falsches Passwort.';
            }
        } else {
            $_SESSION['login'] = false;
            return 'Falscher Benutzername oder falsches Passwort.';
        }
    }

}