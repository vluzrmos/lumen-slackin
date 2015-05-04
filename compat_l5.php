<?php

if(!function_exists('config_path')){
    function config_path($str=null){
        return rtrim(realpath(__DIR__."/config/".$str), "/");
    }
}
