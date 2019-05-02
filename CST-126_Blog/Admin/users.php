<!--  
CST-126_Blog Ver 5.0
users Ver 1.0
Author: Richard Boyd
01MAY19
Page that displays all users and allows the administrator to edit their roles
-->

<html>
	<head>
		<title>Edit Users</title>
		<link rel="stylesheet" type="text/css" href="/CST-126_Blog/style.css">
	</head>
	<body>
		<!-- change login to display account once other pages are added -->
		<div class="navbar">
			<a href="/CST-126_Blog/Home/home.php">Home</a>					
		</div>

<?php
include('../functions.php');
$users = getAllUsers();

for ($x=0; $x<count($users); $x++){
    echo "<p>".$users[$x][0]."</p>";
    echo "<p>".$users[$x][1]."</p>";
    echo "<p>".$users[$x][2]."</p>"; ?>
    <form method="post" action="../Admin/userEdit.php">
    	<input type="hidden" name="User_name" value="<?php echo $users[$x][0] ?>" />
    	<select name="User_role">
    		<?php 
    		$result = getRoleNames();
    		while ($row = mysqli_fetch_assoc($result)) {
    		    echo "<option value='".$row["Role_name"]."'>".$row["Role_name"]."</option>";
    		}
    		?>
    	</select>
    	<input type="submit" value="Change Role" />
    </form>  
    <hr>
<?php      
}
?>

	</body>
</html>