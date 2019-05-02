<!-- 
CST-126_Blog Ver 5.0
newPostHandler Ver 1.1
Author: Richard Boyd
01MAY19
PHP file that handles creating a new blog post
-->
<!-- 
newPostHandler Ver 1.1 notes:
added date and user ID values to SQL query
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
session_start();

include("../functions.php");
$conn = dbConnect();

$ID = $_SESSION["USER_ID"];
$title = mysqli_real_escape_string($conn, $_POST['Post_title']);
$content = mysqli_real_escape_string($conn, $_POST['Post_content']);
$sql = "INSERT INTO posts (Post_title, Post_content, Posted_date, Posted_by) 
        VALUES ('$title', '$content', CURRENT_TIMESTAMP, '$ID')";

if (mysqli_query($conn, $sql) === TRUE) {
    echo $_POST[Post_title]." was created successfully!";
    include('../Login/loginRedirect.php');
} else {
    echo "There was a problem creating your post ";
    echo $fixed." ".$title;
    echo "Error: ".$sql."<br>".$conn->error;
}

mysqli_close($conn);
?>

	</body>
</html> 