<!--  
CST-126_Blog Ver 8.0
ratePost Ver 1.0
Author: Richard Boyd
10MAY19
Handles the post data when rating a post
-->

<html>
	<head>
		<title>Rating Post</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body>		
		<div class="navbar">
			<a href="../Home/home.php">Home</a>					
		</div>

<?php
session_start();
include '../functions.php';
$user = $_SESSION["USER_ID"];
$post = $_POST["Post_id"];
$rating = $_POST["rating"];
$conn = dbConnect();

$sql = "SELECT * FROM ratings 
        WHERE Rated_by='".$user."' AND Post_id='".$post."'";
$check = mysqli_query($conn, $sql);

if (mysqli_fetch_assoc($check) == null) {
    $sql = "INSERT INTO ratings (Rating_value, Post_id, Rated_by)
            VALUES ('$rating', '$post', '$user')";
    if (mysqli_query($conn, $sql)) {
        echo "Rating was succesfully added! ";
    } else {
        echo "There was a problem adding your rating";
        echo "Error: ".$sql."<br>".$conn->error;
    }    
} else {
    $sql = "UPDATE ratings SET Rating_value=".$rating."
            WHERE Rated_by=".$user;
    if (mysqli_query($conn, $sql)) {
        echo "Rating was succesfully updated! ";
    } else {
        echo "There was a problem updating your rating";
        echo "Error: ".$sql."<br>".$conn->error;
    }
}

$sql = "SELECT AVG(Rating_value) FROM ratings WHERE Post_id=".$post;
$average = mysqli_query($conn, $sql);
$average = mysqli_fetch_assoc($average);
$average = $average["AVG(Rating_value)"];

$sql = "UPDATE posts SET Post_rating=".$average."
        WHERE Post_id=".$post;

if (mysqli_query($conn, $sql)) {
    include '../Login/loginRedirect.php';
} else {
    echo "There was a problem updating the post's rating";
    echo "Error: ".$sql."<br>".$conn->error;
}
?>

	</body>
</html>