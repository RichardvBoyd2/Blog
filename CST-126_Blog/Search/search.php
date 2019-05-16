<!-- 
CST-126_Blog Ver 8.0
search Ver 1.0
Author: Richard Boyd
10MAY19
search form
 -->

<html>
	<head>
		<title>Search</title>
		<link rel="stylesheet" type="text/css" href="../style.css">		
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="../Home/home.php">Home</a>
			<?php 
			session_start();
			if ($_SESSION["loggedin"] == false){ ?>
			<a href="../Registration/register.html">Sign Up</a>
			<a href="../Login/login.html" >Log In</a>
			<?php }?>
			<?php 
			include("../functions.php");			
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2){ ?>
			   <a href="../Post/newPost.html" >New Post</a>
			<?php }
			if ($_SESSION['role'] == 1) { ?>
			   <a href="../Post/newCategory.html" >New Category</a>
			   <a href="../Admin/users.php" >Edit Users</a>
			<?php }
			if ($_SESSION['loggedin'] == true) { ?>
			   <a href="../Login/Logout.php" >Log Out</a>
			<?php }	?>
		</div>
		
		<form action="searchHandler.php" method="post">
			<label>Title, Content, or Author:</label>
			<input type="text" name="search" required />			
			<input type="submit" value="Search" required />
		</form>
	</body>
</html>