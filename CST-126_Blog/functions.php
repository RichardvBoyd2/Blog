<!-- 
CST-126_Blog Ver 5.0
functions Ver 3.0
Author: Richard Boyd
01MAY19
PHP file that contains various functions used throughout the program
-->
<!-- 
functions Ver 2.0 notes:
added functions getAllPosts and getAllCategories
-->
<!-- 
functions Ver 3.0 notes:
added function getAllUsers and getRoleNames
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

function getAllUsers() {
    $conn = dbConnect();
    
    $sql = "SELECT users.User_name, users.User_nickname, roles.Role_name 
            FROM users
            INNER JOIN roles
            ON users.User_role=roles.Role_id";
    $result = mysqli_query($conn, $sql);
    $users = array();
    $index = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $users[$index] = array($row["User_name"],$row["User_nickname"],$row["Role_name"]);
        ++$index;
    }
    mysqli_close($conn);
    return $users;
}

function getAllCategories() {
    $conn = dbConnect();
    
    $sql = "SELECT Category_name FROM categories";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getRoleNames() {
    $conn = dbConnect();
    
    $sql = "SELECT Role_name FROM roles";
    $result = mysqli_query($conn, $sql);
    return $result;
}

?>