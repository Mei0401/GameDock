<?php
class Model {

    public $table_name = '';

    public function __construct($table = '') {
        $this->table_name = $table;
    }

    public function findAll($condition = null, $args = null, $field = '*', $limit = -1) {
        $sql = "SELECT {$field} FROM {$this->table_name}".($condition?" WHERE {$condition}":"").($limit>0?" LIMIT {$limit}":"");
        return $this->query($sql, $args);
    }

    public function find($condition, $args = null, $field = '*') {
        $ret = $this->findAll($condition, $args, $field, 1);
        if (count($ret) == 1) return $ret[0];
        return false;
    }

    public function create($kv_set) {
        if (!$kv_set || !is_array($kv_set) || count($kv_set) == 0) return false;
        $paramCount = 0;
        $key_str = '';
        $value_str = '';
        $value_arr = [];
        foreach ($kv_set as $k => $v) {
            if (!empty($key_str)) $key_str .= ', ';
            if (!empty($value_str)) $value_str .= ', ';
            $key_str .= $k;
            $value_str .= '$'.(++$paramCount);
            $value_arr[] = $v;
        }
        $sql = "INSERT INTO {$this->table_name} ({$key_str}) VALUES ({$value_str}) RETURNING *;";
        return $this->query($sql, $value_arr);
    }

    public function update($condition, $args = null, $kv_set) {
        $where_str = '';
        $set_str = '';
        $value_arr = [];
        $paramCount = $args?count($args):0;
        foreach ($kv_set as $k => $v) {
            if (!empty($set_str)) $set_str .= ', ';
            $set_str .= "{$k} = $".(++$paramCount);
            $value_arr[] = $v;
        }
        $sql = "UPDATE {$this->table_name} SET {$set_str}".($condition?" WHERE {$condition}":"")." RETURNING *";
        // echo $sql;
        return $this->query($sql, $args?array_merge($args, $value_arr):$value_arr);
    }

    public function delete($condition, $args = null) {
        if (!$condition || !$args) return false;
        $sql = "DELETE FROM {$this->table_name} WHERE {$condition}";
        return $this->execute($sql, $args);
    }

    public function query($sql, $args = null) {
        if (!$sql || !$GLOBALS['dbconn']) return false;
        $ret = [];
        if (!$args) {
            $res = pg_query($GLOBALS['dbconn'], $sql);
        }
        else {
            $stmt = pg_prepare($GLOBALS['dbconn'], "", $sql);
            $res = pg_execute($GLOBALS['dbconn'], "", $args);
        if (!$res) return false;
        if (pg_num_rows($res) > 0) {
            $ret = pg_fetch_all($res);
            }
        }
        return $ret;
    }

    public function execute($sql, $args = null) {
        if (!$sql || !$GLOBALS['dbconn']) return false;
        $res = null;
        if (!$args) {
            $res = pg_query($GLOBALS['dbconn'], $sql);
        }
        else {
            $stmt = pg_prepare($GLOBALS['dbconn'], "", $sql);
            $res = pg_execute($GLOBALS['dbconn'], "", $args);
        if (!$res) return false;
            return @pg_affected_rows($res);
        }
    }
}
?>