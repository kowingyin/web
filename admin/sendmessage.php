<?php
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
// $sendto   = "youremail@youremail.com";
// $usermail = $_POST['email'];
// $content  = nl2br($_POST['msg']);
//
// $subject  = "New Feedback Message";
// $headers  = "From: " . strip_tags($usermail) . "\r\n";
// $headers .= "Reply-To: ". strip_tags($usermail) . "\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
//
// $msg  = "<html><body style='font-family:Arial,sans-serif;'>";
// $msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>New User Feedback</h2>\r\n";
// $msg .= "<p><strong>Sent by:</strong> ".$usermail."</p>\r\n";
// $msg .= "<p><strong>Message:</strong> ".$content."</p>\r\n";
// $msg .= "</body></html>";
//
//
// if(@mail($sendto, $subject, $msg, $headers)) {
// 	echo "true";
// } else {
// 	echo "false";
// }

?>
