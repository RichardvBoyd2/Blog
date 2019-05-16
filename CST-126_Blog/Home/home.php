<!--  
CST-126_Blog Ver 8.0
home Ver 2.0
Author: Richard Boyd
10MAY19
Home page that displays the 5 latest blog posts as well as a conditional navigation bar depending on the session
-->
<!-- 
home Ver 1.1 notes:
Adds edit button to posts if user is logged in and has permission to do so
 -->
<!-- 
home Ver 1.2 notes: 
updates permission handling for all new roles
-->
<!-- 
home Ver 1.3 notes: 
added search button to navbar
 -->
<!-- 
home Ver 1.4 notes: 
changed post handling forms to use Post_id
 -->
<!-- 
home Ver 2.0 notes: 
Added small form to add rating. Page also displays the posts average rating.
 -->
  
<html>
	<head>
		<title>CST-126 Blog</title>
		<link rel="stylesheet" type="text/css" href="../style.css">		
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="../Home/home.php">Home</a>
			<a href="../Search/search.php">Search</a>
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

<?php 
$posts = getAllPosts();

for($x=0; $x<count($posts); $x++){?>

	<div class="post">
		<div class="postHead">
			<?php echo "<h2>".$posts[$x][1]."</h2>"; ?>			
			<?php echo "<h4>Posted by: ".$posts[$x][4]."</h4>"; ?>
		</div>
		<div class="postContent">
			<?php echo "<p>".$posts[$x][2]."<p>"; ?>
		</div>
		<div class="postFoot">
			<?php echo "<h6>Posted: ".$posts[$x][3]."</h6>"; 
			      echo "<h5>Rating: ".$posts[$x][5]."</h5>"; ?>
			<!-- insert rating stuff here after adding db stuff for rating -->
			<?php 
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2 || $_SESSION['role'] == 3) {?>
			   <form method="post" action="../Post/editPost.php">
			      <input type="hidden" name="id" value="<?php echo $posts[$x][0]?>">
			      <input type="submit" value="Edit">
			   </form>  
			<?php 
			}
			if ($_SESSION['loggedin'] == true) { ?>
			
			    <form method="post" action="../Post/ratePost.php">
			    	<input type="hidden" name="Post_id" value="<?php echo $posts[$x][0]?>" />
			    	<select name="rating">
			    		<option value="1">1</option>
			    		<option value="2">2</option>
			    		<option value="3">3</option>
			    		<option value="4">4</option>
			    		<option value="5">5</option>
			    	</select>
			    	<input type="submit" value="Rate" />
			    </form>
			    
			<?php    
			}
			?>
			<h3>Comments</h3>
			<?php 
			$comments = getComments($posts[$x][0]);
			
			for($y=0; $y<count($comments); $y++) {?>
			    <div class="comment">
			    	<?php echo "<h4>".$comments[$y][2]."</h4>"; 
			    	      echo "<p>".$comments[$y][0]."<p>";
			    	      echo "<h6>Posted: ".$comments[$y][1]."</h6>"?>			    	
			    </div>			
			<?php    
			}
			if ($_SESSION['loggedin'] == true) { ?>
			<form method="post" action="../Post/newComment.php">
				<input type="hidden" name="Post_id" value="<?php echo $posts[$x][0]?>" />
				<label>New Comment</label>
				<textarea name="Comment_text" rows="5" cols="75" maxlength="10000" required></textarea>
				<input type="submit" value="Post Comment" class="submit" />
			</form>	
			<?php 
			} ?>		
		</div>
		<hr>
	</div>
<?php
}
?>

				
	</body>
</html>