<?php
session_start();
require_once('../conn/conn.php');
$conn = new Database();

$tableName = $_SESSION['tableName'];
$primary = $_POST['primary'];
$cname = $_POST['cname'];
$ename = $_POST['ename'];
$photoName;
if ($_FILES['photoName']) {
	// check for standard uploading errors
	($_FILES['photoName']['error'] == 0) or error($errors[$_FILES['photoName']['error']], $uploadForm);
	//	get file name
	$photoName = $_POST['photoName']['tmp_name'];
	//	store the image
	move_uploaded_file($_FILES['photoName']["tmp_name"] , '../img/'.$_FILES["photoName"]["name"]);
}
$description = $_POST['description'];
$edescription = $_POST['edescription'];
$category = $_POST['category'];
$district = $_POST['district'];

// if ($tableName == null ||
// 	$primary == null ||
// 	$cname == null ||
// 	$ename == null) {
// 	echo 'false';
// }
echo $tableName.'<br />';
echo $conn->updateData($tableName, ['cname', 'ename', 'photoName', 'description', 'edescription', 'cid', 'did'], [$cname, $ename, $photoName, $description, $edescription, (int)$category, (int)$district], 'lid = '.$primary);

?>
