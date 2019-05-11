<!--  
CST-126_Blog Ver 8.0
deletePost Ver 1.1
Author: Richard Boyd
10MAY19
php code for deleting a selected post
-->
<!-- 
deletePost ver 1.1 notes:
Changed post handling to use Post_id
 -->


<html>
	<head>
		<title>Create New Post</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<div class="navbar">
			<a href="../Home/home.php">Home</a>					
		</div>
		
<?php
include('../functions.php');
$conn = dbConnect();

$sql = "DELETE FROM posts WHERE Post_id='".$_POST['id']."'";
if (mysqli_query($conn, $sql)) {
    echo "Post successfully deleted.";
    include '../Login/loginRedirect.php';
} else {
    echo "There was a problem deleting this post ";
    echo "Error: ".$sql."<br>".$conn->error;
}
?>

	</body>
</html>