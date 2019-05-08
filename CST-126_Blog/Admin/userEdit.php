<!--  
CST-126_Blog Ver 7.0
userEdit Ver 1.0
Author: Richard Boyd
07MAY19
Handles the role editing from users.php
-->

<html>
	<head>
		<title>Edit Users</title>
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

$sql = "SELECT Role_id FROM roles WHERE Role_name='".$_POST["User_role"]."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$role = $row["Role_id"];

$sql2 = "UPDATE users SET User_role=".$role." WHERE User_name='".$_POST["User_name"]."'";

if (mysqli_query($conn, $sql2)) {
    echo "User successfully updated.";
    include '../Login/loginRedirect.php';
} else {
    echo "There was a problem editing this user. ";
    echo "Error: ".$sql2."<br>".$conn->error;
}

?>

	</body>
</html>