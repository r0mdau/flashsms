<?php
    function autoload(){
        if ($dh = opendir(__DIR__.'/core/')) {
            while (($file = readdir($dh)) !== false) {
                if(strpos($file, '.php') !== false){
                    require_once(__DIR__.'/core/'.$file);
                }
            }
            closedir($dh);
        }
    }
    spl_autoload_register('autoload');