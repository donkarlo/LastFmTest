<?php

namespace Modules\Lastfm\Models\Callers;

use Modules\Lastfm\Models\Callers\CurlCaller;

/**
 * This class is rersponsible to to create callers. 
 * We might use curl or sockets ... to call the remot function on lastFm Api. Here is the place were 
 * we access those callers(in case we have created multiple of them).
 */
class CallerFactory {

    /** A default {@link Caller} class.
     *
     * @var string
     * @access	private
     */
    private static $default = 'CurlCaller';

    /** Get a {@link CurlCaller} instance.
     *
     * @return	CurlCaller	A {@link CurlCaller} instance.
     * @static
     * @access	public
     */
    public static function getCurlCaller() {
        return CurlCaller::getInstance();
    }

    public static function getDefaultCaller() {
        /*
          return self::$default::getInstance();
         */
        $function = 'get' . self::$default;
        return self::$function();
    }

}
