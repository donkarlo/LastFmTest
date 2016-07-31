<?php

namespace Configs;

class Config {

    private static $inst = NULL;

    public function config() {
        ini_set('html_errors', false);
        //Setting the path - @todo change to yours - win users separate with backslash and two backslashes at the end
        define('SITE_PATH', "/var/www/currentweb/BasicForBigCommerce/");
        //Setting URL - @todo change to yours
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
