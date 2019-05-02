<!--  
CST-126_Blog Ver 5.0
home Ver 1.2
Author: Richard Boyd
01MAY19
Home page that displays the 5 latest blog posts as well as a conditional navigation bar depending on the session
-->
<!-- 
home Ver 1.1 notes:
Adds edit button to posts if user is logged in and has permission to do so
 -->
<!-- 
home Ver 1.2
updates permission handling for all new roles
-->
<html>
	<head>
		<title>CST-126 Blog</title>
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

<?php 
$posts = getAllPosts();

for($x=0; $x<count($posts); $x++){?>

	<div class="post">
		<div class="postHead">
			<?php echo "<h1>".$posts[$x][0]."</h1>"; ?>			
			<?php echo "<h4>Posted by: ".$posts[$x][3]."</h4>"; ?>
		</div>
		<div class="postContent">
			<?php echo "<p>".$posts[$x][1]."<p>"; ?>
		</div>
		<div class="postFoot">
			<?php echo "<h6>Posted: ".$posts[$x][2]."</h6>"; ?>
			<?php 
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2 || $_SESSION['role'] == 3) {?>
			   <form method="post" action="../Post/editPost.php">
			      <input type="hidden" name="time" value="<?php echo $posts[$x][2]?>">
			      <input type="submit" value="Edit">
			   </form>  
			<?php }?>
		</div>
		<hr>
	</div>
<?php
}
?>

				
	</body>
</html>