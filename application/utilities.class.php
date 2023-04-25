<?php

/*** Author: your name*
 * Date: 4/19/2022*
 * File: utilities.class.php*
 * Description: */
class Utilities
{
    //validate an email address. An valid email address appears in the format of "username@domain.domain"
    public static function checkemail($email) {
        $result = TRUE;
        if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
            $result = FALSE;
        }
        return $result;
    }
}