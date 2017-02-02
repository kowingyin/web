<?php
	$hostname = '127.0.0.1';
	$username = 'root';
	$pwd = '';
	$db = 'fyp';

	$conn = mysqli_connect($hostname, $username, $pwd, $db)
	or die(mysqli_connect_error());
	mysqli_query($conn,'SET NAMES UTF8');//chinese
	mysqli_query($conn, 'Asia/Hong_Kong	');
?>
<?php
	/*	$colArr uses the names of column to print each row, it is a string array
		$tableName is input a table name, it is a string
		$joinTable is a array consist of the tables those have to join (optional)
		$joinCol is a array includes the col name (optional)
		$joinOriginalCol is a array includes the col names those for joining
	*/
	function printAsTable($tableName, $colArr, $joinTable, $joinCol, $joinOriginalCol){
		$return = '';
		$sql = "SELECT * FROM `".$tableName"` ";

		//	if joinTable not null, it would add the joining statement appends to the end of $sql
		if (joinTable) {
			$joinLength = count($joinTable);
			for ($i=0; $i < $joinLength; $i++) {
				$sql += 'JOIN '.$$joinTable[$i].' ON '.$joinTable[$i].'.'.$joinCol[$i].' = '.$tableName.'.'.$joinOriginalCol[$i];
			}
		}
		$result = mysqli_query($conn, $sql) or die('Mysql error');
		$return = '<table class="table table-hover">'


		while($row = mysqli_fetch_array($result)){
			$return '<tr><td>'.$row[0].'</td></tr>';
		}
		mysqli_free_result($result);
		mysqli_close($conn);

		$return += '</table>';
		return $return;
	}
?>
<?php
function printAsTable($tableName, $colArr){
	printAsTable($tableName, $colArr, null, null, null);
}
 ?>
