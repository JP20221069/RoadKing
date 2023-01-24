<?php

include_once __DIR__."/../Classes.php";
class User
{
    public $uid;
    public $username;

    public $password;
    public $e_mail;
    public Roles $role;

public function __construct($username=null,$password=null,$e_mail=null,$role=Roles::Default,$uid=null)
{
        $this->username = $username;
        $this->e_mail = $e_mail;
        $this->role = $role;
        $this->uid = $uid;
        $this->password = $password;
}

}

?>