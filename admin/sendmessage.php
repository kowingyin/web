<?php
session_start();
require_once('../conn/conn.php');
$conn = new Database();

$tableName = $_SESSION['tableName'];
$primary = $_POST['primary'];
$cname = $_POST['cname'];
$ename = $_POST['ename'];
$photoName = '';
if(!is_writable('../img/'))
  die('You cannot upload to the specified directory, please CHMOD it to 777.');
// echo 'trhe file name '.$_FILES['photoName']['name'];
if (!empty($_FILES['photoName']['name'])) {
	// check for standard uploading errors
	($_FILES['photoName']['error'] == 0) or error($errors[$_FILES['photoName']['error']], $uploadForm);
	//	get file name
	$photoName = $_FILES['photoName']['name'];
	//	store the image
	move_uploaded_file($_FILES['photoName']["tmp_name"] , '../img/'.$_FILES["photoName"]["name"]);
}
$description = $_POST['description'];
$edescription = $_POST['edescription'];
$category = $_POST['category'];
$district = $_POST['district'];

//	check is not null, then push in
$colArr = [];
$dataArr = [];
$i = 0;
function pushColAsArray(&$colArr, &$dataArr, &$i, $col, $data){
	echo $data;
	if ($data != '' || empty($data)) {
		$colArr[$i] = $col;
		$dataArr[$i] = $data;
	}else{
		return;
	}
	++$i;
}

pushColAsArray($colArr, $dataArr, $i, 'cname', $cname);
pushColAsArray($colArr, $dataArr, $i, 'ename', $ename);
pushColAsArray($colArr, $dataArr, $i, 'photoName', $photoName);
pushColAsArray($colArr, $dataArr, $i, 'description', $description);
pushColAsArray($colArr, $dataArr, $i, 'edescription', $edescription);
pushColAsArray($colArr, $dataArr, $i, 'cid', $category);
pushColAsArray($colArr, $dataArr, $i, 'did', $district);
// echo implode("|",$colArr).'<br />';
// echo implode("|", $dataArr).'<br />';
echo $conn->updateData($tableName, $colArr, $dataArr, 'lid = '.$primary);

?>
