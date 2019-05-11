<!-- 
CST-126_Blog Ver 8.0
newComment Ver 1.0
Author: Richard Boyd
10MAY19
php code to handling creating a new comment
-->

<html>
	<head>
		<title>Create New Comment</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="../Home/home.php">Home</a>					
		</div>

<?php
session_start();
include '../functions.php';
$conn = dbConnect();

$ID = $_SESSION["USER_ID"];
$postID = $_POST["Post_id"];
$content = mysqli_real_escape_string($conn, $_POST["Comment_text"]);

$sql = "INSERT INTO comments (Post_id, Comment_text, Posted_date, Posted_by)
        VALUES ('$postID', '$content', CURRENT_TIMESTAMP, '$ID')";

if (mysqli_query($conn, $sql) === TRUE) {
    echo "Your comment was posted successfully";
    include '../Login/loginRedirect.php';
} else {
    echo "There was a problem creating your post ";
    echo "Error: ".$sql."<br>".$conn->error;
}

?>

	</body>
</html> 