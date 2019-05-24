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
            $UserID = (int) $_GET['user_id'];
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

$image_select = "SELECT * FROM users WHERE ID='$UserID'";
$image_query = mysqli_query($DB_Connection,$image_select);
$image_row=mysqli_fetch_array($image_query,MYSQLI_ASSOC);

    $Firstname = $image_row['Firstname'];
    $Surname = $image_row['Surname'];
    $Username = $image_row['Username'];
    $Email = $image_row['Email'];
    $Department = $image_row['Department'];
    $BirthDate = $image_row['Birthdate'];
    $Admin = $image_row['Admin'];
    $photo_string = $image_row['Photo'];


if(!$Emaili)
header("location: http://localhost:8080/project/Login.php");

    if($Admin == 1)
        $buttonstring = "<button class='btn btn-success'>YES</button>";
    else
        $buttonstring = "<button class='btn btn-danger'>NO</button>";

    echo 
    '<hr>
    <div class="container">'.
        '<div>'.
            '<table class="table table-primary">
                <tr>'.
                    '<td rowspan="8" width=250><img src='.$photo_string.' width=250 height=300 class="img-thumbnail" alt="PP"/><br></td>'.
                    '<tr><td>Firstname : '.$Firstname.'</td></tr>'.
                    '<tr><td>Surname : '.$Surname.'</td></tr>'.
                    '<tr><td>Username : '.$Username.'</td></tr>'.
                    '<tr><td>Email : '.$Email.'</td></tr>'.
                    '<tr><td>Department : '.$Department.'</td></tr>'.
                    '<tr><td>Birthdate : '.$BirthDate.'</td></tr>'.
                    '<tr><td>Admin Status : '.$buttonstring.'</td></tr>'.
                '</tr>'.
            '</table>'.
        '</div>'.
    '</div>'.
    '<br>';
?>


</body>
</html>