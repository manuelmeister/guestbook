<?php

/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 17.02.14
 * Time: 14:29
 */
class user
{
    //Attributes
    private $id;
    private $username;
    private $firstname = "";
    private $familyname = "";
    private $userjoined;
    private $admin;

    //Constructor
    function __construct($id, $username, $firstname, $familyname, $userjoined, $admin)
    {
        $this->id = $id;
        $this->username = $username;
        if (!empty($firstname)) {
            $this->firstname = $firstname;
        }
        if (!empty($familyname)) {
            $this->familyname = $familyname;
        }
        $this->userjoined = $userjoined;
        $this->admin = $admin;
    }

    public function getHtml($user_template)
    {
        return utf8_encode(str_replace(array(
            '{USER_ID}',
            '{USER_USERNAME}',
            '{USER_FIRSTNAME}',
            '{USER_FAMILYNAME}',
            '{USER_JOINED}',
        ), array(
            $this->id,
            $this->username,
            $this->firstname,
            $this->familyname,
            $this->userjoined
        ), $user_template));
    }
}