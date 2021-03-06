<?php

namespace Modules\Lastfm\Models\Callers ;

use Modules\Lastfm\Models\Callers\Caller ;
use Modules\Lastfm\Models\Error ;
use Modules\Lastfm\Models\Util ;

/**
 * This class will call the remote methods of LastFm using curl.
 */
final class CurlCaller extends Caller
{
    /** 
     * A CurlCaller instance.
     *
     * @var CurlCaller
     * @access	protected
     */
    private static $instance ;

    /** 
     * A cURL handle
     *
     * @var resource
     * @access	private
     */
    private $curl ;

    /** 
     * An array of response headers.
     *
     * @var array
     * @access	private
     */
    private $headers ;

    /** 
     * Private constructor that initializes cURL.
     *
     * @access	private
     */
    private function __construct(){
        $this->curl = curl_init () ;
        curl_setopt ($this->curl , CURLOPT_RETURNTRANSFER , 1) ;
        curl_setopt ($this->curl , CURLOPT_USERAGENT , "PHP last.fm API (PHP/" . phpversion () . ")") ;
        curl_setopt ($this->curl , CURLOPT_HEADERFUNCTION , array(&$this , 'header')) ;
    }

    /** 
     * Destructor that deinitializes cURL.
     *
     * @access	public
     * @internal
     */
    public function __destruct(){
        curl_close ($this->curl) ;
    }

    /** 
     * Get a Caller instance.
     *
     * @return	Caller	A Caller instance.
     * @static
     * @access	public
     */
    public static function getInstance(){
        if ( ! is_object (self::$instance)) {
            self::$instance = new CurlCaller() ;
        }
        return self::$instance ;
    }

    /** 
     * Send a query using a specified request-method.
     * 		Query to send. (Required)
     * @param	string	$requestMethod	like 
     * @return	SimpleXMLElement		A SimpleXMLElement object.
     *
     * @access	private
     */
    protected function internalCall($params , $requestMethod = 'GET'){

        //Build request query
        $query = http_build_query ($params , '' , '&') ;
        //Set request options.
        if ($requestMethod === 'POST') {
            curl_setopt ($this->curl , CURLOPT_URL , self::API_URL) ;
            curl_setopt ($this->curl , CURLOPT_POST , 1) ;
            curl_setopt ($this->curl , CURLOPT_POSTFIELDS , $query) ;
        }
        else {
            curl_setopt ($this->curl , CURLOPT_URL , self::API_URL . '?' . $query) ;
            curl_setopt ($this->curl , CURLOPT_POST , 0) ;
        }
        //Clear response headers.
        $this->headers = array() ;
        
        $response = curl_exec ($this->curl) ;
        //Create SimpleXMLElement from response.
        //Get respnse
        /*
         * @todo sometimes returns "String could not be parsed as XML"
         * this happens when the conncetion fails. this must by throwing a proper exception.
         */
        $response = new \SimpleXMLElement ($response) ;
        //Return response or throw an error.
        if (Util::toString ($response['status']) === 'ok') {
            if ($response->children ()->{0}) {
                return $response->children ()->{0} ;
            }
        }
        else {
            throw new Error (Util::toString ($response->error) , Util::toInteger ($response->error['code'])) ;
        }
    }

    /** 
     * Header callback for cURL.
     * @param	resource	$cURL	A cURL handle.
     * @param	string		$header	A HTTP response header.
     * @access	private
     * @todo, remove -- seems unused
     */
    private function header($cURL , $header){
        $parts = explode (': ' , $header , 2) ;
        if (count ($parts) == 2) {
            list($key , $value) = $parts ;
            $this->headers[$key] = trim ($value) ;
        }
        return strlen ($header) ;
    }
}