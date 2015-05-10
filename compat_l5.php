<?php

if(!function_exists('config_path')){
    /**
     * Return the path to config files
     * @param null $str
     * @return string
     */
    function config_path($str=null){
        return rtrim(realpath(__DIR__."/config/".$str), "/");
    }
}

if(!function_exists('public_path')){

    /**
     * Return the path to public dir
     * @param null $str
     * @return string
     */
    function public_path($str=null){
        return rtrim(realpath(__DIR__."/public/".$str), "/");
    }
}
