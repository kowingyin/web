<?php
class Database{
	private  static $hostname;
	private  static $username;
	private  static $pwd;
	private  static $db;
	private $conn;
	private $result;

	public function __construct(){
		self::$hostname = '127.0.0.1';
		self::$username = 'root';
		self::$pwd = '';
		self::$db = 'fyp';
		$this->conn = mysqli_connect(self::$hostname, self::$username, self::$pwd, self::$db)	or die(mysqli_connect_error());
		mysqli_query($this->conn,'SET NAMES UTF8');//chinese
		mysqli_query($this->conn, 'Asia/Hong_Kong	');
	}

/*
	$tableName = table name
	$colArr = table's columns name are showed, also ['*'] can show all
	$joinTableArr = the tables to be joined
	$joinColArr = (optional)
	$joinOriginalColArr = $tableName's column to be joined with $joinColArr, the position shoud be same as $joinColArr.		e.g. $joinColArr[0] == $joinOriginalColArr[0]
	$whereArr = where condition
	$groupArr = group condition
	$order
	$startRow = the starting point of the first row
	$endRow = the ending point of the last row
*/
public function sqlSelect($tableName, $colArr, $joinTableArr, $joinColArr, $joinOriginalColArr, $where, $group, $order, $startRow, $endRow){
	$colLengthOfColArr = count($colArr);	//	the length of $colArr
	$sql = 'SELECT ';
	for ($i=0; $i < $colLengthOfColArr; $i++) {
		$sql .= $colArr[$i];
		if ($colLengthOfColArr-1 != $i) {
			$sql .= ', ';
		}
	}
	$sql .= ' FROM '.$tableName.' ';

	//	if joinTable not null, it would add the joining statement appends to the end of $sql
	if (isset($joinTableArr)) {
		$joinLength = count($joinTableArr);
		for ($i=0; $i < $joinLength; $i++) {
			$sql .= '  JOIN '.$joinTableArr[$i].' ON '.$joinTableArr[$i].'.'.$joinColArr[$i].' = '.$tableName.'.'.$joinOriginalColArr[$i];
		}
	}
	// echo $sql;
	$sql .= (isset($where))?$where:'';
	$sql .= (isset($group))?$group:'';
	$sql .= (isset($order))?$order:'';
	if (!isset($startRow) && isset($endRow)) {
		$startRow = 0;
		$sql .= ' LIMIT '.$startRow.', '.$endRow;
	}
	return $sql;
}
	/*	$colArr uses the names of column to print each row, it is a string array
		$tableName is input a table name, it is a string
		$joinTable is a array consist of the tables those have to join (optional)
		$joinCol is a array includes the col name (optional)
		$joinOriginalCol is a array includes the col names those for joining
	*/
	public function printAsTable($tableName, $colArr, $joinTable, $joinCol, $joinOriginalCol){
		$return = '';
		$colLength = count($colArr);
		$return = '<table class="table table-hover">';

		//	get column names
	// 	$sql = $this->sqlSelect('INFORMATION_SCHEMA.COLUMNS', ['COLUMN_NAME'], null, null, null, 'WHERE TABLE_SCHEMA="'.self::$db.'"
    // AND TABLE_NAME="'.$tableName.'"', null, null, null, null);
	// 	echo $sql;
	// 	$this->result = mysqli_query($this->conn, $sql) or die('Mysql error');
	// 	$return .= '<tr>';
	// 	while($row = mysqli_fetch_array($this->result)){
	// 		$return .= '<th>'.$row[0].'</th>';
	// 	}
	// 	$return .= '</tr>';
		//	 end of get column names

		$return .= '<tr>';
		foreach ($colArr as $key) {
			$return .= '<td>'.$key.'</td>';
		}
		$return .= '</tr>';

		//	get table's data
		$sql = $this->sqlSelect($tableName, $colArr, $joinTable, $joinCol, $joinOriginalCol, null, null, null, null, 20);	// remove 20 when demo
		echo '<br />'.$sql;
		$this->result = mysqli_query($this->conn, $sql) or die('Mysql error');
		echo '<br />th col length = '.$colLength;
		while($row = mysqli_fetch_array($this->result)){
			$return .= '<tr>';
			$i = 0;
			while ($i < $colLength) {
				$return .= '<td>'.$row[$i].'</td>';
				++$i;
			}
			$return .= '</tr>';
		}
		//	end of get table's data
		$return .= '</table>';


		return $return;
	}

public function printAsTableShort($tableName, $colArr){
	printAsTable($tableName, $colArr, null, null, null);

}
 public function closeSqlConn(){
	 mysqli_free_result($this->result);
	 mysqli_close($this->conn);
 }

}

?>
