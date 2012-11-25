<?php
// Connects to the MySQL Database
require_once($_SERVER['DOCUMENT_ROOT'].'/dbSetup.php');

abstract class AbstractBaseDAO {
    public abstract function getTableName();
    
    private function cleanSetValue($value) {
        if(isset($value)) {
            return "'".mysql_real_escape_string($value)."'";
        } else {
            return "NULL";
        }
    }
    
    private function cleanWhereValue($value) {
        if(isset($value)) {
            return " = ". mysql_real_escape_string($value);
        } else {
            return " IS NULL";
        }
    }
    
    protected function update(array $params, $id) {
        $assignRaw = "";
        foreach($params as $key=>$value) {
            if($key == ("id")) {continue;}
            $assignRaw .= ",{$key}=";
            $assignRaw .= $this->cleanSetValue($value);
        }
        $assign=  substr($assignRaw, 1);
        $primaryId = $this->getTableName() . "ID";
        $sql = "UPDATE ".$this->getTableName() ." SET $assign WHERE $primaryId=$id";
        return static::executeSql($sql);
    }


    protected function insert(array $params) {
        $colsRaw = "";
        $valsRaw = "";
        foreach($params as $key=>$value) {
            if(!isset($key) OR $key == ("id")) {continue;}
            $colsRaw .= ",{$key}";
            $valsRaw .= ", " . $this->cleanSetValue($value);
        }
        $cols = substr($colsRaw, 1);
        $vals = substr($valsRaw, 1);
        $sql = "INSERT INTO ".$this->getTableName()."({$cols}) VALUES ({$vals})";
        return static::executeSql($sql);
    }
    
    /**
     * 
     * @param array $params
     * @return array Rows of associative arrays, one per row.
     */
    protected function select(array $params) {
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE ";
        $extra = "";
        foreach($params as $key => $val) {
            $extra .= " AND " . mysql_real_escape_string($key);
            $extra .= $this->cleanWhereValue($val);
        }
        $sql .= substr($extra, 5);
        return static::executeSql($sql);
    }
    
    /**
     * Actually performs the SQL on the database.  SQL is performed as-is.
     * @param String $sql The SQL that will be executed on the database.  MUST be cleaned first.
     * @return array Array of rows, each row being an associative array.
     */
    private static function executeSql($sql) {
        $result = mysql_query($sql);
//        echo $sql; self::showWarnings() . '<br/>';
        $ret = array();
        
        if(!$result) { return $ret; }

        if($result === true OR $result === false) {
            return $result;
        }
        while($row = mysql_fetch_assoc($result)) {
            array_push($ret, $row);
        }
        return $ret;
    }
    
    public static function showWarnings() {
        $warningDetailResult = mysql_query("SHOW WARNINGS");
        if ($warningDetailResult ) {
            while ($warning = mysql_fetch_assoc($warningDetailResult)) {
                echo var_dump($warning);
            }
        }
    }
}