<!-- 
CST-126_Blog Ver 7.0
search Ver 1.0
Author: Richard Boyd
07MAY19
search form
 -->

<html>
	<head>
		<title>Search</title>
		<link rel="stylesheet" type="text/css" href="/CST-126_Blog/style.css">		
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="/CST-126_Blog/Home/home.php">Home</a>
			<?php 
			session_start();
			if ($_SESSION["loggedin"] == false){ ?>
			<a href="/CST-126_Blog/Registration/register.html">Sign Up</a>
			<a href="/CST-126_Blog/Login/login.html" >Log In</a>
			<?php }?>
			<?php 
			include("../functions.php");			
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2){ ?>
			   <a href="/CST-126_Blog/Post/newPost.html" >New Post</a>
			<?php }
			if ($_SESSION['role'] == 1) { ?>
			   <a href="/CST-126_Blog/Post/newCategory.html" >New Category</a>
			   <a href="/CST-126_Blog/Admin/users.php" >Edit Users</a>
			<?php }
			if ($_SESSION['loggedin'] == true) { ?>
			   <a href="/CST-126_Blog/Login/Logout.php" >Log Out</a>
			<?php }	?>
		</div>
		
		<form action="searchHandler.php" method="post">
			<label>Title, Content, or Author:</label>
			<input type="text" name="search" />			
			<input type="submit" value="Search" />
		</form>
	</body>
</html>