<?php

namespace Sol\Data\Dbs ;

class Db
{
    const CON_TYPE_PDO = 0 ;
    const CON_TYPE_MYSQLI = 1 ;
    const CON_TYPE_MYSQL = 2 ;

    /**
     * con stands for co nnection
     * @var int
     */
    private $conType ;

    /**
     * contains user, pass or whatever info needed to connbet to db server
     * @var \Data\Db\DbConInfo 
     */
    private $dbConInfo ;
    private $con = NULL ;

    public function __construct(\Sol\Data\Dbs\DbConInfo $dbConInfo , $conType = self::CON_TYPE_PDO){
        $this->setConType ($conType) ;
        $this->setDbConInfo ($dbConInfo) ;
    }

    public function getCon(){
        if ($this->getConType () === self::CON_TYPE_PDO) {
            if (is_null ($this->con)) {
                $this->con = new \PDO ("mysql:host=" . "{$this->getDbConInfo ()->getServer ()}" . ";dbname="
                        . "{$this->getDbConInfo ()->getName ()}" . ";charset=utf8"
                        , "{$this->getDbConInfo ()->getUsername ()}"
                        , "{$this->getDbConInfo ()->getPassword ()}"
                        , array(\PDO::ATTR_PERSISTENT => true)) ;
                $this->con->setAttribute (\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION) ;
            }
        }
        elseif ($this->getConType () === self::CON_TYPE_MYSQLI) {
            //do mysqli driver conection 
        }
        return $this->con ;
    }

    private function getConType(){
        return $this->conType ;
    }

    private function getDbConInfo(){
        return $this->dbConInfo ;
    }

    private function setConType($conType){
        $this->conType = $conType ;
    }

    private function setDbConInfo(\Sol\Data\Dbs\DbConInfo $dbConInfo){
        $this->dbConInfo = $dbConInfo ;
    }
}