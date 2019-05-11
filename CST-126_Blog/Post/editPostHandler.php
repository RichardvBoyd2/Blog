<!--  
CST-126_Blog Ver 8.0
editPostHandler Ver 2.1
Author: Richard Boyd
10MAY19
php code for editing posts using POST info from editPost.php
-->
<!-- 
editPostHandler Ver 2.0 notes:
updated SQL query to include changes from updated editPost.php
 -->
<!-- 
editPostHandler Ver 2.0 notes:
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
session_start();
include('../functions.php');
$conn = dbConnect();

$sql = "SELECT Category_id FROM categories WHERE Category_name='".$_POST['Category_name']."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cat = $row["Category_id"];
$title = mysqli_real_escape_string($conn, $_POST['Post_title']);
$body = mysqli_real_escape_string($conn, $_POST['Post_content']);
$ID = $_SESSION['USER_ID'];
$sql = "UPDATE posts SET Category_id=".$cat.", Post_title='".$title."', Post_content='".$body."', Updated_date=CURRENT_TIMESTAMP, Updated_by='".$ID."'  
        WHERE Post_id='".$_POST['id']."'";

if (mysqli_query($conn, $sql)) {
    echo "Post successfully updated.";
    include '../Login/loginRedirect.php';
} else {
    echo "There was a problem editing this post ";
    echo "Error: ".$sql."<br>".$conn->error;
}

?>

	</body>
</html>