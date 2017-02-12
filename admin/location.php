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
	require_once('../conn/conn.php');
	$table = new Database();
	echo $table->printAsTable('location', ['location.lid', 'location.cname', 'location.ename', 'location.photoName', 'location.description', 'location.edescription', 'category.type', 'district.name'], ['category', 'district'], ['cid', 'did'], ['cid', 'did']);
?>
<div id="inline">
	<h2>Update data</h2>

	<form id="contact" name="contact" action="#" method="post">
		<label for="email">Your E-mail</label>
		<input type="email" id="email" name="email" class="txt">
		<br>
		<label for="msg">Enter a Message</label>
		<textarea id="msg" name="msg" class="txtarea"></textarea>
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
<script src="js/addEditButton.js">
</script>
<script src="js/location.js">
</script>
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.6"></script>
<!-- basic fancybox setup -->
<script type="text/javascript">
$(document).ready(function() {
	$(".modalbox").fancybox();
	$("#contact").submit(function() { return false; });


	$("#send").on("click", function(){
		var emailval  = $("#email").val();
		var msgval    = $("#msg").val();
		var msglen    = msgval.length;
		var mailvalid = validateEmail(emailval);

		if(mailvalid == false) {
			$("#email").addClass("error");
		}
		else if(mailvalid == true){
			$("#email").removeClass("error");
		}

		if(msglen < 4) {
			$("#msg").addClass("error");
		}
		else if(msglen >= 4){
			$("#msg").removeClass("error");
		}

		if(mailvalid == true && msglen >= 4) {
			// if both validate we attempt to send the e-mail
			// first we hide the submit btn so the user doesnt click twice
			$("#send").replaceWith("<em>sending...</em>");

			$.ajax({
				type: 'POST',
				url: 'sendmessage.php',
				data: $("#contact").serialize(),
				success: function(data) {
					if(data == "true") {
						$("#contact").fadeOut("fast", function(){
							$(this).before("<p><strong>Success! :)</strong></p>");
							setTimeout("$.fancybox.close()", 1000);
						});
					}
				}
			});
		}
	});
});
</script>
<?php
//	release connection
$table->closeSqlConn();
 ?>
</html>
