<!-- 
CST-126_Blog Ver 3.1
functions Ver 1.0
Author: Richard Boyd
18APR19
PHP file that contains various functions used throughout the program
-->

<?php
function dbConnect() {
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $server = "blog";
    
    $conn = mysqli_connect($host,$user,$pass,$server,3306);
        
    return $conn;
}

function saveUserId($id) {
    session_start();
    $_SESSION["USER_ID"]=$id;
}

function getUserId() {
    session_start();
    return $_SESSION["USER_ID"];
}

?>