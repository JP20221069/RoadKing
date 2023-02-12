<?php

include_once __DIR__."/../Classes.php";
class Permission
{
    static function checkHasRights($usr, $requiredrole)
    {
        if(Session::check("LOGGED_IN") and $usr!=null)
        {
            if($usr->role==$requiredrole)
            {
                return true;
            }
        }
        return false;
    }
}
?>