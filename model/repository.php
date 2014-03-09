<?php

/**
 * Class Repository
 */
class Repository
{

    /**
     * @var PDO
     */
    private $db;

    /**
     * Construct
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return PDO
     */
    public function getDB()
    {
        return $this->db;
    }

    /**
     * @param $offset
     * @param $limit
     * @return array
     */
    public function getPosts($limit, $offset)
    {
        $sql = $this->db->prepare("SELECT * FROM guestbook ORDER BY datepublished DESC LIMIT :first_post,:number_of_posts ");
        $sql->bindParam('first_post', $offset, PDO::PARAM_INT);
        $sql->bindParam('number_of_posts', $limit, PDO::PARAM_INT);
        $sql->execute();

        $entries = array();

        while ($post = $sql->fetch()) {
            array_push($entries, $post);
        }

        return $entries;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostByID($id)
    {
        $sql = $this->db->prepare("SELECT datepublished, username, title, content FROM guestbook WHERE id='$id'");
        $sql->execute();
        return $sql->fetch();
    }

    /**
     * @param $username
     * @return array
     */
    public function getPostsByUser($username)
    {
        $sql = $this->db->prepare("SELECT * FROM guestbook WHERE username='$username' ORDER BY datepublished DESC");
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
    public function getNumbersOfPosts()
    {
        $sql = $this->db->prepare("SELECT COUNT(*) FROM guestbook");
        $sql->execute();
        return $sql->fetch(PDO::FETCH_NUM)[0];
    }

    /**
     * @param $username
     * @param $title
     * @param $content
     * @return bool
     */
    public function addPost($username, $title, $content)
    {
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
     * @param $selected_id
     * @param $selected_title
     * @param $selected_content
     * @return bool
     */
    public function updatePost($selected_id, $selected_title, $selected_content)
    {
        $sql = $this->db->prepare("UPDATE guestbook SET title = '$selected_title', content = '$selected_content' WHERE id='$selected_id'");
        $sql->execute();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePost($id)
    {
        $sql = $this->db->prepare("DELETE FROM guestbook WHERE id='$id'");
        $sql->execute();
        return true;
    }

    /**
     * @param $username
     * @internal param $first_post
     * @internal param $number_of_posts
     * @return array
     */
    public function getUserProfile($username)
    {
        $sql = $this->db->prepare("SELECT * FROM user WHERE username='$username' LIMIT 1 ");
        $sql->execute();
        return $sql->fetch();
    }

    /**
     * @param $username
     * @param $password
     * @return bool|string
     */
    public function login($username, $password)
    {
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
                return true;
            } else {
                $_SESSION['login'] = false;
                return false;
            }
        } else {
            $_SESSION['login'] = false;
            return false;
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $firstname
     * @param $familyname
     * @return string
     */
    public function register($username, $password, $firstname, $familyname)
    {
        if (strlen($username) == 0) {
            return 'Er wurde keinen Username eingegeben.';
        }else{
            $sql = $this->db->prepare("SELECT * FROM user WHERE username = '$username' LIMIT 1");
            $sql->execute();
            if($sql->rowCount()){
                return 'Benutzername ist nicht verfügbar.';
            }else{
                $sql = $this->db->prepare("INSERT INTO user (username, password, firstname, familyname) VALUES ( '$username', '$password', '$firstname', '$familyname');");
                $sql->execute();
                return 'Benutzername wurde erfolgreich hinzugefügt.';
            }
        }
    }

    /**
     * @param $keyword
     * @return array
     */
    public function getPostsByKeyword($keyword)
    {
        $sql = $this->db->prepare("SELECT * FROM guestbook WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%' ORDER BY datepublished");
        $sql->execute();
        $found_entries = array();
        while ($found_post = $sql->fetch()) {
            array_push($found_entries, $found_post);
        }
        return $found_entries;
    }

    /**
     * @param $keyword
     * @return array
     */
    public function getUsersByKeyword($keyword)
    {
        $sql = $this->db->prepare("SELECT * FROM user WHERE username ='$keyword'");
        $sql->execute();
        $found_users = array();
        while ($found_user = $sql->fetch()) {
            array_push($found_users, $found_user);
        }
        return $found_users;
    }
}