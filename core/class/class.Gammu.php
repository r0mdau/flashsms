<?php

class Gammu
{
    public static function send($str, $number, $flash)
    {
        $smsLength = (int)(strlen($str));
        exec('echo "' . $str . '" | sudo gammu --sendsms TEXT ' . $number . $flash . ' -autolen ' . $smsLength, $output, $res);
        return $res;
    }

    public static function infiniteSend($str, $number, $flash)
    {
        do {
            $var = self::send($str, $number, $flash);
            sleep(5);
        } while ($var != 0);
        return 0;
    }
}
