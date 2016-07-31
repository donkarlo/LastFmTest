<?php

namespace Configs;

class Config {

    private static $inst = NULL;

    public function config() {
        ini_set('html_errors', false);
        //Setting the path, windows users can usse both / and \ 
        define('SITE_PATH', "/var/www/currentweb/BasicForBigCommerce/");
        //Setting URL
        define("URL", "http://localhost/currentweb/BasicForBigCommerce/");
        //Setting the domain
        define("DOMAIN", "localhost");
    }

    /**
     * Singletone pattern
     * @return \Configs\Config
     */
    public static function getInst() {
        if (is_null(self::$inst)) {
            self::$inst = new self();
        }
        return self::$inst;
    }
}
