<!doctype html>
<html>
<head>
	<title>Manage location</title>
	<link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
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
	require_once('../conn/conn.php');
	$table = new Database();
	echo $table->printAsTable('location', ['lid', 'cname', 'ename', 'photoName', 'description', 'edescription', 'category.type', 'district.name'], ['category', 'district'], ['cid', 'did'], ['cid', 'did']);
	//	release connection
	$table->closeSqlConn();
?>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="js/tableButtonListener.js">
</script>
<script src="js/location.js">
</script>
<script>
$(document).ready(function(){
	$('li').mouseenter(function(){
		$(this).addClass('active')
	})
	$('li').mouseleave(function(){
		$(this).removeClass('active')
	})
	addEditButton()
	tr2Form()
})
</script>
</html>
