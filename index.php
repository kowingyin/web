<!doctype html>
<html>
<head>
	<title>Staff Phoning Centre</title>
	<link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>

</style>
<body>
	<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">

      <a class="brand" href="#">Project Name</a>
      <div class="nav-collapse ">
        <ul class="nav pull-right">
          <li class="dropdown" id="menuLogin">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login</a>
            <div class="dropdown-menu" style="padding:17px;">
              <form class="form" id="formLogin">
                <input name="username" id="username" type="text" placeholder="Username">
                <input name="password" id="password" type="password" placeholder="Password"><br>
                <button type="button" id="btnLogin" class="btn">Login</button>
              </form>
            </div>
          </li>
        </ul>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="./js/login.js"></script>
</html>
<?php //this is a testing file
	// require_once("/conn/conn.php");
	// $sql = 'Select * From category';
	// $rs = mysqli_query($conn,$sql);
	// while($rc = mysqli_fetch_assoc($rs)){
	// 	echo $rc['cid'];
	// 	echo $rc['type']. '<br>';
	// }
	//
	// printAsTable2('category','*');
	//
?>
