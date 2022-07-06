<?
class dbAccess
{
    function dbAccess() {
        if (SQL_PORT) {
            $this->dbConnect = mysql_connect(SQL_HOST . ':' . SQL_PORT, SQL_USER, SQL_PASS);
        } else {
            $this->dbConnect = mysql_connect(SQL_HOST , SQL_USER, SQL_PASS);
        }
        if ($this->dbConnect && mysql_select_db(SQL_DB_NAME)) {
        } else {
            echo "error It is not permitted.";exit;
        }
    }
    function getAll($sql) {
        $result = $this->getAssoc($sql);
        return $result;
    }
    function getAssoc($sql, $idKey = "") {
        $dbResult = $this->query($sql);
        if (isset($idKey) && $idKey != "") {
            while ($row = mysql_fetch_assoc($dbResult)) {
                $result[$row[$idKey]] = $row;
            }
        } else {
            while ($row = mysql_fetch_assoc($dbResult)) {
                $result[] = $row;
            }
        }
        if (!is_array($result)) {
            $result = false;
        }
        return $result;
    }
    function getCount($sql) {
        $dbResult = $this->query($sql);
        return mysql_num_rows($dbResult);
    }
    function query($sql) {
        $result = mysql_query($sql);
        return $result;
    }
    function getNewId() {
        return mysql_insert_id();
    }
    function escape($str) {
        return mysql_real_escape_string($str);
    }
}
?>
