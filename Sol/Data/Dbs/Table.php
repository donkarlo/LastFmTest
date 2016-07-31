<?php

namespace Sol\Data\Dbs ;

/**
 * Description of Table
 *
 * @author Noondreams.com <web@noondreams.com>
 */
class Table
{
    /**
     *
     * @var \Sol\Data\Dbs\Db; 
     */
    private $db = NULL ;

    /**
     *
     * @var string
     */
    private $name ;

    /**
     * columns of a table
     * @var string
     */
    private $cols = NULL ;

    /**
     * data==array('name'=>'Mohammad','lname'=>'Rahmani') ---array_keys---> array('name','lname')
     * @param array $data
     */
    public function insertData($data){
        if (is_array ($data)) {
            foreach ($data as $key => $val) {
                if ( ! $this->hasCol ($key)) {
                    var_dump($key);
                    unset($data[$key]);
                }
            }
        }
        $colsNamesCommaDelimited = implode ("," , array_keys ($data)) ;
        $valsAr = array_values ($data) ;
        $countCols = count ($data) ;

        $qMarks = str_repeat ("?," , $countCols) ; //?,?,
        $qMarks = rtrim ($qMarks , ",") ; //?,?

        $query = "INSERT INTO " . $this->getName () . " ({$colsNamesCommaDelimited}) VALUES ({$qMarks})" ;
//        dpe($query);
        $stmt = $this->getDb ()->getCon ()->prepare ($query) ;
        $stmt->execute ($valsAr) ;
        return $this->getDb ()->getCon ()->lastInsertId () ;
    }

    /**
     * 
     * @param array $data
     * @param int $pkColVal
     * @param string $pkColName
     */
    public function updateDataByPkVal($data , $pkColVal , $pkColName = NULL){
        if (is_null ($pkColName)) {
            $pkColName = "id_" . $this->getName () ;
        }

        /**
         * UPDATE users set usernam=? , password=?
         */
        $fieldNamesStr = "" ;
        if (is_array ($data)) {
            foreach ($data as $colName => $colVal) {
                if ($this->hasCol ($colName)) {
                    if ($fieldNamesStr == '') {
                        $fieldNamesStr = " {$colName}=? " ;
                    }
                    else {
                        $fieldNamesStr .= " , {$colName}=? " ;
                    }
                }
            } #foreach
        }
        $query = "UPDATE " . $this->getName () . " SET {$fieldNamesStr} " . " WHERE {$pkColName}=?" ;
        $exec = array_values ($data) ;
        //adding the pk column value
        $exec[] = $pkColVal ;
        $stmt = $this->getDb ()->getCon ()->prepare ($query) ;
        $stmt->execute ($exec) ;
    }

    public function fetchAll(){
        
    }

    public function hasCol($col){
        if (in_array ($col , $this->getCols ())) {
            return TRUE ;
        }
        return FALSE ;
    }

    public function fetchRowByColVal($colName , $value , array $askingCols = NULL){
        $sql = new \Sol\Data\Dbs\SqlFrame() ;
        $sql->SELECT ($sql->selectClauseMake ($askingCols))
                ->FROM ($this->getName ())
                ->WHERE ("{$colName}=?") ;
        return $sql->fetchRow (array($value)) ;
    }

    private function getDb(){
        if (is_null ($this->db)) {
            $conf = \Configs\Config::getInst () ;
            $this->db = $conf->getDefaultDb () ;
        }
        return $this->db ;
    }

    public function setDb(\Sol\Data\Dbs\Db $db){
        $this->db = $db ;
    }

    public function setCols($cols){
        $this->cols = $cols ;
    }

    public function getCols(){
        return $this->cols ;
    }

    public function getName(){
        return $this->name ;
    }

    public function setName($name){
        $this->name = $name ;
    }
}