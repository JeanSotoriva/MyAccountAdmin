<?php

namespace App\Helpers;

class SeederHelper
{
    private static $userCpf;

    public static function setUserCpf($userCpf)
    {
        self::$userCpf = $userCpf;
    }

    public static function getUserCpf()
    {
        return self::$userCpf;
    }
}