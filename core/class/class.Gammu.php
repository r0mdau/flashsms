<?php
    class Gammu{
        public static function send($str, $number, $flash){
            exec('echo "'.$str.'" | gammu --sendsms TEXT '.$number.$flash, $output, $res);
            return $res;
        }
        
        public static function infiniteSend($str, $number, $flash){
            do{
                $var = self::send($str, $number, $flash);
            }while($var != 0);
            return 0;
        }
    }