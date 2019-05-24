<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Add Activity</title>
<style>
li {
    list-style-position:inside;
    border: 1px solid black;
}
</style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="http://localhost:8080/project/Home.php">
        <?php

        include('DbConnection.php');
        session_start();

            $UserID = $_SESSION['loggeduser_id'];
            $Firstname = $_SESSION['loggeduser_firstname'];
            $Surname = $_SESSION['loggeduser_surname'];
            $Email = $_SESSION['loggeduser_email'];
            $Admin = $_SESSION['loggeduser_admin'];
            $Username = $_SESSION['loggeduser_username'];
            $BirthDate = $_SESSION['loggeduser_birthdate'];
            $Department= $_SESSION['loggeduser_department'];

            if(!$Email)
                header("location: http://localhost:8080/project/Login.php");
            if($Admin==0)
                header("location: http://localhost:8080/project/Home.php");
            

            echo 'Welcome: '.$Firstname.' '.$Surname;
        ?>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
        <?php
				if($Admin==1)
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

<div class="container">
    <div >
        <div>
            <h3>Profile</h3>
            <form name="form1" method="post">
                <div class="form-group">
                    <label>Activity Type</label>
                    <input type="text" name="lblType" >
                </div>
                <div class="form-group">
                    <label>Activity Title</label>
                    <input type="text" name="lblTitle" >
                </div>
                <div class="form-group">
                    <label>Activity Description</label>
                    <input type="text"  name="lblDescription" >
                </div>
                <div class="form-group">
                    <label>Starting Date</label>
                    <input type="date" name="lblStartingDate" value="2019-01-01" min="1950-01-01" max="2023-01-01">
                </div>
                <div class="form-group">
                    <label>Ending Date</label>
                    <input type="date" name="lblEndingDate" value="2019-01-01" min="1950-01-01" max="2023-01-01">
                </div>
                <button type="submit" class="btn btn-primary" >Add Activity</button>
            </form><hr>
        </div>
    </div>
</div>
</body>

<?php

    $Type=$_POST['lblType'];
    $Title=$_POST['lblTitle'];
    $Description=$_POST['lblDescription'];
    $Start=$_POST['lblStartingDate'];
    $End=$_POST['lblEndingDate'];
    $Activity_By=$UserID;
    $Likes=0;
    $Dislikes=0;
    $Score=0;

    if($Type!='' && $Title!='' && $Description!='' && $Start!='' && $End!='' && $Activity_By!=''){
        
        $query="INSERT INTO Activity(Type,Title,Description,Start,End,Activity_By,Likes,Dislikes,Score) 
                VALUES ('$Type','$Title','$Description','$Start','$End','$Activity_By','$Likes','$Dislikes','$Score')";
       
       $result=mysqli_query($DB_Connection,$query);

       echo '<script language="javascript"> alert("Activity Added.") </script>';
    }
?>

</html>