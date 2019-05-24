<?php
	session_start();
	include_once ("DbConnection.php");
	$UserID = $_SESSION['loggeduser_id'];
	$Firstname=$_SESSION['loggeduser_firstname'];
	$Surname=$_SESSION['loggeduser_surname'];
	$Email=$_SESSION['loggeduser_email'];
	$Admin = $_SESSION['loggeduser_admin'];
	
	if(!$Email)
        header("location: http://localhost:8080/project/Login.php");
    if($Admin==0)
        header("location: http://localhost:8080/project/Home.php");
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>User List</title>
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
            <table class="table table-primary">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Birthdate</th>
                    <th>Department</th>
                    <th>Admin Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
					$select="SELECT * FROM users";
					$query=mysqli_query($DB_Connection,$select);
					echo "<hr><tr>";
					while($result=mysqli_fetch_array($query,MYSQLI_NUM))
					{
                        if($result[9] == 1)
                            $buttonstring = "<button class='btn btn-success'>YES</button>";
                        else
                            $buttonstring = "<button class='btn btn-danger'>NO</button>";

                            $link = "OtherUserPage.php?user_id=".$result[0];

						echo"
                            <tr>
                            
                            <td>".$result[0]."</td>
                            <td width=100><a href=".$link.">
                                    <img src='".$result[8]."' class='img-thumbnail' alt='PP' width=50 height=50/></a>&nbsp</td>
							<td>".$result[1]."</td>
							<td>".$result[2]."</td>
                            <td>".$result[3]."</td>
                            <td>".$result[4]."</td>
							<td>".$result[5]."</td>
							<td>".$result[6]."</td>
                            <td>".$buttonstring."</td>
							</tr>
                            ";
                            
                    } 
                    
                ?>
                </tbody>
            </table>
            <?php
            if($Admin==1)
             {
                // BURASI DENEME

                $query = mysqli_query($DB_Connection,"SELECT ID FROM users");
                echo '<hr><form method="post">';
                echo 'Select Activity &nbsp <select name="dropdown">';
                while ($result=mysqli_fetch_array($query,MYSQLI_NUM))
                    echo '<option value='.$result[0].'>'.$result[0].'</option>';
                echo '</select> &nbsp';
                echo' <button type="submit">Delete</button>';
                echo '</form>';

                // BURASI DENEME

                /*
                echo
                '
                    <div class="container">
                        <h3>Delete User</h3>
                        <form name="form1"  method="post">
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" name="lblDeleteID" required>
                                &nbsp<button type="submit">Delete</button>
                            </div>
                        </form>
                    </div>
                ';
                */
            }

            //$DeleteID = $_POST['lblDeleteID'];
            $DeleteID = $_POST['dropdown'];
           
            if($DeleteID!=''){
                $select = "DELETE FROM Users WHERE ID='$DeleteID'";
                $select2 = "DELETE FROM Activity WHERE Activity_By='$DeleteID'" ;
                $select3 = "DELETE FROM Comment WHERE User_ID='$DeleteID'";
                $query=mysqli_query($DB_Connection,$select);
                $query2=mysqli_query($DB_Connection,$select2);
                $query3=mysqli_query($DB_Connection,$select3);
                echo '<script language="javascript"> alert("Deletion completed.") </script>';
            }
            ?>
</div>
</body>
</html>