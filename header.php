<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<nav class ="md-col-12">
		<div class  = "userMenu">
			<ul class = "userMenu_list">
				<li class = "userMenu_item"><a href="#"><?php session_start();
				echo $_SESSION['user_id']; ?></a></li>
				<li class = "userMenu_item userMenu_divider">|</li>
				<li class = "userMenu_item"><a href="#">History</a></li>
				<li class = "userMenu_item userMenu_divider">|</li>
		        <li class = "userMenu_item"><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
		        <li class = "userMenu_item userMenu_divider">|</li>
		        <li class = "userMenu_item"><a href="#">Logout</a></li>
			</ul>
		</div>
		<!-- <div class = "logo-space">
			<div class = "logo-container">
				<a href="#" class="logo">
					<span class="logo_she glyphicon glyphicon-shopping-cart"></span>
				</a>
			</div>
		</div> -->
	</nav>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
