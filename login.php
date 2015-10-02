<html>
<head>
<title>Login</title>
</head>
<body>
<?php 	require('header.php'); ?>
<div class="container">
<h2>Login Here</h2>

<div class="form-box col-md-8 col-sm-12 col-xs-12 ">
<form class='form-horizontal' role='form' action="login_submit.php" method="post">

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
      <button type="submit" class="btn btn-block btn-cta-primary">Submit</button>
    </div>
  </div>
</div>
</div>
</form>
</body>
</html>

<style type="text/css">
	.btn-block {
		display: block;
		width: 100%;
	}

	.form-box {
		margin: 0 auto;
		border: 1px solid black;
	}

	.
</style>