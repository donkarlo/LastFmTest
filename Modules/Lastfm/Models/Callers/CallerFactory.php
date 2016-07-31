<?php

namespace Modules\Lastfm\Models\Callers ;

use Modules\Lastfm\Models\Callers\CurlCaller ;

/**
 * This class is rersponsible to create callers. 
 * 
 * We might use curl or sockets ... to call the remote function on lastFm Api. Here is the place were 
 * we access those callers(in case we have created multiple of them).
 * 
 * @todo add more callers. 
 */
class CallerFactory
{
    /** 
     * A default caller class.
     *
     * @var string
     */
    private static $default = 'CurlCaller' ;

    /** 
     * Get a {@link CurlCaller} instance.
     *
     * @return	CurlCaller	CurlCaller instance.
     */
    public static function getCurlCaller(){
        return CurlCaller::getInstance () ;
    }

    public static function getDefaultCaller(){

        //return self::$default::getInstance();
        $function = 'get' . self::$default ;
        return self::$function () ;
    }
}