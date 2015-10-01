<?php

  $id = $_GET['id'];
  // do some validation here to ensure id is safe

  $username = 'root';
  mysql_connect('localhost', $username); 
  mysql_select_db('eShop_db');
  $query = "SELECT * FROM User_Images WHERE user_id=$id";
  $result = mysql_query("$query");
  $numRows = mysql_num_rows($result); 

  if ($numRows > 0) {
    $row = mysql_fetch_assoc($result);
    header("Content-type: image/jpeg");
    echo $row['content'];
  }

  mysql_close();


?>