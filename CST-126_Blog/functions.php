<!-- 
CST-126_Blog Ver 4.0
functions Ver 2.0
Author: Richard Boyd
27APR19
PHP file that contains various functions used throughout the program
-->
<!-- 
functions Ver 2.0 notes:
added functions getAllPosts and getAllCategories
-->

<?php
function dbConnect() {
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $server = "blog";
    
    $conn = mysqli_connect($host,$user,$pass,$server,8889);
        
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

function getAllPosts() {
    $conn = dbConnect();
    
    $sql = "SELECT posts.Post_title, posts.Post_content, posts.Posted_date, users.User_nickname 
            FROM posts
            INNER JOIN users
            ON posts.Posted_by=users.User_id
            ORDER BY Posted_date DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    
    $posts = array();
    $index = 0;
    
    while ($row = mysqli_fetch_assoc($result)){
        $posts[$index] = array($row["Post_title"],$row["Post_content"],$row["Posted_date"],$row["User_nickname"]);
        ++$index;
    }
    mysqli_close($conn);
    return $posts;
}

function getAllCategories() {
    $conn = dbConnect();
    
    $sql = "SELECT Category_name FROM categories";
    $result = mysqli_query($conn, $sql);
    return $result;
}

?>