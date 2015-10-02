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
<?php   require('header.php'); ?>
<div class="container">
<div class="row">
<div class=" col-md-6 col-md-offset-3">

    <form class='form-horizontal box' role='form' action="login_submit.php" method="post">
    <h2>Login Here</h2>
        <?php echo $message; ?>
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
