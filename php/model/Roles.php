<?php

enum Roles:int
{
    case Administrator=10;
    case User = 11;
    case Default = -1;

    public static function FromNumber($number)
    {
        switch($number)
        {
            case 10:
                return Roles::Administrator;
                break;
            case 11:
                return Roles::User;
                break;
            case -1:
                return Roles::Default;
                break;
        }
    }
}

?>