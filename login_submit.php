<?php

session_start();

if(isset( $_SESSION['user_id'] ))
{
    $message = 'Users is already logged in';
}
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid email and password';
}
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for email';
}
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}

elseif (ctype_alnum($_POST['password']) != true)
{
        $message = "Password must be alpha numeric";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    $password = sha1( $password );
    
    mysql_connect('localhost', 'root'); 
    mysql_select_db('eShop_db');
    $query = "SELECT * FROM users 
                    WHERE username = '$username' AND password = '$password'";
    $result = mysql_query($query) or die(mysql_error());
    $numRows = mysql_num_rows($result);

    if ($numRows > 0){
        $row = mysql_fetch_assoc($result);
        $user_id = $row['user_id'];
        $_SESSION['user_id'] = $username;

        /*** tell the user we are logged in ***/
        $message = 'You are now logged in';
        if (isset($_SESSION['product_id_unauthenticated']) and ($_SESSION['product_id_unauthenticated'] != 0)) {
            $product_id = $_SESSION['product_id_unauthenticated'];
            unset($_SESSION['product_id_unauthenticated']);
            header("Location: /eShop/confirmation.php?product_id=$product_id");
            die();
        } 
        if (isset($_SESSION['product_id_cart_unauthenticated']) and ($_SESSION['product_id_cart_unauthenticated'] != 0)) {
            $product_id = $_SESSION['product_id_cart_unauthenticated'];
            header("Location: /eShop/addToCart.php?product_id=$product_id");
            die();
        }
        header("Location: /eShop/index.php");

    }
    else {
        $message = 'Login Failed';
 
    } 
}
?>

<html>
<head>
<title>Login</title>
</head>

<body>
<h2>Login Here</h2>
<form action="login_submit.php" method="post">
<fieldset>
<?php echo $message; ?>
<p>
<label for="username">Username</label>
<input type="text" id="username" name="username" value="" maxlength="20" />
</p>
<p>
<label for="password">Password</label>
<input type="text" id="password" name="password" value="" maxlength="20" />
</p>
<p>
<input type="submit" value="→ Login" />
</p>
    <a href='/eShop/register.php'> Sign up here </a>

</fieldset>
</form>
</body>
</html>
