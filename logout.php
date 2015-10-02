<?php 
session_start();
session_destroy();
header("Location: /eShop/index.php");
 ?>