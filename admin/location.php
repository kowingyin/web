<!doctype html>
<html>
<head>
	<title>Manage location</title>
	<link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="all" href="style.css">
	<link rel="stylesheet" type="text/css" media="all" href="fancybox/jquery.fancybox.css">
	<!-- <link href="./css/tableLike.css" rel='stylesheet' /> -->
</head>
<style>

</style>
<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Category <span class="sr-only">(current)</span></a></li>
		<li><a href="#">District</a></li>
        <li><a href="#">Location</a></li>
		<li><a href="#">User Log</a></li>
		<li><a href="#">Staff Log</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
	if(!($_SESSION)) {
	    session_start();
	}
	require_once('../conn/conn.php');
	$table = new Database();
	echo $table->printAsTable('location', ['location.lid', 'location.cname', 'location.ename', 'location.photoName', 'location.description', 'location.edescription', 'category.type', 'district.name'], ['category', 'district'], ['cid', 'did'], ['cid', 'did']);
?>
<div id="inline">
	<h2>Update data</h2>

	<form id="contact" name="contact" action="#" method="post">
		<label for="primary">ID</label>
		<input width="50px" type="text" name="primary" id="primary" readonly /><br>
		<label for="cname">Chinese name</label>
		<input name="cname" id="cname" /><br>
		<label for="ename">English name</label>
		<input name="ename" id="ename" /><br>
		<label for="photoName">Photo</label><br>
		<img height="200" width="200" id="photo"/><br>
		<input type="file" name="photoName" id="photoName" accept="image/*" /><br />
		<label for="description">Chinese description</label>
		<input type="textarea" id="description" name="description"/><br>
		<label for="edescription">English description</label>
		<input type="textarea" id="edescription" name="edescription"/><br>
		<label for="category">Category</label>
		<?=$table->printAsSelectionBox('category', 'type')?>
		<br />
		<label for="district">District</label>
		<?=$table->printAsSelectionBox('district', 'name')?>
		<button id="send">Update</button>
	</form>
</div>

</body>

<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.6"></script>
<script src="js/addEditButton.js">
</script>
<script src="js/location.js">
</script>
<?php

$_SESSION['tableName'] = 'location';
//	release connection
$table->closeSqlConn();
 ?>
</html>
