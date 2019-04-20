<!-- 
CST-126_Blog Ver 3.1
loginHandler Ver 1.3
Author: Richard Boyd
18APR19
Handles POST from login.html and queries users table against the attempted login credentials
 -->
<!--
loginHandler Ver 1.1 notes:
added code to implement sessions and add user ID to session user ID upon successful login
 -->
<!-- 
loginHandler Ver 1.2 notes:
changed database connection to use function from functions.php instead of opening connection locally
 -->
<!-- 
loginHandler Ver 1.3 notes:
added html code around php code for style consistancy
 -->

<html>
	<head>
		<title>Attempting Login...</title>
		<link rel="stylesheet" type="text/css" href="/CST-126_Blog/style.css">		
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="">Home</a>
			<a href="/CST-126_Blog/Registration/register.html">Sign Up</a>
			<a href="/CST-126_Blog/Login/login.html" >Log In</a>			
		</div>
		
<?php
session_start();

include("../functions.php");
$conn = dbConnect();

$username = $_POST['username'];
$password = $_POST['password'];

//first query checks if given username exists in db, and displays message if user doesn't exist
$sql = "SELECT * FROM users WHERE User_name='".$username."'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows == 0){
    echo "We couldn't find an account with that username";
} 
//if user is found, tests password attept
else {
    $sql = "SELECT * FROM users WHERE User_name='".$username."' AND Password='".$password."'";
    $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows == 1) {
        echo "Login was successful!";
        $user = $result->fetch_object();
        saveUserId($user->User_id);
        include("loginRedirect.php");
    } else {
        echo "Incorrect Password";
    }
}

mysqli_close($conn);
?>
		
		
	</body>
</html>