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
		$return .= '<tr>';
		foreach ($colArr as $key) {
			$return .= '<td>'.$key.'</td>';
		}
		$return .= '</tr>';
		//	 end of get column names

		//	get table's data
		$sql = $this->sqlSelect($tableName, $colArr, $joinTable, $joinCol, $joinOriginalCol, null, null, null, null, 20);	// remove 20 when demo
		echo '<br />'.$sql;
		$this->result = mysqli_query($this->conn, $sql) or die('Mysql error');
		echo '<br />th col length = '.$colLength;
		while($row = mysqli_fetch_array($this->result)){
			$i = 0;
			$return .= '<tr>';

			while ($i < $colLength) {
				$return .= '<td class="td">'.$row[$i].'</td>';
				++$i;
			}
			$return .= '<td><a class="btn btn-primary modalbox" href="#inline">Edit</a></td>';
			$return .= '</div>';
	// 		<div id="wrapper">
	// <p>Send us feedback from the modal window.</p>
	//
	// <p><a class="modalbox" href="#inline">click to open</a></p>
			$return .= '</tr>';
		}
		//	end of get table's data
		$return .= '</table>';


		return $return;
	}

	public function printAsTableShort($tableName, $colArr){
		printAsTable($tableName, $colArr, null, null, null);
	}
	public function printAsSelectionBox($tableName, $col){
		$return = '';
		$primaryKey = '';

		//	start get primary key
		$sql = "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'";
		// echo $sql;
		$result = mysqli_query($this->conn, $sql);

		while($row = mysqli_fetch_array($result)){
			$primaryKey = $row['Column_name'];
		}
		//	end of getting primary key

		//	get content
		$sql = $this->sqlSelect($tableName, [$primaryKey, $col], null, null, null, null, null, null, null, null);
		$result = mysqli_query($this->conn, $sql);
		$return .= '<select id="'.$tableName.'" name="'.$tableName.'">';
		while($row = mysqli_fetch_array($result)){
			$return .= '<option value="'.$row[0].'">
			'.$row[1].'</option>';
		}
		$return .= '</select>';


		return $return;
	}
	public function closeSqlConn(){
		mysqli_free_result($this->result);
		mysqli_close($this->conn);
	}

	/** $tableName = table name
		$colArr = the cols would be updated
		$dataArr = the flow is followed by $colArr
	*/
	public function updateData($tableName, $colArr, $dataArr, $where){
		//	check is null
		if (!$tableName) {
			return 'no table name';
		}
		if (!$colArr || !$dataArr || !$where) {
			return 'no statement';
		}
		//	end of check is null

		//	building  sql, well tested
		$sql = 'UPDATE '.$tableName.' SET ';

		$colLength = count($colArr);
		for ($i=0; $i < $colLength; $i++) {
			$sql .= $colArr[$i] .' = ';
			//	check is string?
			$sql .= (!is_numeric($dataArr[$i]))?'"':'';
			$sql .= $dataArr[$i];
			$sql .= (!is_numeric($dataArr[$i]))?'"':'';
			if ($i < $colLength-1) {
				$sql .= ', ';
			}
		}
		$sql .= ($where)?' WHERE '.$where:'';
		$sql .= ';';
		// return $sql;
		//	end of building  sql


		//	start updating
		if (mysqli_query($this->conn, $sql)) {

    		$rowsAffected = mysqli_affected_rows($this->conn);

    		if ($rowsAffected == 0) {
        		echo "No changes were made";
    		} elseif ($rowsAffected == 1) {
        		echo "Successfully updated 1 row";
    		} elseif ($rowsAffected > 0) {
        		echo "Successfully updated $rowsAffected rows";
    		}

		} else {

    		echo "Error occurred: " . mysqli_error($this->conn);

		}

	}

}

?>
