<?php

/**
 * To buid neat sql commands
 *
 * @author NoonDream.som
 */
namespace Sol\Data\Dbs ;

class SqlFrame
{
    /**
     *
     * @var string
     */
    private $sql ;

    /**
     * an array like array(2,"test") that replaces ?,? in the query
     * Like SELECT * FROM users WHERE id=?   in this case execArr==array(12)
     * @var array
     */
    private $execArr ;

    /**
     *
     * @var \Sol\Data\Dbs\Db; 
     */
    private $db = NULL ;

    function __construct(){
        
    }

    /**
     * 
     * @param string $SELECT
     * @return \Sol\Db\SqlFrame makes chaining possible like $sqlFrameObj->SELECT("id")->FROM("users")->WHERE("id=?");
     */
    public function SELECT($SELECT){
        $this->sql .= ' SELECT ' . $SELECT . ' ' ;
        return $this ;
    }

    public function FROM($FROM){
        $this->sql .= ' FROM ' . $FROM . ' ' ;
        return $this ;
    }

    public function WHERE($WHERE){
        $this->sql .= ' WHERE ' . $WHERE . ' ' ;
        return $this ;
    }

    public function LIMIT($LIMIT){
        $this->sql .= ' LIMIT ' . $LIMIT . ' ' ;
        return $this ;
    }

    public function DELETE($DELETE = NULL){
        $this->sql .= ' DELETE ' . $DELETE . ' ' ;
        return $this ;
    }

    public function HAVING($HAVING){
        $this->sql .= ' HAVING ' . $HAVING . ' ' ;
        return $this ;
    }

    public function JOIN($JOIN){
        $this->sql .= ' INNER JOIN ' . $JOIN . ' ' ;
        return $this ;
    }

    public function LEFT_JOIN($JOIN){
        $this->sql .= ' LEFT JOIN ' . $JOIN . ' ' ;
        return $this ;
    }

    public function RIGHT_JOIN($JOIN){
        $this->sql .= ' RIGHT JOIN ' . $JOIN . ' ' ;
        return $this ;
    }

    public function GROUP_BY($GROUP_BY){
        $this->sql .= ' GROUP BY ' . $GROUP_BY . ' ' ;
        return $this ;
    }

    public function GROUP_CONCAT($GROUP_CONCAT){
        $this->sql .= ' GROUP_CONCAT ' . $GROUP_CONCAT . ' ' ;
        return $this ;
    }

    public function ON($ON){
        $this->sql .= ' ON ' . $ON . ' ' ;
        return $this ;
    }

    public function ORDER_BY($ORDER_BY){
        $this->sql .= ' ORDER BY ' . $ORDER_BY . ' ' ;
        return $this ;
    }

    public function INSERT_INTO($INSERT){
        $this->sql .= ' INSERT INTO ' . $INSERT . ' ' ;
        return $this ;
    }

    public function UPDATE($UPDATE){
        $this->sql .= ' UPDATE ' . $UPDATE . ' ' ;
        return $this ;
    }

    public function VALUES($VALUES){
        $this->sql .= ' VALUES ' . $VALUES . ' ' ;
        return $this ;
    }

    public function ALTER_TABLE($ALTER_TABLE){
        $this->sql .= " ALTER TABLE " . $ALTER_TABLE ;
        return $this ;
    }

    public function SET($SET){
        $this->sql .= " SET " . $SET . ' ' ;
        return $this ;
    }

    public function ADD($ADD){
        $this->sql .= " ADD " . $ADD ;
        return $this ;
    }

    public function DESCRIBE($DESCRIBE){
        $this->sql .= " DESCRIBE " . $DESCRIBE ;
        return $this ;
    }

    public function UNION($UNION){
        $this->sql .= " UNION " . $UNION ;
        return $this ;
    }

    public function UNION_ALL($UNION_ALL = NULL){
        $this->sql .= ' UNION ALL ' . $UNION_ALL . ' ' ;
        return $this ;
    }

    public function QUERY_CLEAR_SET($QUERY){
        $this->clear () ;
        $this->sql = $QUERY ;
        return $this ;
    }

    public function QUERY_ADD($QUERY){
        $this->sql .= $QUERY ;
        return $this ;
    }

    public function CROSS_JOIN($CROSSJOIN){
        $this->sql .= ' CROSS JOIN ' . $CROSSJOIN . ' ' ;
        return $this ;
    }

    public function get(){
        return $this->sql ;
    }

    public function sqlDie(){
        die ($this->get ()) ;
    }

    public function clear(){
        $this->sql = null ;
    }

    private function getDb(){
        if (is_null ($this->db)) {
            $conf = \Configs\Config::getInst () ;
            $this->db = $conf->getDefaultDb ()->getCon () ;
        }
        return $this->db ;
    }

    public function setDb(\Sol\Data\Dbs\Db $db){
        $this->db = $db ;
    }

    public function fieldPkValueInsertedGet(){
        return $this->getDb ()->lastInsertId () ;
    }

    /**
     * array(0=>array("colName"=>"colvalue"),1=>array(...))
     * @param array $execArr
     * @return object|array|boolean
     */
    public function fetchAll($execArr = NULL){
        if ( ! is_null ($execArr)) {
            $this->setExecArr ($execArr) ;
        }
        $stmt = $this->getDb ()->prepare ($this->get ()) ;
        $stmt->execute ($this->getExecArr ()) ;
        
        $recordSet = NULL ;
        while ( $record = $stmt->fetch (\PDO::FETCH_ASSOC) ) {
            $recordSet[] = $record ;
        }
        $this->clear () ;
        if (is_array ($recordSet))
            return $recordSet ;
        else
            return FALSE ;
    }

    /**
     * 
     * @param type $execArr
     * @return boolean
     */
    public function fetchRow($execArr = NULL){
        if ( ! is_null ($execArr)) {
            $this->setExecArr ($execArr) ;
        }
        $this->LIMIT ("0,1") ;
        //echo ( $this->sql . "<br/>" ) ;
        $stmt = $this->getDb ()->prepare ($this->get ()) ;
        $stmt->execute ($this->getExecArr ()) ;

        $recordSet = NULL ;
        while ( $record = $stmt->fetch (\PDO::FETCH_ASSOC) ) {
            $recordSet[] = $record ;
        }
        $this->clear () ;
        if (isset ($recordSet)) {
            if (is_array ($recordSet)) {
                if (isset ($recordSet[0])) {
                    return $recordSet[0] ;
                }
            }
        }
        else
            return FALSE ;
    }

    public function RUN($execArr = NULL){
        if ( ! is_null ($execArr)) {
            $this->setExecArr ($execArr) ;
        }
        $stmt = $this->getDb ()->prepare ($this->get ()) ;
        $stmt->execute ($this->getExecArr ()) ;
        $this->clear () ;
        return $stmt ;
    }

    /**
     * array(username,password) returns a string like username,password
     * @param array $fieldsAsking
     * @return string
     */
    public static function selectClauseMake(array $fieldsAsking = NULL){
        if ( ! is_null ($fieldsAsking))
            $selectClause = implode ("," , $fieldsAsking) ;
        else
            $selectClause = "*" ;
        return $selectClause ;
    }

    private function throwExceptionError(){
        $mySqlErrorNo = mysql_errno () ;
        $mySqlError = mysql_error () ;
        if ( ! empty ($mySqlErrorNo)) {
            $sqlStr = $this->get () ;
            throw new \Exception ("Db Engine Says: {$mySqlError} - The full query was: {$sqlStr}") ;
        }
    }

    public function insertData($tableName , $data){
        $fieldsCommaStr = implode ("," , array_keys ($data)) ;
        $valsAr = array_values ($data) ;
        $countFields = count ($data) ;

        $qMarks = str_repeat ("?," , $countFields) ;
        $qMarks = rtrim ($qMarks , ",") ;

        $query = "INSERT INTO " . $tableName . " ({$fieldsCommaStr}) VALUES ({$qMarks})" ;
//        dpe($query);
        $stmt = $this->getDb ()->prepare ($query) ;
        $stmt->execute ($valsAr) ;
        return $this->fieldPkValueInsertedGet () ;
    }

    /**
     * In conjunction with a time you have a html form of inputs in several rows
     * this function discovers and by perfix those rows and by numbers at the 
     * end it figures out to which row num it belongs
     * 
     * thisForm_colName_pkVal
     * 
     * @param string $tableName
     * @param array $formData
     * @param string $perfix
     */
    public function insertRowsOfInputs($tableName , $formData , $perfix){
        $inserts = array() ;
        foreach ($formData as $varName => $varValue) {
            $varNameSplitted = explode ($varName , "_") ;
            $suffixPossible = $varNameSplitted[count ($varNameSplitted) - 2] ;

            if ($suffixPossible == $perfix) {
                $rowNum = $varNameSplitted[count ($varNameSplitted) - 1] ;
                $columnNamesSplitted = array_pop (array_pop ($varNameSplitted)) ;
                $columnName = implode ("" , $columnNamesSplitted) ;
                $inserts[$rowNum] [$columnName] = $varValue ;
            }
        }

        foreach ($inserts as $insert) {
            $this->insertData ($tableName , $insert) ;
        }
    }

    /**
     * 
     * @param string $tableName
     * @param array $data
     * @param int $pkColVal
     * @param string $pkColName
     */
    public function updateDataByPk($tableName , $data , $pkColVal , $pkColName = NULL){
        if (is_null ($pkColName))
            $pkColName = "id_" . $tableName ;
        $fieldNamesStrForPdo = "" ;
        if ( ! empty ($data)) {
            foreach ($data as $fieldName => $fieldValue) {
                if ($fieldNamesStrForPdo == '') {
                    $fieldNamesStrForPdo = " {$fieldName}=? " ;
                }
                else {
                    $fieldNamesStrForPdo .= " , {$fieldName}=? " ;
                }
            } #foreach
        }
        $query = "UPDATE " . $tableName . " SET {$fieldNamesStrForPdo} " . " WHERE {$pkColName}=?" ;
        $exec = array_values ($data) ;
        //adding the pk column value
        $exec[] = $pkColVal ;
        $stmt = $this->getDb ()->prepare ($query) ;
        $stmt->execute ($exec) ;
    }

    public function updateByAssocs($tableName , $data){
        $fieldNamesStrForPdo = "" ;
        if ( ! empty ($data)) {
            foreach ($data as $fieldName => $fieldValue) {
                if ($fieldNamesStrForPdo == '') {
                    $fieldNamesStrForPdo = " {$fieldName}=? " ;
                }
                else {
                    $fieldNamesStrForPdo .= " , {$fieldName}=? " ;
                }
            } #foreach
        }
        $this->sql = "UPDATE " . $tableName . " SET {$fieldNamesStrForPdo} " ;
        return $this ;
    }

    public function selectRowByPk($tableName , $pkVal , $selectStmt = "*" , $pkColName = NULL){
        if (is_null ($pkColName))
            $pkColName = "id_" . $tableName ;
        $this->SELECT ($selectStmt)
                ->FROM ($tableName)
                ->WHERE ($pkColName . "=?")
        ;
        return $this->fetchRow (array($pkVal)) ;
    }

    public function selectAll($tableName , $selectStmt = "*"){
        $this->SELECT ($selectStmt)
                ->FROM ($tableName)
        ;
        return $this->fetchAll () ;
    }

    function deleteByPk($tableName , $pkColVal , $pkColName = NULL){
        if (is_null ($pkColName))
            $pkColName = "id_" . $tableName ;
        $query = "DELETE FROM " . $tableName . " WHERE {$pkColName}=?" ;
        $exec = array($pkColVal) ;
        $stmt = $this->getDb ()->prepare ($query) ;
        $stmt->execute ($exec) ;
    }

    /**
     * To create strings like SET($fieldName1 = '$fieldValue1',$fieldName2 = '$fieldValue2', ...)
     *
     * @param array $fieldNamesValues
     * @return string
     */
    public static function setClauseMake(array $fieldNamesValues){
        if (is_array ($fieldNamesValues)) {
            foreach ($fieldNamesValues as $fieldName => $fieldValue) {
                $setStr .= "{$fieldName}='{$fieldValue}'," ;
            }
            $setStr = rtrim ($setStr , ',') ;
            return $setStr ;
        }
    }

    function getExecArr(){
        return $this->execArr ;
    }

    function setExecArr($execArr){
        $this->execArr = $execArr ;
    }
}