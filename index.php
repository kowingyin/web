<?php //this is a testing file
	require_once("/conn/conn.php");
	$sql = 'Select * From category';
	$rs = mysqli_query($conn,$sql);
	while($rc = mysqli_fetch_assoc($rs)){
		echo $rc['cid'];
		echo $rc['type']. '<br>';
	}
	
	printAsTable2('category','*');
	
?>