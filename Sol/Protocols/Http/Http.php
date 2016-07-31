<?php

namespace Sol\Protocols\Http ;

/**
 * Is responsible for everything about Http protocol
 */
class Http
{
    public function redirect($url){
        header ("Location:" . $url) ;
        exit ;
    }
}