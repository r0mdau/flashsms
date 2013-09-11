<?php
    class Bootstrap{
        public static function init(&$db, &$err, &$typehead){
            $db = new r0mdauDb(_DIR_Database_);
            $err = new Error();
            form($err);
            $typehead['directory'] = directory();
            $typehead['lists'] = lists();
            $typehead['send'] = receiver();
        }
    }