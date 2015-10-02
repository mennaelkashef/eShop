<?php

/*** begin our session ***/
session_start();

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<html>
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
</html>