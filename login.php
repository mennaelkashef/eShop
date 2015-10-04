<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
	    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
		  	< require('header.php');?>

<div class = "upper-wrapper">
	<section class = "login-section">
		<div class="container">
			<div class="row">
				<div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
					<div class="form-box-inner">
					<h2 class="title text-center">Login Here</h2>
						<div class="row">
							<div class="form-container col-md-7 col-md-offset-3">
								<form class='form-horizontal box' role='form' action="login_submit.php" method="post">

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
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
</body>
</html> -->
<style type="text/css">
/*body {
	display: block;
}
	.upper-wrapper {
		background: #253340 url('./images/index.jpg') no-repeat 50% top;
		background-size: cover;
		width: 100%;
		height: 100%;
		background-attachment: fixed;
		box-sizing: border-box;
	}
	.login-section {
		    padding-bottom: 200px;
    padding-top: 90px;
    padding-left: 10px;
    padding-right: 10px;
	}
	.form-box-inner {
		background: white;
		border-radius: 4px;
		background-clip: padding-box; 
		padding: 40px;

	}

	.access-section .form-box .title {
		    font-weight: 300;
    		margin-bottom: 60px;
    		margin-top: 0;
	}

	.access-section .form-group.password:before {
    content: "\f023";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    position: absolute;
    left: 10px;
    top: 12px;
    color: #999999;}*/
</style>

<html>
<head>
<title>Login</title>
</head>
<body>
<?php require('header.php'); ?>
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
	      <button type="submit" class="btn btn-block btn-cta-primary">Submit</button>
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