<!-- 
CST-126_Blog Ver 3.1
registrationHandler Ver 2.2
Author: Richard Boyd
18APR19
PHP code that handles POST input from register.html and adds data to the users table in blog database
-->
<!-- 
registrationHandler Ver 2.0 notes:
added code to handle new password column that was added to database
-->
<!-- 
registrationHandler Ver 2.1 notes:
changed database connection to use function from functions.php instead of opening connection locally
 -->
<!-- 
registrationHandler Ver 2.2 notes:
added html code around php code for style consistancy
 -->

<html>
	<head>
		<title>Attempting Registration...</title>
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
include("../functions.php");
$conn = dbConnect();

//checks for nickname, if blank just combines first and last name
global $nickname;
if ($_POST[User_nickname] === "" || $_POST[User_nickname] === NULL){
    $nickname = $_POST[First_name].$_POST[Last_name];
} else {
    $nickname = $_POST[User_nickname];
}

//SQL command, formatted for readability
$sql = "INSERT INTO users (
        User_name,
        Password,
        User_nickname,
        First_name,
        Middle_name,
        Last_name,
        Email1,
        Email2,
        Address1,
        Address2,
        City,
        State,
        Zipcode,
        Country
        ) 
        VALUES (
        '$_POST[User_name]',
        '$_POST[Password]',
        '$nickname',
        '$_POST[First_name]',
        '$_POST[Middle_name]',
        '$_POST[Last_name]',
        '$_POST[Email1]',
        '$_POST[Email2]',
        '$_POST[Address1]',
        '$_POST[Address2]',
        '$_POST[City]',
        '$_POST[State]',
        '$_POST[Zipcode]',
        '$_POST[Country]')";

//queries the SQL command, catches errors
if (mysqli_query($conn, $sql) === TRUE){
    echo $nickname."'s account was created successfully!";
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}

mysqli_close($conn);

?>

	</body>
</html>