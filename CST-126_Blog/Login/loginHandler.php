<!-- 
CST-126_Blog Ver 2.2
registrationHandler Ver 1.1
Author: Richard Boyd
08APR19
Handles POST from login.html and queries users table against the attempted login credentials
 -->
<!--
registrationHandler Ver 1.1 notes:
added code to implement sessions and add user ID to session user ID upon successful login
 -->

<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "root";
$server = "blog";
//tests connection to database server
$conn = new mysqli($host,$user,$pass,$server,3306);
if ($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

//first query checks if given username exists in db, and displays message if user doesn't exist
$sql = "SELECT * FROM users WHERE User_name='".$username."'";
$result = $conn->query($sql);

if ($result->num_rows == 0){
    echo "We couldn't find an account with that username";
} 
//if user is found, tests password attept
else {
    $sql = "SELECT * FROM users WHERE User_name='".$username."' AND Password='".$password."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        echo "Login was successful";
        $user = $result->fetch_object();
        $_SESSION['user_id'] = $user->User_id;
    } else {
        echo "Incorrect Password";
    }
}



$conn->close();
?>