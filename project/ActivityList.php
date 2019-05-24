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
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Activities</title>
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
                    <th>Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Starting At</th>
                    <th>Ending At</th>
                    <th>Author</th>
                    <th>Likes</th>
                    <th>Dislikes</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    date_default_timezone_set('Europe/Istanbul');
					$select="SELECT * FROM activity";
					$query=mysqli_query($DB_Connection,$select);
					echo "<hr><tr>";
					while($result=mysqli_fetch_array($query,MYSQLI_NUM))
					{
                        $selectusername = "SELECT Firstname,Surname FROM users WHERE ID='$result[6]';";
                        $queryusername = mysqli_query($DB_Connection,$selectusername);
                        $rowusername = mysqli_fetch_array($queryusername,MYSQLI_NUM);
                        $result[6] = $rowusername[0].' '.$rowusername[1];

                        $start = strtotime($result[4]);
                        $end = strtotime($result[5]);
                        $today = date("Y-m-d H:i:s");
                        $today = strtotime($today);
                        $daydiff = $today - $start;
                        
                        if($today>$end)
                        {
                            $status = "Completed";
                            $buttonclass = "btn btn-success";
                        }
                        else if($today > $start && $today < $end && $today!=$start)
                        {
                            $status = "Ongoing";
                            $buttonclass = "btn btn-warning";
                        }
                        if($today < $start)
                        {
                            $status = "Not started";
                            $buttonclass = "btn btn-default";
                        }

                        if($daydiff>(60*60*24*15)){
                            $status = "Expired";
                            $buttonclass = "btn";
                        }
                        
                        $activity_id = $result[0];

                        if($daydiff < (60*60*24*15) && $today < $end)
                        {
                            echo"
							<tr>
							<td>".$result[0]."</td>
							<td>".$result[1]."</td>
							<td>".$result[2]."</td>
                            <td>".$result[3]."</td>
                            <td width=110>".$result[4]."</td>
							<td width=110>".$result[5]."</td>
                            <td width=150>".$result[6]."</td>
                            <td style='text-align:center'>".$result[7]." &nbsp&nbsp<button class='btn btn-info'> <a href='LikeActivity.php?activity_id=$activity_id&user_id=$UserID'>Like</a></button></td>
                            <td style='text-align:center'>".$result[8]." &nbsp&nbsp<button class='btn btn-danger'><a href='DislikeActivity.php?activity_id=$activity_id&user_id=$UserID'>Dislike</a></button></td>
                            <td><button class='".$buttonclass."'>".$status."</button></td>
							</tr>
                            ";
                        }
                        else{
                            echo"
							<tr>
							<td>".$result[0]."</td>
							<td>".$result[1]."</td>
							<td>".$result[2]."</td>
                            <td>".$result[3]."</td>
                            <td width=110>".$result[4]."</td>
							<td width=110>".$result[5]."</td>
                            <td width=150>".$result[6]."</td>
                            <td style='text-align:center'>".$result[7]."</td>
                            <td style='text-align:center'>".$result[8]."</td>
                            <td><button class='".$buttonclass."'>".$status."</button></td>
							</tr>
                            ";
                        }
						
                    }
                ?>
                </tbody>
            </table>
            <?php
            if($Admin==1)
             {

                // BURASI DENEME

                $query = mysqli_query($DB_Connection,"SELECT ID FROM Activity");
                echo '<hr><form method="post">';
                echo 'Select Activity &nbsp <select name="dropdown">';
                while ($result=mysqli_fetch_array($query,MYSQLI_NUM))
                    echo '<option value='.$result[0].'>'.$result[0].'</option>';
                echo '</select> &nbsp';
                echo' <button type="submit">Delete</button>';
                echo '</form>';

                // BURASI DENEME

                /*echo
                '
                    <div class="container">
                        <h3>Delete Activity</h3>
                        <form id="form1" name="form1"  method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Activity ID</label>
                                <input type="text" name="lblDeleteID" required>
                            </div>
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                ';*/
            }
           
            //$DeleteID = $_POST['lblDeleteID'];
            $DeleteID = $_POST['dropdown'];

            if($DeleteID!=''){
                $select = "SELECT Title FROM activity WHERE ID='$DeleteID'";
                $query=mysqli_query($DB_Connection,$select);
                $temp = mysqli_fetch_array($query,MYSQLI_NUM);
                $temptemp = $temp[0];
                $select = "DELETE FROM comment WHERE Activity_Title='$temptemp'";
                $query=mysqli_query($DB_Connection,$select);
                $select = "DELETE FROM activity WHERE ID='$DeleteID'";
                $query=mysqli_query($DB_Connection,$select);
                echo '<script language="javascript"> alert("Deletion completed.") </script>';
            }
            
            ?>
</div>
</body>
</html>