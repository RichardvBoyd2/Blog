<!-- 
CST-126_Blog Ver 7.0
loginHandler Ver 1.4
Author: Richard Boyd
07MAY19
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
<!-- 
loginHandler Ver 1.4 notes:
changed the saving of session variables so that the user role is saved to be read later
 -->

<html>
	<head>
		<title>Attempting Login...</title>
		<link rel="stylesheet" type="text/css" href="/CST-126_Blog/style.css">		
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="/CST-126_Blog/Home/home.php">Home</a>
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
        $_SESSION['USER_ID'] = ($user->User_id);
        $_SESSION['role'] = ($user->User_role);
        $_SESSION['loggedin'] = true;        
        include("loginRedirect.php");
    } else {
        echo "Incorrect Password";
    }
}

mysqli_close($conn);
?>
		
		
	</body>
</html>