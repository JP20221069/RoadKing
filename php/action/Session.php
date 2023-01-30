<?php
class Session
{
    public static $started=false;
    public static function init()
    {
        session_start();
        self::$started = true;
    }
    public static function tryinit()
    {
        if(!self::$started)
        {
            self::init();
        }
    }
    public static function end()
    {
        session_unset();
        session_destroy();
        self::$started = false;
    }

    public static function set_current($key,$value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get_current($key)
    {
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        else
        {
            return null;
        }
    }

    public static function try_get($key)
    {
        $chk = self::check($key);
        if($chk)
        {
            return self::get_current($key);
        }
        else
        {
            return null;
        }
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }
    public static function check($key)
    {
        if(isset($_SESSION[$key]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }
}