<!-- 
CST-126_Blog Ver 7.0
Logout Ver 1.0
Author: Richard Boyd
07MAY19
Clears session data, essentially logging current user out.
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