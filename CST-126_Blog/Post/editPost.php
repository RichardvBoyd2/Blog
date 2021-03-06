<!--  
CST-126_Blog Ver 8.0
editPost Ver 2.1
Author: Richard Boyd
10MAY19
HTML form (in php) for editing a selected post
-->
<!-- 
editPost Ver 2.0 notes:
Added fields to the form to edit the title and content of post as well as the category.
 -->
<!-- 
editPost Ver 2.1 notes:
Changed post handling to use Post_id
 -->
 
<html>
	<head>
		<title>Edit Post</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="../Home/home.php">Home</a>					
		</div>


<?php
include('../functions.php');
$conn = dbConnect();

$sql = "SELECT posts.Post_title, posts.Post_content, posts.Posted_date, users.User_nickname 
            FROM posts 
            INNER JOIN users
            ON posts.Posted_by=users.User_id
            WHERE Post_id='".$_POST['id']."'";
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
		<label>Title</label>
		<input name="Post_title" type="text" value="<?php echo $row["Post_title"]?>" required />			
		<label>Body</label>		
		<textarea name="Post_content" rows="5" cols="75" maxlength="1000000000000"><?php echo $row["Post_content"]?></textarea>
		<label>Category</label>
		<select name="Category_name">
			<?php 
			$result = getAllCategories();
			while ($row = mysqli_fetch_assoc($result)) { 
			    echo "<option value='".$row["Category_name"]."'>".$row["Category_name"]."</option>";
			} ?>
		</select>
		<input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
		<input type="submit" value="submit" />
	</form>
	<form action="deletePost.php" method="post">
		<input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
		<input type="submit" value="Delete Post" />
	</form>
	</body>
</html>