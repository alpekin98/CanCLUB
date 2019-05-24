<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Profile</title>

<style>
li {
    list-style-position:inside;
    border: 1px solid black;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="http://localhost:8080/project/Home.php">
        <?php
           
            include('DbConnection.php');
            session_start();
            $Admini = $_SESSION['loggeduser_admin'];
            $Firstnamei = $_SESSION['loggeduser_firstname'];
            $Surnamei = $_SESSION['loggeduser_surname'];
            $Emaili = $_SESSION['loggeduser_email'];
            echo 'Welcome: '.$Firstnamei.' '.$Surnamei;
        ?>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
        <?php
				if($Admini==1)
				{
					echo'
							<li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/AddActivity.php">Add Activity</a></li>
							<li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/ListAllUsers.php">Users</a></li>
						';
				}
				echo'
						<li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/Profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/ActivityList.php">Activity List</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/VoteActivity.php">Comment Activity</a></li>
						<li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/Trending.php">Trends</a></li>
						<li class="nav-item"><a class="nav-link" href="http://localhost:8080/project/Logout.php">Logout</a></li>
					';
            ?>
        </ul>
    </div>
</nav>

<?php

$UserID = $_SESSION['loggeduser_id'];
$Firstnamei = $_SESSION['loggeduser_firstname'];
$Surnamei = $_SESSION['loggeduser_surname'];
$Emaili = $_SESSION['loggeduser_email'];
$Admini = $_SESSION['loggeduser_admin'];
$Usernamei = $_SESSION['loggeduser_username'];
$BirthDatei = $_SESSION['loggeduser_birthdate'];
$Departmenti = $_SESSION['loggeduser_department'];

$image_select = "SELECT Photo FROM users WHERE ID='$UserID'";
$image_query = mysqli_query($DB_Connection,$image_select);
$image_row=mysqli_fetch_array($image_query,MYSQLI_ASSOC);
$photo_string = $image_row['Photo'];
if(!$Emaili)
header("location: http://localhost:8080/project/Login.php");

    if($Admini == 1)
        $buttonstring = "<button class='btn btn-success'>YES</button>";
    else
        $buttonstring = "<button class='btn btn-danger'>NO</button>";
    echo 
    '<hr><div class="container">'.
        '<div>'.
            '<table class="table table-primary">'.
                '<tr>'.
                    '<td rowspan="8" width=250><img src='.$photo_string.' width=250 height=300 class="img-thumbnail" alt="PP"/><br></td>'.
                    '<tr><td>Firstname : '.$Firstnamei.'</td></tr>'.
                    '<tr><td>Surname : '.$Surnamei.'</td></tr>'.
                    '<tr><td>Username : '.$Usernamei.'</td></tr>'.
                    '<tr><td>Email : '.$Emaili.'</td></tr>'.
                    '<tr><td>Department : '.$Departmenti.'</td></tr>'.
                    '<tr><td>Birthdate : '.$BirthDatei.'</td></tr>'.
                    '<tr><td>Admin Status : '.$buttonstring.'</td></tr>'.
                '</tr>'.
            '</table>'.
        '</div>'.
    '</div>'.
    '<br>';
?>


<div class="container">
    <div>
        <div class="col-sm-4">
            <h3>Profile</h3>
            <form name="form1" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="lblFirstname" >
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" name="lblSurname" >
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text"  name="lblUsername" >
                </div>
                <div class="form-group">
                    <label>Birth Date</label>
                    <input type="date" name="lblBirthDate" value="<?php echo $BirthDatei?>" min="1950-01-01" max="2023-01-01">
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="lblDepartment">
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
    <form action="UploadPhoto.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" value="Choose image"><br>
    <input type="submit" value="Upload Image" name="submit">
</form><hr>

</div>


</body>
<?php 
    
    $query="SELECT * FROM users WHERE ID='$UserID'";
	$result=mysqli_query($DB_Connection,$query);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    $Firstname = $_POST['lblFirstname'];
    $Surname = $_POST['lblSurname'];
    $Username = $_POST['lblUsername'];
    $BirthDate = $_POST['lblBirthDate'];
    $Department = $_POST['lblDepartment'];

    if(mysqli_num_rows($result)==1 && ($Surname!=''||$Firstname!=''||$Email!=''||$Username!=''||$Department!=''))
    {
        if($Surname=='')
            $Surname=$Surnamei;
        if($Firstname=='')
            $Firstname=$Firstnamei;
        if($Username=='')
            $Username=$Usernamei;
        if($Department=='')
             $Department=$Departmenti;
        if($BirthDate=='')
            $BirthDate=$BirthDatei;

		$registration_query = "UPDATE users
                                SET  Surname='$Surname',Firstname='$Firstname', 
                                Department='$Department', Birthdate='$BirthDate', Username='$Username'
                                WHERE ID='$UserID';
                                ";
        $registration_query_result=mysqli_query($DB_Connection,$registration_query);
        
        $query="SELECT * FROM users WHERE ID='$UserID'";
	    $result=mysqli_query($DB_Connection,$query);
	    $table_row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $_SESSION['loggeduser_surname'] = $table_row['Surname'];
        $_SESSION['loggeduser_firstname'] = $table_row['Firstname'];
        $_SESSION['loggeduser_username'] = $table_row['Username'];
        $_SESSION['loggeduser_department'] = $table_row['Department'];
        $_SESSION['loggeduser_birthdate'] = $table_row['Birthdate'];

        echo '<script language="javascript"> alert("Profile updated.") </script>';
        
        header("location: Profile.php");

	}

?>
</html>