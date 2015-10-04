<html>
<head>
<title>Login</title>
</head>
<body>
<?php 	require('header.php'); ?>
<div class="container">
<div class="row">
<div class=" col-md-6 col-md-offset-3">

	<form class='form-horizontal box' role='form' action="login_submit.php" method="post">
	<h2>Login Here</h2>

		<div class="form-group">
		    <div class="col-md-10">
		      <input type="email" class="form-control" name="username" id="username" placeholder="Enter email">
		    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-md-10"> 
	      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
	    </div>
	  </div>
	  <div class="form-group"> 
	    <div class="col-md-10">
	      <button type="submit" class="btn-submit btn btn-block btn-cta-primary">Submit</button>
	    </div>
	  </div>
	  	</form>
	</div>
	</div>
</div>
</body>
</html>

<style type="text/css">
	.container {
		width: 100%;
	}

	form {
		display: block;
	}
	form.box {
    border: 0px solid #e9e9e9;
    margin: 0 28px;
    padding: 50px 55px;
	}


</style>