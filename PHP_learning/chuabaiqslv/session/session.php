<?php
class Session
{
    // set session
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // get session

    public static function get($key)
    {
        return $_SESSION[$key];
    }

    // remove session
    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    // destroy session

    public static function destroy()
    {
        session_destroy();
    }

    // check session

    public static function check($key)
    {
        return isset($_SESSION[$key]);
    }
}
