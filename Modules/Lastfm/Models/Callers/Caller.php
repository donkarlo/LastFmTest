<?php
namespace Modules\Lastfm\Models\Callers;
use Modules\Lastfm\Models\Util;

/**
 * The parent clas to all callers to provide them with shared properties and methods.
 */
abstract class Caller {
    /** 
     * Last.fm API key
     *
     * @var string
     * @access	protected
     */
    protected $apiKey;

    /** 
     * Last.fm API secret
     *
     * @var string
     * @access	protected
     */
    protected $apiSecret;

    /** 
     * Last.fm API base URL
     *
     * @var string
     * @access	public
     */
    const API_URL = 'http://ws.audioscrobbler.com/2.0/';

    /** 
     * Send a query using a specified request-method.
     * @param	string	$requestMethod	Request-method for calling (defaults to 'GET'). (Optional)
     * @return	\SimpleXMLElement		A SimpleXMLElement object.
     *
     * @access	protected
     */
    protected abstract function internalCall($params, $requestMethod = 'GET');

    /** 
     * Get a Caller instance.
     *
     * @return	Caller	A Caller instance.
     * @static
     * @access	public
     */
    public static function getInstance() {
        
    }

    /** 
     * Call an API method.
     *
     * @param	string	$method			API method to call. (Required)
     * @param	array	$params			Request parameters to send. (Optional)
     * @param	string	$requestMethod	Request-method for calling (defaults to 'GET'). (Optional)
     * @return	SimpleXMLElement		A SimpleXMLElement object.
     *
     * @access	public
     */
    public function call($method, array $params = array(), $requestMethod = 'GET') {
        /* Set call parameters */
        $callParams = array(
            'method' => $method,
            'api_key' => $this->apiKey
        );
        /* Add call parameters to other request parameters */
        $params = array_merge($callParams, $params);
        $params = Util::toUTF8($params);
        /* Call API */
        return $this->internalCall($params, $requestMethod);
    }

    /** 
     * Set the last.fm API key to be used.
     *
     * @param	string	$apiKey	A last.fm API key. (Required)
     * @access	public
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    /** 
     * Get the last.fm API key which is used.
     *
     * @return	string	A last.fm API key.
     * @access	public
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /** 
     * Set the last.fm API secret to be used.
     *
     * @param	string	$apiSecret	A last.fm API secret. (Required)
     * @access	public
     */
    public function setApiSecret($apiSecret) {
        $this->apiSecret = $apiSecret;
    }

    /** 
     * Get the last.fm API secret which is used.
     *
     * @return	string	A last.fm API secret.
     * @access	public
     */
    public function getApiSecret() {
        return $this->apiSecret;
    }
}