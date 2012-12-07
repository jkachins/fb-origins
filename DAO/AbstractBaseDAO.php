<?php
// Connects to the MySQL Database
require_once($_SERVER['DOCUMENT_ROOT'].'/dbSetup.php');

abstract class AbstractBaseDAO {
    /**
     * Returns the name of the table to use for SQL statements.
     * @return String name of the table.
     */
    public abstract function getTableName();
    
    /**
     * Makes a type MySQL Clean.  <code>null</code> will return the string NULL
     * @param type $value
     * @return string
     */
    private function cleanSetValue($value) {
        if(isset($value)) {
            return "'".mysql_real_escape_string($value)."'";
        } else {
            return "NULL";
        }
    }
    
    /**
     * Makes a type MySQL Clean.  <code>null</code> will return the string IS NULL
     * @param type $value
     * @return string
     */
    private function cleanWhereValue($value) {
        if(isset($value)) {
            if(is_array($value)) {
                return " IN ( " . implode(',', $value) . " )";
            } else {
                return  " = " . mysql_real_escape_string($value);;
            }
        } else {
            return " IS NULL";
        }
    }
    
    /**
     * Creates and executes a SQL Update Statement. Uses params to determine the
     * columns to update and values. The column "ID" will be stripped out.
     * @param array $params associative array, Key is the Column, value is the Value.
     * @param type $id The Table ID to uniquely identify the row.
     * @return type
     */
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

    /**
     * Creates and executes a SQL INSERT Statement. Uses params to determine the
     * columns to set and  there values. The column "ID" will be stripped out.
     * @param array $params associative array, Key is the Column, value is the Value.
     * @return type
     */
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
        static::executeSql($sql);
        return mysql_insert_id();
    }
    
    /**
     * Executes a SQL Select statement.  Only does equality checks.
     * @param array $params associative array, Key is the Column, value is the Value.
     * @return array of associative arrays.  Each assoc array is a row.
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
     * This needs to really be fixed, but doing a join seems like it will complicate things
     */
    protected function performJoin($sql) {
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

    /**
     * Uses for debugging.  Prints out SQL warnings from last query
     */
    public static function showWarnings() {
        $warningDetailResult = mysql_query("SHOW WARNINGS");
        if ($warningDetailResult ) {
            while ($warning = mysql_fetch_assoc($warningDetailResult)) {
                echo var_dump($warning);
            }
        }
    }
}