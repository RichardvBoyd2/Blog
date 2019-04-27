<!--  
CST-126_Blog Ver 4.0
editPost Ver 1.0
Author: Richard Boyd
27APR19
HTML form (in php) for editing a selected post
-->

<html>
	<head>
		<title>Create New Post</title>
		<link rel="stylesheet" type="text/css" href="/CST-126_Blog/style.css">
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="/CST-126_Blog/Home/home.php">Home</a>					
		</div>


<?php
include('../functions.php');
$conn = dbConnect();

$sql = "SELECT posts.Post_title, posts.Post_content, posts.Posted_date, users.User_nickname 
            FROM posts 
            INNER JOIN users
            ON posts.Posted_by=users.User_id
            WHERE Posted_date='".$_POST['time']."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

	<div class="post">
		<div class="postHead">
			<?php echo "<h1>".$row["Post_title"]."</h1>"; ?>			
			<?php echo "<h4>Posted by: ".$row["User_nickname"]."</h4>"; ?>
		</div>
		<div class="postContent">
			<?php echo "<p>".$row["Post_content"]."<p>"; ?>
		</div>
		<div class="postFoot">
			<?php echo "<h6>Posted: ".$row["Posted_date"]."</h6>"; ?>
		</div>
	</div>
	
	<form action="editPostHandler.php" method="post">
		<select name="Category_name">
			<?php 
			$result = getAllCategories();
			while ($row = mysqli_fetch_assoc($result)) { 
			    echo "<option value='".$row["Category_name"]."'>".$row["Category_name"]."</option>";
			} ?>
		</select>
		<input type="hidden" name="time" value="<?php echo $_POST['time'] ?>">
		<input type="submit" value="submit" />
	</form>
	<form action="deletePost.php" method="post">
		<input type="hidden" name="time" value="<?php echo $_POST['time'] ?>">
		<input type="submit" value="Delete Post" />
	</form>
	</body>
</html>