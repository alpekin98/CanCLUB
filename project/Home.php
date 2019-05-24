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
    <title>Home</title>
<style>
li {
    list-style-position:inside;
    border: 1px solid black;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  width: 500px;
  
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
	<?php
		$random = "SELECT ID  FROM users";
		$query = mysqli_query($DB_Connection,$random);
		$i = 0;
		while($table_row=mysqli_fetch_array($query,MYSQLI_NUM)){
			$array[$i] = $table_row[0];
			$i++;
		}
			
		$randomnumber[0] = rand(0,sizeof($array)-1);
		$randomnumber[1] = rand(0,sizeof($array)-1);
		$randomnumber[2] = rand(0,sizeof($array)-1);

		$id1 = $randomnumber[0];
		$id2 = $randomnumber[1];
		$id3 = $randomnumber[2];

		$select1 = "SELECT Photo , Firstname , Surname FROM users WHERE ID='$array[$id1]'";
		$query1 = mysqli_query($DB_Connection,$select1);
		$table_row1=mysqli_fetch_array($query1,MYSQLI_NUM);

		$select2 = "SELECT Photo , Firstname , Surname FROM users WHERE ID='$array[$id2]'";
		$query2 = mysqli_query($DB_Connection,$select2);
		$table_row2=mysqli_fetch_array($query2,MYSQLI_NUM);

		$select3 = "SELECT Photo , Firstname , Surname FROM users WHERE ID='$array[$id3]'";
		$query3 = mysqli_query($DB_Connection,$select3);
		$table_row3=mysqli_fetch_array($query3,MYSQLI_NUM);

		$name1 = $table_row1[1].' '.$table_row1[2];
		$name2 = $table_row2[1].' '.$table_row2[2];
		$name3 = $table_row3[1].' '.$table_row3[2];

	?>
	<h1 style="text-align:center">Discover club members through home page!</h1>
	<hr>
	<div class="container">
	<table class="table table-primary">
		<tr style="text-align:center">
			<th style="width:25%;height:25%">
			<a href='OtherUserPage.php?user_id=<? echo $array[$id1]?>'>
				<img src='<? echo $table_row1[0]?>' width=250 height=300 class="img-thumbnail" alt="PP"/>
			</a>
			</th>
    		<th style="width:25%;height:25%">
				<a href='OtherUserPage.php?user_id=<? echo $array[$id2]?>'>
					<img src='<? echo $table_row2[0]?>' width=250 height=300 class="img-thumbnail" alt="PP"/>
				</a>
			</th>
			<th style="width:25%;height:25%">
				<a href='OtherUserPage.php?user_id=<? echo $array[$id3]?>'>
					<img src='<? echo $table_row3[0]?>' width=250 height=300 class="img-thumbnail" alt="PP"/>
				</a>
			</th>
  		</tr>
  		<tr style="text-align:center">
    		<td><? echo $name1 ?></td>
    		<td><? echo $name2 ?></td>
			<td><? echo $name3 ?></td>
  		</tr>
	</table>		
	</div>		
</body>
</html>