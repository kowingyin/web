<?php
class connection{
	private  static $hostname;
	private  static $username;
	private  static $pwd;
	private  static $db;
	private $conn;

	public function __construct(){

		$hostname = '127.0.0.1';
		$username = 'root';
		$pwd = '';
		$db = 'fyp';
		$this->conn = mysqli_connect($hostname, $username, $pwd, $db)	or die(mysqli_connect_error());
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
		$sql .= 'LIMIT '.$startRow.', '.$endRow;
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
		$sql = $this->sqlSelect($tableName, $colArr, $joinTable, $joinCol, $joinOriginalCol, null, null, null, null, null);
		echo $sql.'<br />';
		$result = mysqli_query($this->conn, $sql) or die('Mysql error');

		$return = '<table class="table table-hover">';

		while($row = mysqli_fetch_array($result)){
			$return .= '<tr><td>'.$row[0].'</td></tr>';
		}
		$return .= '</table>';

		$this->closeSqlConn($result);
		return $return;
	}
public function printAsTableShort($tableName, $colArr){
	printAsTable($tableName, $colArr, null, null, null);

}
 public function closeSqlConn($result){
	 mysqli_free_result($result);
	 mysqli_close($this->conn);
 }

}

?>
