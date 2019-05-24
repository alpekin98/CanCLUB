<?php  
    include_once ("DbConnection.php");
    $user = (int) $_GET['user_id'];
    $activity = (int) $_GET['activity_id']; 

    $select2 = "SELECT * FROM likes WHERE User_ID='$user' AND Activity_ID='$activity';";
    $result=mysqli_query($DB_Connection,$select2);
    if(mysqli_num_rows($result) < 1)
    {
        $select = "INSERT INTO likes(Activity_ID,User_ID) VALUES ('$activity','$user');";
        $query=mysqli_query($DB_Connection,$select);
        $select1 = "UPDATE activity SET Likes=Likes+1 , Score=Score+1 WHERE ID='$activity';";
        $query=mysqli_query($DB_Connection,$select1);
        header("location: http://localhost:8080/project/ActivityList.php");
    }
    else{
        $select = "DELETE FROM likes WHERE Activity_id='$activity' AND User_ID='$user';";
        $query=mysqli_query($DB_Connection,$select);
        $select3 = "UPDATE activity SET Likes=Likes-1 , Score=Score-1 WHERE ID='$activity';";
        $query=mysqli_query($DB_Connection,$select3);
        header("location: http://localhost:8080/project/ActivityList.php");
    }

?>