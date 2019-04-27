<!--  
CST-126_Blog Ver 4.0
deletePost Ver 1.0
Author: Richard Boyd
27APR19
php code for deleting a selected post
-->

<html>
	<head>
		<title>Create New Post</title>
		<link rel="stylesheet" type="text/css" href="/CST-126_Blog/style.css">
	</head>
	<body>
		<div class="navbar">
			<a href="/CST-126_Blog/Home/home.php">Home</a>					
		</div>
		
<?php
include('../functions.php');
$conn = dbConnect();

$sql = "DELETE FROM posts WHERE Posted_date='".$_POST['time']."'";
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