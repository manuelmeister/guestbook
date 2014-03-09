<?php
/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 19.02.14
 * Time: 17:22
 */

session_start();

/**
 * Class Controller
 */
class Controller
{

    /**
     * @var PDO
     */
    public $db;

    /**
     * @var Repository
     */
    public $repository;

    /**
     * @var
     */
    public $error_msg;

    /**
     * @var object
     */
    public $selected_entry;

    /**
     *
     */
    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost; dbname=dracheburg", "dracheburg_user", "pfadi4ever");
        $this->repository = new Repository($this->db);
    }


    /**
     * @param $action
     */
    public function switch_action($action)
    {
        switch ($action) {
            case 'add':
                $this->error_msg = ($this->repository->addPost($_SESSION['username'], $_POST['title'], $_POST['entry'])) ? 'Beitrag eingefügt.' : 'Es wurde keinen Text eingegeben.';
                break;
            case 'edit':
                $this->selected_entry = $this->repository->editPost($_POST['id']);
                break;
            case 'save':
                $this->error_msg = $this->repository->updatePost($_POST['id'], utf8_decode($_POST['title']), utf8_decode($_POST['content']));
                break;
            case 'delete':
                $this->error_msg = $this->repository->deletePost($_POST['id']);
                break;
            case 'register':
                $this->error_msg = $this->repository->register($this->clean_decode($_POST['username']), md5($_POST['password']), $this->clean_decode($_POST['firstname']), $this->clean_decode($_POST['familyname']));
                break;
            case 'login':
                $this->error_msg = ($this->repository->login($_POST['username'], $_POST['password'])) ? 'Erfolgreich Eingeloggt' : 'Username oder Passwort falsch';
                break;
            case 'logout':
                if (isset($_SESSION['login'])) {
                    $_SESSION['login'] = 0;
                    $_SESSION = array();
                    session_destroy();
                }
                break;
            default:
                $this->error_msg = "";
                break;
        }
    }

    /**
     * @param $var
     * @return string
     */
    public function clean_decode(&$var)
    {
        return utf8_decode(trim($var));
    }

    /**
     * @param $var
     * @return string
     */
    public function clean_encode(&$var)
    {
        return utf8_encode($var);
    }

    /**
     * @var
     */
    protected static $troll;
}