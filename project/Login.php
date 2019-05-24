<html>

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
<style>
li {
    list-style-position:inside;
    border: 1px solid black;
}
</style>

</head>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            <?php
                echo'
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/login.php">Login</a></li>
					';
            ?>
        </ul>
    </div>
</nav>

<body>

<div class="container">
    <div>
        <form name="form1" method="post">
            <div>
                <label>Email</label>
                <input type="text" name="lblEmail">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="lblPassword">
            </div>
            <button type="submit">Login</button>
        </form>
	</div>
</div>
	
</body>

<?php
	session_start();
	include("DbConnection.php");

	$Email=$_POST['lblEmail'];
	$Password=$_POST['lblPassword'];

	$query="SELECT * FROM users WHERE Email='$Email' and Password='$Password'";
	$result=mysqli_query($DB_Connection,$query);
	$table_row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	if(mysqli_num_rows($result) == 1 && $Email !='' && $Password !='')
	{
		$_SESSION['loggeduser_id'] = $table_row['ID'];
		$_SESSION['loggeduser_email'] = $table_row['Email'];
		$_SESSION['loggeduser_firstname'] = $table_row['Firstname'];
		$_SESSION['loggeduser_surname'] = $table_row['Surname'];
        $_SESSION['loggeduser_admin'] = $table_row['Admin'];
        $_SESSION['loggeduser_username'] = $table_row['Username'];
        $_SESSION['loggeduser_department'] = $table_row['Department'];
        $_SESSION['loggeduser_birthdate'] = $table_row['Birthdate'];
        $_SESSION['loggeduser_photo'] = $table_row['Photo'];
		header("location: Home.php");
	}
	else if(isset($_POST['lblEmail']) && isset($_POST['lblPassword']))
		echo '<script language="javascript"> alert("Your password or email is incorrect.") </script>';
?>

</html>
