<?php
	session_start();
	include_once ("DbConnection.php");
	$UserID = $_SESSION['loggeduser_id'];
	$Firstname=$_SESSION['loggeduser_firstname'];
	$Surname=$_SESSION['loggeduser_surname'];
	$Email=$_SESSION['loggeduser_email'];
    $Admin = $_SESSION['loggeduser_admin'];
    $Photo = $_SESSION['loggeduser_photo'];
	if(!$Email)
        header("location: http://localhost:8080/project/Login.php");
    
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Comment Activity</title>
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
                    <th>Score</th>
                </tr>
                </thead>
                <tbody>
                <?php
					$select="SELECT * FROM activity";
                    $query=mysqli_query($DB_Connection,$select);
                    
                    
					echo "<hr><tr>";
					while($result=mysqli_fetch_array($query,MYSQLI_NUM))
					{
                        $select1 = "SELECT Firstname , Surname FROM users WHERE ID =".$result[6].";";
                        $query2 = mysqli_query($DB_Connection,$select1);
                        $rowrow = mysqli_fetch_array($query2,MYSQLI_NUM);
                        $Author = $rowrow[0].' '.$rowrow[1];
						echo"
							<tr>
							<td>".$result[0]."</td>
							<td>".$result[1]."</td>
							<td>".$result[2]."</td>
                            <td>".$result[3]."</td>
                            <td width=120>".$result[4]."</td>
							<td width=120>".$result[5]."</td>
							<td width=150>".$Author."</td>
                            <td>".$result[7]."</td>
                            <td>".$result[8]."</td>
                            <td>".$result[9]."</td>
							</tr>
                            ";
                    } 
                ?>
                </tbody>
            </table>
        </div><hr>
    <div class="container">
    <?php
    
        $query = mysqli_query($DB_Connection,"SELECT Title FROM activity");
        echo '<form method="post">';
        echo '<select name="dropdown">';
        while ($result=mysqli_fetch_array($query,MYSQLI_NUM)){
            $string = str_replace(' ', '_', $result[0]);
            echo '<option value='.$string.'>'.$result[0].'</option>';
        }  
        echo '</select><br>';
        echo '<textarea name="lblComment" cols="40" rows="5"></textarea><br>';
        echo '<input type="submit" name="ddlActivity" value="Comment"/>';
        echo '</form>';

        if(isset($_POST['ddlActivity']) && $_POST['lblComment']!=''){
            
            $selected_val = $_POST['dropdown'];
            $selected_val = str_replace('_', ' ', $selected_val);
            $text = $_POST['lblComment'];
            $query="INSERT INTO comment(Activity_Title,Username,Comment_Text,User_ID,Photo) 
                VALUES ('$selected_val','$Firstname $Surname','$text','$UserID','$Photo');";
            $result=mysqli_query($DB_Connection,$query);
        }
    ?>
    </div>

    <hr>

    <div class="container">
        <table class="table table-primary">
                <thead>
                <tr>
                    <th>Activity ID</th>
                    <th>Activity Title</th>
                    <th>User</th>
                    <th>Comment</th>
                </tr>
                </thead>
                <tbody>
                <?php
					$select="SELECT * FROM comment";
                    $query=mysqli_query($DB_Connection,$select);
					echo "<tr>";
					while($result=mysqli_fetch_array($query,MYSQLI_NUM))
					{
                        $photouserid = $result[4];
                        $link = "OtherUserPage.php?user_id=".$photouserid;
                        $select2 = "SELECT ID FROM activity WHERE Title='".$result[1]."';";
                        $query2 = mysqli_query($DB_Connection,$select2);
                        $rowrowrow = mysqli_fetch_array($query2,MYSQLI_NUM);
                        $activitycommentid = $rowrowrow[0];

                        echo
                            "
                            <tr>
                            <td>".$activitycommentid."</td>
							<td>".$result[1]."</td>
                            <td width=240><a href=".$link.">
                                    <img src='".$result[5]."' class='img-thumbnail' alt='PP' width=50 height=50/></a>&nbsp".$result[2]."</td>
                            <td>".$result[3]."</td>
							</tr>
                            ";
                    } 
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>