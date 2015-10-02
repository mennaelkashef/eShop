<?php
 	require('header.php');

/*** begin our session ***/

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>
<html>
<head>
<title>Login</title>
</head>
<body>
<div class="container">
<div class="row">
<div class=" col-md-6 col-md-offset-3">

	<form class='form-horizontal box' id="register_form"role='form' action="adduser_submit.php" method="post" enctype="multipart/form-data">
	<h2>Register</h2>
		<div class="form-group">
		    <div class="col-md-10">
		      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
		    </div>
	  	</div>
	  	<div class="form-group">
		    <div class="col-md-10">
		      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
		    </div>
	   </div>
		<div class="form-group">
		    <div class="col-md-10">
		      <input type="email" class="form-control" name="username" id="username" placeholder="Email">
		    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-md-10"> 
	      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
	    </div>
	  </div>

	  <div class="form-group"> 
	    <div class="col-md-10">
			<label for="image">Choose Profile Picture</label>
			<input type="file" name="image" id="image">
		</div>
	</div>

	<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
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
<!-- <html>
<head>
<title>Register</title>
</head>

<body>
<h2>Add user</h2>
<form action="adduser_submit.php" method="post" enctype="multipart/form-data">
<fieldset>
<p>
<label for="firstname">First Name</label>
<input type="text" id="firstname" name="firstname" value="" maxlength="20" />
</p>
<p>
<label for="lastname">Last Name</label>
<input type="text" id="lastname" name="lastname" value="" maxlength="20" />
</p>
<p>
<label for="username">Email</label>
<input type="text" id="username" name="username" value="" maxlength="20" />
</p>
<p>
<label for="password">Password</label>
<input type="text" id="password" name="password" value="" maxlength="20" />
</p>
<p>

<label for="image">Choose Profile Picture</label>
<input type="file" name="image" id="image">
</p>
<p>
<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
<input type="submit" value="&rarr; Sign Up" />
</p>
</fieldset>
</form>
</body>
</html> -->