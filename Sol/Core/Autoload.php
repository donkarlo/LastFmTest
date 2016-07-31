<?php

spl_autoload_register ("startupAutoload") ;

function startupAutoload($classPath){
    //Loading NameSpaces
    if (preg_match ('/\\\\/' , $classPath)) {
        $file = SITE_PATH . str_replace ('\\' , DIRECTORY_SEPARATOR , $classPath) . ".php" ;
    }
    require_once $file ;
}
