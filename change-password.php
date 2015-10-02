<!DOCTYPE html>
<html>
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
<a href="/eShop/index.php"> Back to HomePage</a>

<?php 
	if ($_POST) {
		$username = 'root';
		mysql_connect('localhost', $username); 
		mysql_select_db('eShop_db');
		session_start();
		if (isset($_SESSION['user_id'])) {
		$user = $_SESSION['user_id'];
		$query = "SELECT * FROM `users` WHERE username='$user'";
		$result = mysql_query($query) or die(mysql_error());
		$user = mysql_fetch_assoc($result);
		$user_password = $user['password'];
		$oldpassword = $_POST['oldpassword'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		if(!isset( $_POST['oldpassword'], $_POST['password'], $_POST['password2']))
		{
		    $echo  = 'Please fill in all the fields';
		}
		elseif (sha1($oldpassword) != $user_password) {
			echo "Your old password is not matching";
		}
		elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
		{
		    echo 'Incorrect Length for Password';
		}
		elseif ($password != $password2) {
			echo "Both passwords are not matching";
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
 ?>
</fieldset>
</form>
</body>
</html>