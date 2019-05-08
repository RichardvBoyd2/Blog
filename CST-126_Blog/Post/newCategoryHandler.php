<!-- 
CST-126_Blog Ver 7.0
newCategoryHandler Ver 1.0
Author: Richard Boyd
07MAY19
php code for creating a new category with POST info from newCategory.html
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
$name = $_POST['Category_name'];
$ID = $_SESSION['USER_ID'];
$sql = "INSERT INTO categories (Category_name, Created_date, Created_by)
        VALUES ('$name', CURRENT_DATE, '$ID')";

if (mysqli_query($conn, $sql) === TRUE) {
    echo $_POST['Category_name']." was created successfully!";
    include('../Login/loginRedirect.php');
} else {
    echo "There was a problem creating your post ";
    echo "Error: ".$sql."<br>".$conn->error;
}

mysqli_close($conn);
?>

	</body>
</html> 