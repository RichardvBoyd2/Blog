<!-- 
CST-126_Blog Ver 2.0
registrationHandler Ver 1.0
Author: Richard Boyd
06APR19
handles POST from login.html and queries users table against the attempted login credentials
 -->
 
<?php
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
    } else {
        echo "Incorrect Password";
    }
}



$conn->close();
?>