<?php

class User
{
    public $uid;
    public $username;
    public $e_mail;
    public $role;

public function __construct($username=null,$e_mail=null,$role=null,$uid=null)
{
        $this->username = $username;
        $this->e_mail = $e_mail;
        $this->role = $role;
        $this->uid = $uid;
}

}

?>