<!-- 
CST-126_Blog Ver 3.1
newPostHandler Ver 1.1
Author: Richard Boyd
18APR19
PHP file that handles creating a new blog post
-->
<!-- 
newPostHandler Ver 1.1 notes:
added date and user ID values to SQL query
 -->

<?php
session_start();

include("../functions.php");
$conn = dbConnect();

$ID = getUserId();
$sql = "INSERT INTO posts (Post_title, Post_content, Posted_date, Posted_by) 
        VALUES ('$_POST[Post_title]','$_POST[Post_content]', CURRENT_TIMESTAMP, '$ID')";

if (mysqli_query($conn, $sql)) {
    echo $_POST[Post_title]." was created successfully!";
} else {
    echo "There was a problem creating your post";
}

mysqli_close($conn);
?>