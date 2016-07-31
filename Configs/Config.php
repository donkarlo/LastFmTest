<?php

namespace Configs;

class Config {

    private static $inst = NULL;

    public function config() {
        ini_set('html_errors', false);
        define('SITE_PATH', "/var/www/currentweb/BasicForBigCommerce/");

//Setting URL
        define("URL", "http://localhost/currentweb/BasicForBigCommerce/");
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

    /**
     * 
     * @return \Sol\Data\Dbs\Db
     */
    public function getDefaultDb() {
        $dbConInfo = new \Sol\Data\Dbs\DbConInfo("localhost", "test", "root", "");
        $conType = \Sol\Data\Dbs\Db::CON_TYPE_PDO;
        $db = new \Sol\Data\Dbs\Db($dbConInfo, $conType);
        return $db;
    }
}
