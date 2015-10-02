<?php
/*** begin our session ***/
session_start();

/*** first check that both the username, password and form token have been sent ***/
if(!isset( $_POST['username'], $_POST['password'], $_POST['form_token']))
{
    $message = 'Please enter a valid email and password';
}
/*** check the form token is valid ***/
elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Email';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}

else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    $password = sha1( $password );
    
    /*** connect to database ***/
    /*** mysql hostname ***/
    mysql_connect('localhost', 'root'); 
    mysql_select_db('eShop_db');
    $query = "INSERT INTO users (firstname, lastname, username, password ) VALUES ('$firstname', '$lastname', '$username', '$password' )";
    $result = mysql_query($query) or die(mysql_error());
    $message = 'New user added';
    $_SESSION['user_id'] = $username;
    if ($_FILES) {
        echo "string";
        if ($_FILES['image']['size'] > 0) {
            $fileName = $_FILES['image']['name'];
            $tmpName  = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileType = $_FILES['image']['type'];

            $fp      = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $content = addslashes($content);
            fclose($fp);

            if(!get_magic_quotes_gpc())
            {
                $fileName = addslashes($fileName);
            }

            $query = "SELECT * FROM `users` WHERE username='$username'";
            $result = mysql_query($query) or die(mysql_error());
            $user = mysql_fetch_assoc($result);
            $user_id = $user['user_id'];
            $query = "
            INSERT INTO User_Images (name, size, type, content, user_id ) 
            VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$user_id' )";

            $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/eShop/uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
               }
            mysql_query($query) or die(mysql_error()); 
            }
    }
    if (isset($_SESSION['product_id_unauthenticated']) and ($_SESSION['product_id_unauthenticated'] != 0)) {
        $product_id = $_SESSION['product_id_unauthenticated'];
        header("Location: /eShop/confirmation.php?product_id=$product_id");
        die();
    }

    if (isset($_SESSION['product_id_cart_unauthenticated']) and ($_SESSION['product_id_cart_unauthenticated'] != 0)) {
        $product_id = $_SESSION['product_id_cart_unauthenticated'];
        header("Location: /eShop/addToCart.php?product_id=$product_id");
        die();
    }        
    header("Location: /eShop/index.php");
    die();
}


?>
<html>
<head>
<title>Register</title>
</head>

<body>
<h2>Add user</h2>
<form action="adduser_submit.php" method="post" enctype="multipart/form-data">
<fieldset>
<?php echo $message; ?>
<?php

/*** begin our session ***/

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>
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