<!-- 
CST-126_Blog Ver 2.0
registrationHandler Ver 2.0
Author: Richard Boyd
06APR19
PHP code that handles POST input from register.html and adds data to the users table in blog database
-->
<!-- 
registrationHandler Ver 2.0 notes:
added code to handle new password column that was added to database
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
if ($conn->query($sql) === TRUE){
    echo $nickname."'s account was created successfully!";
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}

?>