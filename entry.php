<?php

/**
 * Created by PhpStorm.
 * User: manuelmeister
 * Date: 17.02.14
 * Time: 14:29
 */
class entry
{
    //Attributes
    private $id;
    private $datepublished;
    private $user = "Anonymous";
    private $title;
    private $content;

    //Constructor
    function __construct($id, $timestamp, $user, $title, $content)
    {
        $this->id = $id;
        $this->datepublished = $timestamp;
        if (!empty($user)) {
            $this->user = $user;
        }
        $this->title = $title;
        $this->content = $content;
    }

    public function getHtml($entry_template)
    {
        $tools_visibility_string = 'hidden';
        if ($_SESSION['login']) {
            if ($this->user == $_SESSION['username']) {
                $tools_visibility_string = '';
            }
        }
        return utf8_encode(str_replace(array(
            '{TOOLS_VISIBILITY}',
            '{ENTRY_ID}',
            '{ENTRY_TITLE}',
            '{ENTRY_DATE}',
            '{ENTRY_USER}',
            '{ENTRY_CONTENT}'
        ), array(
            $tools_visibility_string,
            $this->id,
            $this->title,
            $this->datepublished,
            $this->user,
            $this->content
        ), $entry_template));
    }
}