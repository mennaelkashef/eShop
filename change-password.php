<!-- <html>
<head>
	<title>Change Password</title>
</head>
<body>
<h1>Change Password</h1>
<form action="" method="post">
<fieldset>
<p>
<label for="oldpassword">Old Password</label>
<input type="text" id="oldpassword" name="oldpassword" value="" maxlength="20" />
</p>
<p>
<label for="password">New Password</label>
<input type="text" id="password" name="password" value="" maxlength="20" />
</p>
<p>
<label for="password2">Confirm Password</label>
<input type="text" id="password2" name="password2" value="" maxlength="20" />
</p>

<p>
<input type="submit" value="&rarr; Submit" />

</p>
<a href="/eShop/index.php"> Back to HomePage</a> -->
<!-- </fieldset>
</form>
</body>
</html> -->
<?php session_start();
 require 'header.php'; ?>
<?php 
	if ($_POST) {
		$username = 'root';
		mysql_connect('localhost', $username); 
		mysql_select_db('eShop_db');
		if (isset($_SESSION['user_id'])) {

		$user = $_SESSION['user_id'];
		$query = "SELECT * FROM `users` WHERE username='$user'";
		$result = mysql_query($query) or die(mysql_error());
		$user = mysql_fetch_assoc($result);
		$user_password = $user['password'];
		$oldpassword = $_POST['oldpassword'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		echo $oldpassword, $password, $password2;

		if(!isset( $_POST['oldpassword'], $_POST['password'], $_POST['password2']))
		{
		    $message = 'Please fill in all the fields';
		}
		if((strlen($_POST['oldpassword']) == 0) || (strlen($_POST['password']) == 0) || (strlen($_POST['password2'])) == 0)
		{
		     $message = 'Please fill in all the fields';
		}
		elseif (sha1($oldpassword) != $user_password) {
			$message =  "Your old password is not matching";
		}
		elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
		{
		    $message =  'Incorrect Length for Password';
		}
		elseif ($password != $password2) {
			$message =  "Both passwords are not matching";
		}
		else {
			$password = sha1( $password );
			$username = $user['username'];
			$query = "UPDATE `users` SET `password` = '$password' WHERE `username` = '$username'";
			mysql_query($query) or die(mysql_error());
			$_SESSION['password_changed'] = 1;
			header("Location: /eShop/index.php");
			}		
		}

	}
	else {
		$message = '';
	}
 ?>

 <!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
</head>
<body>

<div class="container">
<div class="row">
<div class=" col-md-6 col-md-offset-3">

	<form class='form-horizontal box' role='form' action="" method="post">
	<h2>Change Password</h2>
        <div class="alert alert-danger col-md-10">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $message; ?>
        </div>
	  <div class="form-group">
	    <div class="col-md-10"> 
	      <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Old Password">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-md-10"> 
	      <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-md-10"> 
	      <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password">
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
