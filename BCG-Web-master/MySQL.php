<?php
/*
set_exception_handler(function($e) {
	echo json_encode(array(
		'errno' => $e->getCode(),
		'error' => $e->getMessage()
	));
});
*/
class MySQL extends mysqli {
	public function __construct($dbhost, $dbuser, $dbpass, $dbname) {
		$dbhost = trim($dbhost);
		$dbuser = trim($dbuser);
		$dbpass = trim($dbpass);
		$dbname = trim($dbname);
		@parent::__construct($dbhost, $dbuser, $dbpass);
		$this->__throw($this->connect_error, $this->connect_errno);
		@parent::set_charset("utf8");
		$this->__throw();
		if (!empty($dbname) && !@parent::select_db($dbname)) {
			@parent::query("CREATE DATABASE IF NOT EXISTS `" . $dbname . "`;");
			$this->__throw();
			@parent::select_db($dbname);
			$this->__throw();
		}
	}
	
	public function __throw($error = "", $errno = "") {
		empty($error) && $error = $this->error;
		empty($errno) && $errno = $this->errno;
		if ($errno)
			throw new Exception($error, $errno);
	}
	
	public function Create($table, array $columns, $flags = "") {
		$cols = array();
		foreach ($columns as $key => $val)
			$cols[] = "`$key` $val";
		$sql = "CREATE TABLE IF NOT EXISTS `$table` (" . implode(", ", $cols) . ") ";
		if (empty($flags))
			$flags = "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
		$sql .= $flags . ";";
		return $this->Query($sql);
	}
	
	public function Insert($table, $data = array()) {
		$cols = $vals = array();
		foreach ($data as $col => $val) {
			$cols[] = "`$col`";
			$vals[] = "'" . @parent::real_escape_string($val) . "'";
		}
		$sql = "INSERT INTO `$table` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");";
		return $this->Query($sql);
	}
	
	public function Select($table, $what = "*", $where = array()) {
		$sql = "SELECT $what FROM `$table` ";
		$clause = array();
		foreach ($where as $key => $val)
			$clause[] = "`$key` = '$val'";
		if (count($where))
			$sql .= "WHERE " . implode(' AND ', $clause);
		$sql .= ";";
		return $this->Query($sql);
	}
	
	public function Update($table, $data = array(), $where = array(), $limit = "") {
		$update = $clause = array();
		foreach ($data as $key => $val)
			$update[] = "`$key` = '$val'";
		foreach ($where as $key => $val)
			$clause[] = "`$key` = '$val'";
		$sql = "UPDATE `$table` SET " . implode(', ', $update) . " WHERE " . implode(' AND ', $clause);
		if (!empty($limit))
			$sql .= " LIMIT " . $limit;
		$sql .= ";";
		return $this->Query($sql);
	}
	
	public function Delete($table, $where = array(), $limit = "") {
		$clause = array();
		foreach ($where as $key => $val)
			$clause[] = "$key = '$val'";
		$sql = "DELETE FROM `$table` WHERE " . implode(' AND ', $clause);
		empty($limit) || $sql .= " LIMIT " . $limit;
		$sql .= ";";
		return $this->Query($sql);
	}
	
	public function Query($sql) {
		$result = @parent::real_query($sql);
		$this->__throw();
		if ($result === true)
			return @parent::store_result();
	}
	
	public function Escape($data) {
		return @parent::real_escape_string($data);
	}
}
?>