<!-- 
CST-126_Blog Ver 8.0
Logout Ver 1.0
Author: Richard Boyd
10MAY19
Clears session data, essentially logging current user out.
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
$_SESSION = array();
if (session_destroy()) {
    echo "You are now logged out.";
    include 'loginRedirect.php';
} else {
    echo "There was an issue logging you out.";
    include 'loginRedirect.php';
}

?>

	</body>
</html>